<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Testimonials;

use App\Data\Testimonials\FilterConfig;
use App\Models\Admin\Testimonials\Testimonials;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\Filters\Admin;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;

class Home extends Controller
{
    use APIControllerTrait;

    /**
     * Default page for this controller
     *
     * @return void
     */
    protected function index(): void
    {
        $filter = (new Admin(__CLASS__))->get();
        session_write_close();

        $currentPage = 1;

        if ($filter['offset']) {
            $currentPage = ($filter['offset'] / $filter['count']) + 1;
        }

        $filter['current_page'] = $currentPage;

        $data = [];

        $data['filter'] = $filter;

        $data['filterConfig'] = new FilterConfig();

        echo view('app/admin/testimonials/home', $data);
    }

    /**
     * Get testimonials list
     *
     * @return void
     */
    protected function getItems(): void
    {
        $filter = (new Admin(__CLASS__))->filter(
            new FilterConfig()
        );
        session_write_close();

        $items = (new Testimonials())->filter(
            $filter['filter'],
            $filter['search'],
            $filter['count'],
            $filter['offset'],
            $filter['order']
        );

        if (!$items) {
            Response::setStatus(StatusCode::OK);
            Response::setJson(
                [
                    'data' => [ 'content' => '' ]
                ]
            );
            return;
        }

        $data = [];

        $data['items']      = $items;

        $content = view(
            'app/admin/testimonials/testimonials_content',
            $data
        );

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'content' => $content ]
            ]
        );
    }

    /**
     * Get testimonials count
     *
     * @return void
     */
    protected function getTotal(): void
    {
        $filter = (new Admin(__CLASS__))->filter(
            new FilterConfig()
        );
        session_write_close();

        $total = (new Testimonials())->filterTotal(
            $filter['filter'],
            $filter['search']
        );

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'total' => $total ]
            ]
        );
    }
}
