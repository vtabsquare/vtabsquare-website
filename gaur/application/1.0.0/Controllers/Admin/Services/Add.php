<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Services;

use App\Models\Admin\Services\Service;
use App\Models\Admin\Services\Categories\Category;
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

        echo view('app/admin/services/add', $data);
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

        (new Service())->add($this->finputs);

        (new Category())->updateTotal(
            (int)$this->finputs['cid'],
            '+'
        );

        $message = 'Congratulations! service has been successfully created.';

        Response::setStatus(StatusCode::CREATED);
        Response::setJson(
            [
                'data' => [
                    'message' => $message,
                    'link'    => 'admin/services'
                ]
            ]
        );
    }
}
