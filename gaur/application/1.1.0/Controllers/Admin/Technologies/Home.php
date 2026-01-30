<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Technologies;

use App\Data\Technologies\FilterConfig;
use App\Models\Admin\Technologies\Technologies;
use App\Models\Admin\Technologies\Categories\Categories;
use App\Models\Admin\Technologies\Categories\CategoryParents;
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

        echo view('app/admin/technologies/home', $data);
    }

    /**
     * Get technologies list
     *
     * @return void
     */
    protected function getItems(): void
    {
        $filter = (new Admin(__CLASS__))->filter(
            new FilterConfig()
        );
        session_write_close();

        $items = (new Technologies())->filter(
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
            'app/admin/technologies/technologies_content',
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
     * Get technologies count
     *
     * @return void
     */
    protected function getTotal(): void
    {
        $filter = (new Admin(__CLASS__))->filter(
            new FilterConfig()
        );
        session_write_close();

        $total = (new Technologies())->filterTotal(
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
