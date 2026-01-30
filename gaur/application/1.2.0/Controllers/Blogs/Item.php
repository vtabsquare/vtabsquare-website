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
    protected function index(string $slug): void
    {
        $blog = (new Blog())->getBySlug($slug);

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
        $data['blogs'] = (new Blogs())->get($blog['cid'], 10, 0);
        
          $data['currentBlogId'] = $blog['id'];

        $data['blogCategories'] = $blogCategories;

        echo view('app/default/blogs/item', $data);
    }
}
