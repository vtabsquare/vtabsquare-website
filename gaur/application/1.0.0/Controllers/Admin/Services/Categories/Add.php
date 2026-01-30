<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Services\Categories;

use App\Models\Admin\Services\Categories\Category;
use App\Models\Admin\Services\Categories\CategoryParent;
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

        echo view('app/admin/services/categories/add', $data);
    }

    /**
     * Submit form
     *
     * @return void
     */
    protected function submit(): void
    {
        if (!$this->validateInput()
            || !$this->validateParent()
        ) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        (new CSRF(__CLASS__))->remove();
        session_write_close();

        $id = (new Category())->add($this->finputs);

        if ($this->finputs['pid']) {
            (new CategoryParent())->add(
                $id,
                $this->getParents((int)$this->finputs['pid'])
            );
        }

        $message = 'Congratulations! category has been successfully created.';

        Response::setStatus(StatusCode::CREATED);
        Response::setJson(
            [
                'data' => [
                    'message' => $message,
                    'link'    => 'admin/services/categories'
                ]
            ]
        );
    }
}
