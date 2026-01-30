<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\FileUpload;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;
use Gaur\Security\CSRF;

class Clients extends Controller
{
    use APIControllerTrait;

    /**
     * Default page for this controller
     *
     * @return void
     */
    protected function index(): void
    {
        helper('data');

        $data = [];

        $data['clients'] = getDataContents('clients');

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/clients', $data);
    }

    /**
     * Submit form
     *
     * @return void
     */
    protected function submit(): void
    {
        if (!$this->validateImages()) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        (new CSRF(__CLASS__))->remove();
        session_write_close();

        helper('data');

        $this->assembleImages();

        putDataContents('clients', $this->finputs['images']);

        $message = 'Congratulations! clients has been successfully updated.';

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'message' => $message ]
            ]
        );
    }

    /**
     * Validate image
     *
     * @return bool
     */
    protected function validateImages(): bool
    {
        $fileUpload = new FileUpload();

        $spath = FCPATH . 'images/clients/';

        $this->finputs['images'] = $fileUpload->upload(
            [
                'count' => 100,
                'index' => true,
                'name'  => 'images',
                'path'  => $spath,
                'size'  => '10MB',
                'types' => ['jpeg', 'jpg', 'png']
            ]
        );

        if ($fileUpload->getError()) {
            $this->errors[] = $fileUpload->getError();
        }

        return !$this->errors;
    }

    /**
     * Assemble images
     *
     * @return void
     */
    protected function assembleImages(): void
    {
        $images = getDataContents('clients');

        $spath = FCPATH . 'images/clients/';

        // Remove exists
        foreach (Input::dataArray('images') as $k) {
            if (!ctype_digit($k) || !isset($images[$k])) {
                continue;
            }

            unlink($spath . $images[$k]);

            unset($images[$k]);
        }

        // Replace exists
        foreach ($this->finputs['images'] as $k => $image) {
            if (isset($images[$k])) {
                unlink($spath . $images[$k]);
            }

            $images[$k] = $image;
        }

        $this->finputs['images'] = array_values($images);
    }
}
