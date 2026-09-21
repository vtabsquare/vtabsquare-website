<?php

declare(strict_types=1);

namespace App\Controllers;

use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;
use Gaur\Mail\Mail;
use Gaur\Security\CSRF;

class Contact extends Controller
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

        echo view('app/default/contact', $data);
    }

    /**
     * Submit form
     *
     * @return void
     */
    protected function submit(): void
    {
        if (!$this->validateInput()) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        // Keep the session writable until a successful send consumes the CSRF token.

        $message = 'Congratulations! your message has been successfully sent. We will send you a reply as soon as possible. Thank you for your interest in ' . config('Config\App')->siteName;

        if ($this->sendMail()) {
            (new CSRF(__CLASS__))->remove();
            Response::setStatus(StatusCode::OK);
            Response::setJson(
                [
                    'data' => [ 'message' => $message ]
                ]
            );
        } else {
            Response::setStatus(StatusCode::INTERNAL_SERVER_ERROR);
            Response::setJson([ 'errors' => [ 'We could not submit your enquiry right now. Please email information@vtabsquare.com directly.' ] ]);
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

        $data = [
            'to'      => 'information@vtabsquare.com',
            'subject' => 'Contact enquiry',
            'inputs'  => $this->finputs
        ];

        $status = Mail::send(
            'email/default/contact',
            $data
        );

        return $status;
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
            'phone',
            'subject',
            'message'
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

        if (!preg_match('/^\\+?[0-9][0-9 ()-]*$/', $this->finputs['phone'])) {
            $this->errors[] = 'Please enter a valid phone number with optional country code!';
            goto exitValidation;
        } elseif (strlen(preg_replace('/\\D/', '', $this->finputs['phone'])) < 7 || strlen(preg_replace('/\\D/', '', $this->finputs['phone'])) > 15) {
            $this->errors[] = 'Phone number must contain between 7 and 15 digits!';
            goto exitValidation;
        }

        if (mb_strlen($this->finputs['subject']) > 256) {
            $this->errors[] = 'Subject must be less than 257 characters!';
            goto exitValidation;
        }

        if (mb_strlen($this->finputs['message']) > 1024) {
            $this->errors[] = 'Message must be less than 1025 characters!';
            goto exitValidation;
        }

        exitValidation:
        return !$this->errors;
    }
}
