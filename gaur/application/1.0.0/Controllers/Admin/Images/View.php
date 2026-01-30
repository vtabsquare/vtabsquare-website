<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Images;

use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;

class View extends Controller
{
    use APIControllerTrait;
    use ValidateTrait;

    /**
     * Delete image
     *
     * @param string $name  folder name
     * @param string $image image filename
     *
     * @return void
     */
    protected function deleteItem(string $name, string $image): void
    {
        session_write_close();

        if (!$this->validateName($name)
            || !$this->validateImage($image)
        ) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        $path = FCPATH . 'images/' . $this->finputs['name'] . '/attach/';

        if (!is_file($path . $image)) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        unlink($path . $image);

        Response::setStatus(StatusCode::OK);
        Response::setJson();
    }

    /**
     * Validate image filename
     *
     * @param string $image image filename
     *
     * @return bool
     */
    protected function validateImage(string $image): bool
    {
        $allowedTypes = [
            'jpeg',
            'jpg',
            'png'
        ];

        $fileExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedTypes, true)) {
            $this->errors[] = 'Image does not appear to be valid!';
        }

        return !$this->errors;
    }
}
