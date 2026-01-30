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

class Slides extends Controller
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

        $data['slides'] = getDataContents('slides');

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/slides', $data);
    }

    /**
     * Submit form
     *
     * @return void
     */
    protected function submit(): void
    {
        if (!$this->validateInput()
            || !$this->validateImages()
        ) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        (new CSRF(__CLASS__))->remove();
        session_write_close();

        helper('data');

        $slides = getDataContents('slides');
        $inputs = [];

        for ($i = 0; $i < 10; $i++) {
            $inputs[] = [
                'title' => $this->finputs['title'][$i] ?? '',
                'heading1' => $this->finputs['heading1'][$i] ?? '',
                'heading2' => $this->finputs['heading2'][$i] ?? '',
                'desc' => $this->finputs['desc'][$i] ?? '',
                'link1' => $this->finputs['link1'][$i] ?? '',
                'link2' => $this->finputs['link2'][$i] ?? '',
                'image' => $slides[$i]['image'] ?? '',
            ];
        }

        $this->assembleImages($inputs);

        putDataContents('slides', $inputs);

        $message = 'Congratulations! slides has been successfully updated.';

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'message' => $message ]
            ]
        );
    }

    protected function validateInput(): bool
    {
        $oafields = [
            'title',
            'heading1',
            'heading2',
            'desc',
            'link1',
            'link2',
        ];

        foreach ($oafields as $field) {
            $this->finputs[$field] = Input::dataArray($field);
        }

        exitValidation:
        return !$this->errors;
    }

    protected function validateImages(): bool
    {
        $fileUpload = new FileUpload();

        $spath = FCPATH . 'images/home/slides/';

        $this->finputs['image'] = $fileUpload->upload(
            [
                'count' => 10,
                'index' => true,
                'name'  => 'image',
                'path'  => $spath,
                'size'  => '10MB',
                'types' => ['jpeg', 'jpg', 'png']
            ]
        );

        if ($fileUpload->getError()) {
            $this->errors[] = $fileUpload->getError();
        }

        return !$this->errors;
    }

    protected function assembleImages(array &$inputs): void
    {
        $spath = FCPATH . 'images/home/slides/';

        // Remove exists
        foreach (Input::dataArray('image') as $k) {
            if (!ctype_digit($k)
                || !isset($inputs[$k])
                || !$inputs[$k]['image']
            ) {
                continue;
            }

            unlink($spath . $inputs[$k]['image']);
            $inputs[$k]['image'] = '';
        }

        // Replace exists
        foreach ($this->finputs['image'] as $k => $image) {
            if (isset($inputs[$k]) && $inputs[$k]['image']) {
                unlink($spath . $inputs[$k]['image']);
            }

            $inputs[$k]['image'] = $image;
        }

        // $inputs = array_filter($inputs, fn ($a) => $a['image']);
        $inputs = array_values($inputs);
    }
}
