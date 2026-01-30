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

class Socialicons extends Controller
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

        $data['socialicons'] = getDataContents('socialicons');

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/socialicons', $data);
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
            'whatsapp',
            'phone',
            'mail',
            'facebook',
            'instagram',
            'youtube',
            'linkedin',
        ];
        $inputs = [];

        foreach ($fields as $field) {
            $inputs[$field] = Input::data($field);
        }

        putDataContents('socialicons', $inputs);

        $message = 'Congratulations! socialicons has been successfully updated.';

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'message' => $message ]
            ]
        );
    }
}
