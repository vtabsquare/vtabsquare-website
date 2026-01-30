<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Images;

use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;

class Home extends Controller
{
    use APIControllerTrait;
    use ValidateTrait;

    /**
     * Get images list
     *
     * @param string $name folder name
     *
     * @return void
     */
    protected function getItems(string $name): void
    {
        if (!$this->validateName($name)
            || !$this->validatePagination()
        ) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        session_write_close();

        $this->assembleInput();

        $items = $this->getImages();

        if (!$items) {
            Response::setStatus(StatusCode::OK);
            Response::setJson(
                [
                    'data' => [ 'content' => '' ]
                ]
            );
            return;
        }

        $data = [];

        $data['items'] = $items;

        $content = view(
            'app/admin/images/images_content',
            $data
        );

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'content' => $content ]
            ]
        );
    }

    /**
     * Get images count
     *
     * @param string $name folder name
     *
     * @return void
     */
    protected function getTotal(string $name): void
    {
        if (!$this->validateName($name)) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        session_write_close();

        $path  = 'images/' . $this->finputs['name'] . '/attach/';
        $total = 0;

        $images = scandir(FCPATH . $path);
        $images = is_array($images) ? $images : [];
        $images = array_slice($images, 2);

        $allowedTypes = [
            'jpeg',
            'jpg',
            'png'
        ];

        foreach ($images as $name) {
            $fileExt = pathinfo($name, PATHINFO_EXTENSION);

            // Invalid file type
            if (!in_array(strtolower($fileExt), $allowedTypes, true)) {
                continue;
            }

            ++$total;
        }

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'total' => $total ]
            ]
        );
    }

    /**
     * Get images list
     *
     * @return string[]
     */
    protected function getImages(): array
    {
        $path   = 'images/' . $this->finputs['name'] . '/attach/';
        $count  = $this->finputs['count'];
        $offset = $this->finputs['offset'];
        $index  = 0;

        $images = scandir(FCPATH . $path);
        $images = is_array($images) ? $images : [];
        $images = array_slice($images, 2);

        $allowedTypes = [
            'jpeg',
            'jpg',
            'png'
        ];

        foreach (array_splice($images, 0) as $k => $name) {
            $fileExt = pathinfo($name, PATHINFO_EXTENSION);

            // Invalid file type
            if (!in_array(strtolower($fileExt), $allowedTypes, true)) {
                continue;
            }

            $k = filectime(FCPATH . $path . $name) . '-' . $k;

            $images[$k] = $name;
        }

        krsort($images);

        foreach (array_splice($images, 0) as $name) {
            if ($offset) {
                --$offset;
                continue;
            }

            $images[] = $path . $name;

            if (++$index >= $count) {
                break;
            }
        }

        return $images;
    }
}
