<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Blogs;

use App\Models\Admin\Blogs\Blog;
use App\Models\Admin\Blogs\Categories\Categories;
use App\Models\Admin\Blogs\Categories\Category;
use App\Models\Admin\Blogs\Categories\CategoryParents;
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
     * @param string $id blog id
     *
     * @return void
     */
    protected function index(string $id): void
    {
        $id   = (int)$id;
        $blog = (new Blog())->get($id);

        if (!$blog) {
            Response::pageNotFound();
            return;
        }

        helper('categories');

        $categories = getCategories(
            [ $blog['cid'] ],
            Categories::class,
            CategoryParents::class
        );
        $categories = $categories[$blog['cid']];

        $data = [];

        $data['blog']       = $blog;
        $data['categories'] = $categories;

        echo view('app/admin/blogs/view', $data);
    }

    /**
     * Toggle blog status
     *
     * @param string $id blog id
     *
     * @return void
     */
    protected function toggleStatus(string $id): void
    {
        $id   = (int)$id;
        $blog = new Blog();

        $item = $blog->get($id);

        // Prevent invalid id
        if (!$item) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        (new Category())->updateTotal(
            $item['cid'],
            $item['status'] ? '-' : '+'
        );

        $blog->changeStatus($id);

        Response::setStatus(StatusCode::OK);
        Response::setJson();
    }
}
