<?php

declare(strict_types=1);

namespace App\Controllers;

use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\FileUpload;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;
use Gaur\Mail\Mail;
use Gaur\Security\CSRF;

class Career extends Controller
{
    use APIControllerTrait;

    /**
     * Default page for this controller
     *
     * @return void
     */
    protected function index(): void
    {
        $data = [];

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/default/career', $data);
    }

    /**
     * Submit form
     *
     * @return void
     */
    protected function submit(): void
    {
        if (!$this->validateInput()
            || !$this->validateResume()
            || !$this->validatePhoto()
        ) {
            $this->removeAttach();

            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        (new CSRF(__CLASS__))->remove();
        session_write_close();

        $message = 'Congratulations! your message has been successfully sent. We will send you a reply as soon as possible. Thank you for your interest in ' . config('Config\App')->siteName;

        if ($this->sendMail()) {
            Response::setStatus(StatusCode::OK);
            Response::setJson(
                [
                    'data' => [ 'message' => $message ]
                ]
            );
        } else {
            Response::setStatus(StatusCode::INTERNAL_SERVER_ERROR);
            Response::setJson();
        }
    }

    /**
     * Send email
     *
     * @return bool
     */
    protected function sendMail(): bool
    {
        helper('xhtml');

        $inputs      = array_slice($this->finputs, 0);
        $attachments = [];
        $path        = 'assets/career/';

        foreach ($inputs['resume'] as $k => $attach) {
            $attachments['resume ' . ($k + 1)] = $path . $attach;
        }

        foreach ($inputs['photo'] as $k => $attach) {
            $attachments['photo ' . ($k + 1)] = $path . $attach;
        }

        unset($inputs['resume'], $inputs['photo']);

        $data = [
            'to'          => 'information@vtabsquare.com',
            'subject'     => 'Career enquiry',
            'inputs'      => $inputs,
            'attachments' => $attachments
        ];

        $status = Mail::send(
            'email/default/contact',
            $data
        );

        return $status;
    }

    protected function validateResume(): bool
    {
        $fileUpload = new FileUpload();

        $this->finputs['resume'] = $fileUpload->upload(
            [
                'count' => 1,
                'index' => false,
                'name'  => 'resume',
                'path'  => FCPATH . 'assets/career/',
                'size'  => '10MB',
                'types' => ['doc', 'docx', 'pdf']
            ]
        );

        if ($fileUpload->getError()) {
            $this->errors[] = $fileUpload->getError();
        } elseif (!$this->finputs['resume']) {
            $this->errors[] = 'No resume found';
        }

        return !$this->errors;
    }

    protected function validatePhoto(): bool
    {
        $fileUpload = new FileUpload();

        $this->finputs['photo'] = $fileUpload->upload(
            [
                'count' => 1,
                'index' => false,
                'name'  => 'photo',
                'path'  => FCPATH . 'assets/career/',
                'size'  => '10MB',
                'types' => ['jpeg', 'jpg', 'png']
            ]
        );

        if ($fileUpload->getError()) {
            $this->errors[] = $fileUpload->getError();
        } elseif (!$this->finputs['photo']) {
            $this->errors[] = 'No photo found';
        }

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
            'email',
            'phone'
        ];

        foreach ($rfields as $field) {
            $this->finputs[$field] = Input::data($field);

            if ($this->finputs[$field] === '') {
                $this->errors[] = 'Please fill all required fields!';
                goto exitValidation;
            }
        }

        if (mb_strlen($this->finputs['name']) > 32) {
            $this->errors[] = 'Name must be less than 33 characters!';
            goto exitValidation;
        }

        if (!filter_var($this->finputs['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Email address does not appear to be valid!';
            goto exitValidation;
        } elseif (mb_strlen($this->finputs['email']) > 254) {
            $this->errors[] = 'Email address must be less than 255 characters!';
            goto exitValidation;
        }

        if (!ctype_digit($this->finputs['phone'])) {
            $this->errors[] = 'Phone number does not appear to be valid!';
            goto exitValidation;
        } elseif (strlen($this->finputs['phone']) !== 10) {
            $this->errors[] = 'Phone number must be 10 digits!';
            goto exitValidation;
        }

        exitValidation:
        return !$this->errors;
    }

    protected function removeAttach(): void
    {
        $spath = FCPATH . 'assets/career/';
        
        $files = [
            ...$this->finputs['resume'] ?? [],
            ...$this->finputs['photo'] ?? []
        ];

        foreach ($files as $v) {
            unlink($spath . $v);
        }
    }
}
