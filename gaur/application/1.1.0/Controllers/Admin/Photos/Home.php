<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Photos;

use App\Data\Photos\FilterConfig;
use App\Models\Admin\Photos\Categories\Categories;
use App\Models\Admin\Photos\Categories\CategoryParents;
use App\Models\Admin\Photos\Photos;
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

        echo view('app/admin/photos/home', $data);
    }

    /**
     * Get photos list
     *
     * @return void
     */
    protected function getItems(): void
    {
        $filter = (new Admin(__CLASS__))->filter(
            new FilterConfig()
        );
        session_write_close();

        $items = (new Photos())->filter(
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

        helper('categories');

        $categories = getCategories(
            array_unique(array_column($items, 'cid')),
            Categories::class,
            CategoryParents::class
        );

        $data = [];

        $data['items']      = $items;
        $data['categories'] = $categories;

        $content = view(
            'app/admin/photos/photos_content',
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
     * Get photos count
     *
     * @return void
     */
    protected function getTotal(): void
    {
        $filter = (new Admin(__CLASS__))->filter(
            new FilterConfig()
        );
        session_write_close();

        $total = (new Photos())->filterTotal(
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
