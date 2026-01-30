<?php

declare(strict_types=1);

namespace App\Controllers\Blogs;

use App\Models\Blogs\Blogs;
use App\Models\Blogs\Blog;
use App\Models\Blogs\Categories\Categories;
use App\Models\Blogs\Categories\Category;
use App\Models\Blogs\Categories\CategoryParents;
use Gaur\Controller;
use Gaur\HTTP\Response;

class Item extends Controller
{
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

        if (!$blog
            || !$blog['status']
        ) {
            Response::pageNotFound();
            return;
        }

        $category = (new Category())->get($blog['cid']);

        if (!$category
            || !$category['status']
        ) {
            (new Response())->pageNotFound();
        }

        helper('categories');

        $blogCategories = getCategories(
            [ $blog['cid'] ],
            Categories::class,
            CategoryParents::class
        );
        $blogCategories = $blogCategories[$blog['cid']];

        $data = [];

        $data['blog']     = $blog;
        $data['category'] = $category;
        $data['blogs'] = (new Blogs())->get($blog['cid'], 2, 0);

        $data['blogCategories'] = $blogCategories;

        echo view('app/default/blogs/item', $data);
    }
}
