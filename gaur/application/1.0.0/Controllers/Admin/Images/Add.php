<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Images;

use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\FileUpload;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;

class Add extends Controller
{
    use APIControllerTrait;
    use ValidateTrait;

    /**
     * Submit form
     *
     * @param string $name folder name
     *
     * @return void
     */
    protected function submit(string $name): void
    {
        session_write_close();

        if (!$this->validateName($name)
            || !$this->validateImage()
        ) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        $url  = 'images/' . $this->finputs['name'] . '/attach/';
        $url .= $this->finputs['image'][0];

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'url' => $url ]
            ]
        );
    }

    /**
     * Validate image
     *
     * @return bool
     */
    protected function validateImage(): bool
    {
        $fileUpload = new FileUpload();

        $spath = FCPATH . 'images/' . $this->finputs['name'] . '/attach/';

        $this->finputs['image'] = $fileUpload->upload(
            [
                'count' => 1,
                'index' => false,
                'name'  => 'image',
                'path'  => $spath,
                'size'  => '10MB',
                'types' => ['jpeg', 'jpg', 'png']
            ]
        );

        if ($fileUpload->getError()) {
            $this->errors[] = $fileUpload->getError();
        } elseif (!$this->finputs['image']) {
            $this->errors[] = 'No image found';
        }

        return !$this->errors;
    }
}
