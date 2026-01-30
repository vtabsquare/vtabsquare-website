<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Teams;

use Gaur\HTTP\FileUpload;
use Gaur\HTTP\Input;
use Gaur\Image\Image;

trait ValidateTrait
{
    /**
     * Validate image
     *
     * @return bool
     */
    protected function validateImage(): bool
    {
        $fileUpload = new FileUpload();

        $spath = FCPATH . 'images/teams/';

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
        }

        $this->finputs['image'] = $this->finputs['image'][0] ?? '';

        return !$this->errors;
    }

    /**
     * Validate user inputs
     *
     * @return bool
     */
    protected function validateInput(): bool
    {
        $rfields = [
            'name',
            'designation',
            'link-facebook',
            'link-twitter',
            'link-instagram',
            'link-linkedin',
        ];

        foreach ($rfields as $field) {
            $this->finputs[$field] = Input::data($field);

            if ($this->finputs[$field] === '') {
                $this->errors[] = 'Please fill all required fields!';
                goto exitValidation;
            }
        }

        $fields = [
            'name' => [
                'name' => 'Name',
                'length' => 64
            ],
            'designation' => [
                'name' => 'Designation',
                'length' => 64
            ],
            'link-facebook' => [
                'name' => 'Facebook',
                'length' => 128
            ],
            'link-twitter' => [
                'name' => 'Twitter',
                'length' => 128
            ],
            'link-instagram' => [
                'name' => 'Instagram',
                'length' => 128
            ],
            'link-linkedin' => [
                'name' => 'Linkedin',
                'length' => 128
            ],
        ];

        foreach ($fields as $field => $item) {
            if (mb_strlen($this->finputs[$field]) > $item['length']) {
                $this->errors[] = $item['name'] . ' must be less than ' . ($item['length'] + 1) . ' characters!';
                goto exitValidation;
            }
        }

        $links = [];
        $fields = [
            'link-facebook' => 'facebook',
            'link-twitter' => 'twitter',
            'link-instagram' => 'instagram',
            'link-linkedin' => 'linkedin',
        ];

        foreach ($fields as $ok => $nk) {
            $links[$nk] = $this->finputs[$ok];
        }

        $this->finputs['links'] = $links;

        exitValidation:
        return !$this->errors;
    }
}
