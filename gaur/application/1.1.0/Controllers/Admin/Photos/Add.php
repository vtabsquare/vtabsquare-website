<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Photos;

use App\Models\Admin\Photos\Categories\Category;
use App\Models\Admin\Photos\Photo;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;
use Gaur\Security\CSRF;

class Add extends Controller
{
    use APIControllerTrait;
    use ValidateTrait;

    /**
     * Default page for this controller
     *
     * @return void
     */
    protected function index(): void
    {
        $data = [];

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/photos/add', $data);
    }

    /**
     * Submit form
     *
     * @return void
     */
    protected function submit(): void
    {
        if (!$this->validateInput()
            || !$this->validateCategory()
            || !$this->validateMeta()
            || !$this->validateDesc()
            || !$this->validateImages(false)
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

        (new Photo())->add($this->finputs);

        (new Category())->updateTotal(
            (int)$this->finputs['cid'],
            '+'
        );

        $message = 'Congratulations! photo has been successfully created.';

        Response::setStatus(StatusCode::CREATED);
        Response::setJson(
            [
                'data' => [
                    'message' => $message,
                    'link'    => 'admin/photos'
                ]
            ]
        );
    }
}
