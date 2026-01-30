<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Blogs\Categories;

use App\Data\Blogs\Categories\FilterConfig;
use App\Models\Admin\Blogs\Categories\Categories;
use App\Models\Admin\Blogs\Categories\CategoryParents;
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

        echo view('app/admin/blogs/categories/home', $data);
    }

    /**
     * Get categories list
     *
     * @return void
     */
    protected function getAll(): void
    {
        helper('categories');

        session_write_close();

        $categories  = (new Categories())->get();
        $fcategories = [];

        foreach (assembleCategories($categories) as $id => $items) {
            $fcategories[$id] = array_column($items, 'title');
        }

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [ 'data' => $fcategories ]
        );
    }

    /**
     * Get categories list
     *
     * @return void
     */
    protected function getItems(): void
    {
        $filter = (new Admin(__CLASS__))->filter(
            new FilterConfig()
        );
        session_write_close();

        $items = (new Categories())->filter(
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

        $pids = array_filter(
            array_unique(array_column($items, 'pid')),
            fn ($id) => $id
        );

        if ($pids) {
            $categories = getCategories(
                $pids,
                Categories::class,
                CategoryParents::class
            );
        } else {
            $categories = [];
        }

        $data = [];

        $data['items']      = $items;
        $data['categories'] = $categories;

        $content = view(
            'app/admin/blogs/categories/categories_content',
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
     * Get categories count
     *
     * @return void
     */
    protected function getTotal(): void
    {
        $filter = (new Admin(__CLASS__))->filter(
            new FilterConfig()
        );
        session_write_close();

        $total = (new Categories())->filterTotal(
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
