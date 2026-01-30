<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Services;

use App\Models\Admin\Services\Service;
use App\Models\Admin\Services\Categories\Category;
use Gaur\HTTP\FileUpload;
use Gaur\HTTP\Input;
use Gaur\Image\Image;

trait ValidateTrait
{
    /**
     * Validate category
     *
     * @return bool
     */
    protected function validateCategory(): bool
    {
        if (!ctype_digit($this->finputs['cid'])
            || $this->finputs['cid'] < 1
            || !(new Category())->exists((int)$this->finputs['cid'])
        ) {
            $this->errors[] = 'Category selection does not appear to be valid!';
        }

        return !$this->errors;
    }

    /**
     * Validate description
     *
     * @return bool
     */
    protected function validateDesc(): bool
    {
        $this->finputs['info'] = preg_replace(
            '#\s+#',
            ' ',
            $this->finputs['info']
        );

        if (mb_strlen($this->finputs['info']) > 50000) {
            $this->errors[] = 'Description must be less than 50001 characters!';
        }

        return !$this->errors;
    }

    /**
     * Validate image
     *
     * @return bool
     */
    protected function validateImage(): bool
    {
        $fileUpload = new FileUpload();

        $spath = FCPATH . 'images/services/';
        $tpath = $spath . 'thumb/';

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
        } elseif ($this->finputs['image']) {
            Image::createThumb(
                $spath . $this->finputs['image'][0],
                $tpath
            );
        }

        $this->finputs['image'] = $this->finputs['image'][0] ?? '';

        return !$this->errors;
    }

    /**
     * Validate user inputs
     *
     * @return bool
     */
    protected function validateInput(?string $slug = ''): bool
    {
        $rfields = [
            'title',
            'cid',
            'slug',
        ];

        $ofields = [
            'video',
            'mdesc',
            'mkeywords',
            'info'
        ];

        foreach ($rfields as $field) {
            $this->finputs[$field] = Input::data($field);

            if ($this->finputs[$field] === '') {
                $this->errors[] = 'Please fill all required fields!';
                goto exitValidation;
            }
        }

        foreach ($ofields as $field) {
            $this->finputs[$field] = Input::data($field);
        }

        if (mb_strlen($this->finputs['title']) > 128) {
            $this->errors[] = 'Title must be less than 129 characters!';
            goto exitValidation;
        }

        if (preg_match('#[^a-zA-Z0-9_\-]#', $this->finputs['slug'])) {
            $this->errors[] = 'Invalid characters found in URL';
            goto exitValidation;
        } elseif (strlen($this->finputs['slug']) > 256) {
            $this->errors[] = 'URL must be less than 257 characters';
            goto exitValidation;
        } elseif ($slug !== $this->finputs['slug']
            && (new Service())->existsBySlug($this->finputs['slug'])
        ) {
            $this->errors[] = 'URL already in use';
            goto exitValidation;
        }

        exitValidation:
        return !$this->errors;
    }

    /**
     * Validate meta info
     *
     * @return bool
     */
    protected function validateMeta(): bool
    {
        if (mb_strlen($this->finputs['mdesc']) > 1280) {
            $this->errors[] = 'Meta description must be less than 1281 characters!';
            goto exitValidation;
        }

        if (mb_strlen($this->finputs['mkeywords']) > 1280) {
            $this->errors[] = 'Meta keywords must be less than 1281 characters!';
            goto exitValidation;
        }

        exitValidation:
        return !$this->errors;
    }

    /**
     * Validate video
     *
     * @return bool
     */
    protected function validateVideo(): bool
    {
        if ($this->finputs['video'] === '') {
            return true;
        }

        $url = parse_url($this->finputs['video']);

        if (!$url
            || !isset($url['host'])
            || $url['host'] !== 'www.youtube.com'
            || !isset($url['query'])
        ) {
            $this->errors[] = 'Invalid url found in video URL';
            goto exitValidation;
        }

        $query = null;

        parse_str(
            $url ? ($url['query'] ?? '') : '',
            $query
        );

        if (!$query
            || !isset($query['v'])
            || preg_match('#[^a-zA-Z0-9_\-]#', $query['v'])
            || strlen($query['v']) !== 11
        ) {
            $this->errors[] = 'Invalid url found in video URL';
            goto exitValidation;
        }

        $this->finputs['video'] = $query['v'];

        exitValidation:
        return !$this->errors;
    }
}
