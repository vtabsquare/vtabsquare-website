<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Photos;

use App\Models\Admin\Photos\Photo;
use App\Models\Admin\Photos\Categories\Category;
use Gaur\HTTP\FileUpload;
use Gaur\HTTP\Input;
use Gaur\HTTP\UploadCache;

trait ValidateTrait
{
    /**
     * Remove temporary images
     *
     * @return void
     */
    protected function removeImages(): void
    {
        $uploadCache = new UploadCache(
            __NAMESPACE__ . '\Files',
            'images'
        );

        $images = $uploadCache->get();
        $path   = config('Config\Paths')->writableDirectory . '/uploads/';

        foreach ($images as $image) {
            unlink($path . $image);
            unlink($path . 'thumb_' . $image);
        }

        $uploadCache->remove();
    }

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
     * Validate images
     *
     * @param bool $index preserve array keys
     *
     * @return bool
     */
    protected function validateImages(bool $index): bool
    {
        $uploadCache = new UploadCache(
            __NAMESPACE__ . '\Files',
            'images'
        );

        $fileUpload = new FileUpload();
        $images     = $uploadCache->get();

        $uploadCache->remove();

        $path  = config('Config\Paths')->writableDirectory . '/uploads/';
        $spath = FCPATH . 'images/photos/';
        $tpath = $spath . 'thumb/';

        $this->finputs['images'] = [];

        foreach ($images as $k => $image) {
            $fileExt = pathinfo($image, PATHINFO_EXTENSION);
            $nimage  = $fileUpload->getNewFilename($fileExt, $spath);

            rename($path . $image, $spath . $nimage);
            rename($path . 'thumb_' . $image, $tpath . $nimage);

            $this->finputs['images'][$k] = $nimage;
        }

        if (!$index) {
            $this->finputs['images'] = array_values($this->finputs['images']);
        }

        return !$this->errors;
    }

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
            && (new Photo())->existsBySlug($this->finputs['slug'])
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
}
