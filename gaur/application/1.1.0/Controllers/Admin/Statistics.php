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

class Statistics extends Controller
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

        $data['statistics'] = getDataContents('statistics');

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/statistics', $data);
    }

    /**
     * Submit form
     *
     * @return void
     */
    protected function submit(): void
    {
        (new CSRF(__CLASS__))->remove();
        session_write_close();

        helper('data');

        $fields = [
            'experience',
            'projects',
            'experts',
            'clients',
        ];
        $inputs = [];

        foreach ($fields as $field) {
            $inputs[$field] = Input::data($field);
        }

        putDataContents('statistics', $inputs);

        $message = 'Congratulations! statistics has been successfully updated.';

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'message' => $message ]
            ]
        );
    }
}
