<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Testimonials;

use App\Models\Admin\Testimonials\Testimonial;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;

class View extends Controller
{
    use APIControllerTrait;

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

        echo view('app/admin/testimonials/view', $data);
    }

    /**
     * Toggle testimonial status
     *
     * @param string $id testimonial id
     *
     * @return void
     */
    protected function toggleStatus(string $id): void
    {
        $id   = (int)$id;
        $testimonial = new Testimonial();

        // Prevent invalid id
        if (!$testimonial->exists($id)) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        $testimonial->changeStatus($id);

        Response::setStatus(StatusCode::OK);
        Response::setJson();
    }
}
