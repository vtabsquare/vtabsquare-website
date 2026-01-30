<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Testimonials;

use App\Models\Admin\Testimonials\Testimonial;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;
use Gaur\Security\CSRF;

class Edit extends Controller
{
    use APIControllerTrait;
    use ValidateTrait;

    /**
     * Default page for this controller
     *
     * @param string $id testimonial id
     *
     * @return void
     */
    protected function index(string $id): void
    {
        $id   = (int)$id;
        $testimonial = (new Testimonial())->get($id);

        if (!$testimonial) {
            Response::pageNotFound();
            return;
        }

        $data = [];

        $data['testimonial'] = $testimonial;

        // 60 minutes
        $data['csrf'] = (new CSRF(__CLASS__))->create(60);
        session_write_close();

        echo view('app/admin/testimonials/edit', $data);
    }

    /**
     * Submit form
     *
     * @param string $id testimonial id
     *
     * @return void
     */
    protected function submit(string $id): void
    {
        $id   = (int)$id;
        $testimonial = new Testimonial();

        // Prevent invalid id
        if (!$testimonial->exists($id)) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        if (!$this->validateInput()
            || !$this->validateImage()
        ) {
            Response::setStatus(StatusCode::BAD_REQUEST);
            Response::setJson(
                [ 'errors' => $this->errors ]
            );
            return;
        }

        (new CSRF(__CLASS__))->remove();
        session_write_close();

        $this->assembleImage($id);

        $testimonial->update($id, $this->finputs);

        $message = 'Congratulations! testimonial has been successfully updated.';

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [
                    'message' => $message,
                    'link'    => 'admin/testimonials'
                ]
            ]
        );
    }

    /**
     * Assemble image
     *
     * @param int $id testimonial id
     *
     * @return void
     */
    protected function assembleImage(int $id): void
    {
        $image = (new Testimonial())->getImage($id);

        $spath = FCPATH . 'images/testimonials/';

        if (Input::data('image') && $image) {
            unlink($spath . $image);

            $image = '';
        }

        if ($this->finputs['image']) {
            if ($image) {
                unlink($spath . $image);
            }
        } else {
            $this->finputs['image'] = $image;
        }
    }
}
