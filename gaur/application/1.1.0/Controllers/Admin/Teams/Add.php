<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Teams;

use App\Models\Admin\Teams\Team;
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

        echo view('app/admin/teams/add', $data);
    }

    /**
     * Submit form
     *
     * @return void
     */
    protected function submit(): void
    {
        if (!$this->validateInput()
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

        (new Team())->add($this->finputs);

        $message = 'Congratulations! team has been successfully created.';

        Response::setStatus(StatusCode::CREATED);
        Response::setJson(
            [
                'data' => [
                    'message' => $message,
                    'link'    => 'admin/teams'
                ]
            ]
        );
    }
}
