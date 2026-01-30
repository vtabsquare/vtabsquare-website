<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Services;

use App\Models\Admin\Services\Service;
use App\Models\Admin\Services\Categories\Category;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;
use Gaur\Security\CSRF;

class Edit extends Controller
{
    use APIControllerTrait;
    use ValidateTrait;

    /**
     * Default page for this controller
     *
     * @param string $id service id
     *
     * @return void
     */
    protected function index(string $id): void
    {
        $id   = (int)$id;
        $service = (new Service())->get($id);

        if (!$service) {
            Response::pageNotFound();
            return;
        }

        $data = [];

        $data['service'] = $service;

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/services/edit', $data);
    }

    /**
     * Submit form
     *
     * @param string $id service id
     *
     * @return void
     */
    protected function submit(string $id): void
    {
        $id   = (int)$id;
        $service = new Service();

        // Prevent invalid id
        if (!$service->exists($id)) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        if (!$this->validateInput()
            || !$this->validateCategory()
            || !$this->validateVideo()
            || !$this->validateMeta()
            || !$this->validateDesc()
            || !$this->validateImage()
        ) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        (new CSRF(__CLASS__))->remove();
        session_write_close();

        $this->assembleImage($id);

        $previousCid = $service->getCid($id);

        $service->update($id, $this->finputs);

        if ($previousCid != $this->finputs['cid']) {
            $category = new Category();

            $category->updateTotal(
                $previousCid,
                '-'
            );

            $category->updateTotal(
                (int)$this->finputs['cid'],
                '+'
            );
        }

        $message = 'Congratulations! service has been successfully updated.';

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [
                    'message' => $message,
                    'link'    => 'admin/services'
                ]
            ]
        );
    }

    /**
     * Assemble image
     *
     * @param int $id service id
     *
     * @return void
     */
    protected function assembleImage(int $id): void
    {
        $image = (new Service())->getImage($id);

        $spath = FCPATH . 'images/services/';
        $tpath = $spath . 'thumb/';

        if (Input::data('image') && $image) {
            unlink($spath . $image);
            unlink($tpath . $image);

            $image = '';
        }

        if ($this->finputs['image']) {
            if ($image) {
                unlink($spath . $image);
                unlink($tpath . $image);
            }
        } else {
            $this->finputs['image'] = $image;
        }
    }
}
