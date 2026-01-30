<?php

declare(strict_types=1);

namespace App\Controllers\Blogs;

use App\Models\Blogs\Blogs;
use App\Models\Blogs\Categories\Categories;
use App\Models\Blogs\Categories\CategoryParents;
use App\Models\Blogs\Categories\Category as BlogCategory;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Input;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;

class Category extends Controller
{
    use APIControllerTrait;

    /**
     * Default page for this controller
     *
     * @param string $cid category id
     *
     * @return void
     */
    protected function index(string $slug): void
    {
        $category = (new BlogCategory())->getBySlug($slug);

        if (!$category
            || !$category['status']
        ) {
            (new Response())->pageNotFound();
        }

        $cid = $category['id'];

        $currentPage = Input::url('page');
        $currentPage = ctype_digit($currentPage) ? (int)$currentPage : 0;
        $listCount   = 9;

        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $offset = 0;

        if ($currentPage > 1) {
            $offset = ($currentPage - 1) * $listCount;
        }

        $blogs = (new Blogs())->get($cid, $listCount + 1, $offset);

        $pageNext = null;
        $pagePrev = null;

        if ($blogs) {
            if (count($blogs) > $listCount) {
                array_splice($blogs, $listCount);
                $pageNext = true;
            }

            if ($currentPage > 1) {
                $pagePrev = true;
            }
        }

        helper('categories');

        $blogCategories = getCategories(
            array_column($blogs, 'cid'),
            Categories::class,
            CategoryParents::class
        );
        
        
        

        $data = [];

        $data['blogs']       = $blogs;
        $data['category']    = $category;
        $data['pageNext']    = $pageNext;
        $data['pagePrev']    = $pagePrev;
        $data['currentPage'] = $currentPage;



        $data['blogCategories'] = $blogCategories;

        echo view('app/default/blogs/category', $data);
    }

    /**
     * Get pagination
     *
     * @param string $cid category id
     *
     * @return void
     */
    protected function getPagination(string $slug): void
    {
        $category = (new BlogCategory())->getBySlug($slug);

        if (!$category
            || !$category['status']
        ) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }
        
        $cid = $category['id'];

        helper('pagination');

        $total         = (new Categories())->total($cid);
        $currentPage   = Input::url('page');
        $currentPage   = ctype_digit($currentPage) ? (int)$currentPage : 0;
        $listCount     = 9;
        $paginationUrl = 'blogs/' . $slug;

        $content = getPagination(
            $total,
            $currentPage,
            $listCount,
            $paginationUrl
        );

        Response::setStatus(StatusCode::OK);
        Response::setJson(
            [
                'data' => [ 'content' => $content ]
            ]
        );
    }
}
