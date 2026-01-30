<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Photos;

use App\Models\Admin\Blogs\Categories\Category;
use App\Models\Admin\Photos\Photo;
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
     * @param string $id photo id
     *
     * @return void
     */
    protected function index(string $id): void
    {
        $id    = (int)$id;
        $photo = (new Photo())->get($id);

        if (!$photo) {
            Response::pageNotFound();
            return;
        }

        $data = [];

        $data['photo'] = $photo;

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/photos/edit', $data);
    }

    /**
     * Submit form
     *
     * @param string $id photo id
     *
     * @return void
     */
    protected function submit(string $id): void
    {
        $id    = (int)$id;
        $photo = new Photo();

        // Prevent invalid id
        if (!$photo->exists($id)) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        if (!$this->validateInput()
            || !$this->validateCategory()
            || !$this->validateMeta()
            || !$this->validateDesc()
            || !$this->validateImages(true)
        ) {
            $this->removeImages();

            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        (new CSRF(__CLASS__))->remove();
        session_write_close();

        $this->assembleImages($id);

        $previousCid = $photo->getCid($id);

        $photo->update($id, $this->finputs);

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

        $message = 'Congratulations! photo has been successfully updated.';

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [
                    'message' => $message,
                    'link'    => 'admin/photos'
                ]
            ]
        );
    }

    /**
     * Assemble images
     *
     * @param int $id photo id
     *
     * @return void
     */
    protected function assembleImages(int $id): void
    {
        $images = (new Photo())->getImages($id);

        $spath = FCPATH . 'images/photos/';
        $tpath = $spath . 'thumb/';

        // Remove exists
        foreach (Input::dataArray('images') as $k) {
            if (!ctype_digit($k) || !isset($images[$k])) {
                continue;
            }

            unlink($spath . $images[$k]);
            unlink($tpath . $images[$k]);

            unset($images[$k]);
        }

        // Replace exists
        foreach ($this->finputs['images'] as $k => $image) {
            if (isset($images[$k])) {
                unlink($spath . $images[$k]);
                unlink($tpath . $images[$k]);
            }

            $images[$k] = $image;
        }

        $this->finputs['images'] = array_values($images);
    }
}
