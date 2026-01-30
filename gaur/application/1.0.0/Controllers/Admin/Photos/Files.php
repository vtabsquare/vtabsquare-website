<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Photos;

use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\FileUpload;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;
use Gaur\HTTP\UploadCache;
use Gaur\Image\Image;

class Files extends Controller
{
    use APIControllerTrait;

    /**
     * Attachment field name
     *
     * @var string
     */
    protected string $afield;

    /**
     * Upload cache index
     *
     * @var int
     */
    protected int $index;

    /**
     * Upload path
     *
     * @var string
     */
    protected string $spath;

    /**
     * Upload configuration
     *
     * @var mixed[]
     */
    protected array $uploadConfig;

    /**
     * Upload count
     *
     * @var int
     */
    protected int $uploadLimit;

    /**
     * Load initial values
     *
     * @return void
     */
    protected function initConfig(): void
    {
        $afield = Input::data('file');

        $this->afield      = $afield;
        $this->spath       = config('Config\Paths')->writableDirectory . '/uploads/';
        $this->uploadLimit = 100;

        $this->uploadConfig = [
            'aindex' => true,
            'count'  => 1,
            'index'  => true,
            'name'   => $this->afield,
            'path'   => $this->spath,
            'size'   => '10MB',
            'types'  => ['jpeg', 'jpg', 'png']
        ];
    }

    /**
     * Submit form
     *
     * @return void
     */
    protected function submit(): void
    {
        $afield = Input::data('file');

        if ($afield !== 'images') {
            Response::setStatus(StatusCode::BAD_REQUEST);
            return;
        }

        $this->initConfig();

        if (!$this->validateFile()
            || !$this->validateFileIndex()
        ) {
            $this->removeFiles();

            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        $uploadCache = new UploadCache(
            __CLASS__,
            $this->afield
        );

        $files = $uploadCache->get();

        // Remove existing
        if (isset($files[$this->index])) {
            unlink($this->spath . $files[$this->index]);
            unlink($this->spath . 'thumb_' . $files[$this->index]);
        }

        $uploadCache->add(
            $this->index,
            $this->finputs[$this->afield][$this->index]
        );

        Image::createThumb(
            $this->spath . $this->finputs[$this->afield][$this->index],
            $this->spath,
            [ 'prefix' => 'thumb_' ]
        );

        session_write_close();

        Response::setStatus(StatusCode::ACCEPTED);
        Response::setJson();
    }

    /**
     * Remove files
     *
     * @return void
     */
    protected function removeFiles(): void
    {
        $uploadCache = new UploadCache(
            __CLASS__,
            $this->afield
        );

        foreach ($uploadCache->get() as $file) {
            unlink($this->spath . $file);
            unlink($this->spath . 'thumb_' . $file);
        }

        $uploadCache->remove();
    }

    /**
     * Validate file
     *
     * @return bool
     */
    protected function validateFile(): bool
    {
        $fileUpload = new FileUpload();

        $this->finputs[$this->afield] = $fileUpload->upload(
            $this->uploadConfig
        );

        if ($fileUpload->getError()) {
            $this->errors[] = $fileUpload->getError();
        } elseif (!$this->finputs[$this->afield]) {
            $this->errors[] = 'No file found';
        }

        return !$this->errors;
    }

    /**
     * Validate file index
     *
     * @return bool
     */
    protected function validateFileIndex(): bool
    {
        $this->index = (int)array_keys($this->finputs[$this->afield])[0];

        if ($this->index >= $this->uploadLimit) {
            unlink($this->spath . $this->finputs[$this->afield][$this->index]);

            $this->errors[] = 'Maximum number of files exceeded';
        }

        return !$this->errors;
    }
}
