<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Testimonials;

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

        $spath = FCPATH . 'images/testimonials/';

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
            'rating',
            'message'
        ];

        foreach ($rfields as $field) {
            $this->finputs[$field] = Input::data($field);

            if ($this->finputs[$field] === '') {
                $this->errors[] = 'Please fill all required fields!';
                goto exitValidation;
            }
        }

        if (mb_strlen($this->finputs['name']) > 64) {
            $this->errors[] = 'name must be less than 65 characters!';
            goto exitValidation;
        }

        if (!ctype_digit($this->finputs['rating'])
            || $this->finputs['rating'] < 1
            || $this->finputs['rating'] > 5
        ) {
            $this->errors[] = 'Invalid rating found';
            goto exitValidation;
        }

        if (mb_strlen($this->finputs['message']) > 1024) {
            $this->errors[] = 'message must be less than 1025 characters!';
        }

        exitValidation:
        return !$this->errors;
    }
}
