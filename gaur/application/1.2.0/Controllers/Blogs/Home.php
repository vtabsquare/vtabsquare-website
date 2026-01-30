<?php


declare(strict_types=1);

namespace App\Controllers\Blogs;

use App\Models\Blogs\Blogs;
use App\Models\Blogs\Categories\Categories;
use App\Models\Blogs\Categories\CategoryParents;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Input;
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

        $blogs = (new Blogs())->get(0, $listCount + 1, $offset);

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
        $data['pageNext']    = $pageNext;
        $data['pagePrev']    = $pagePrev;
        $data['currentPage'] = $currentPage;
        $data['blogCategories'] = $blogCategories;
        
        

    

        echo view('app/default/blogs/home', $data);
    }

    /**
     * Get pagination
     *
     * @return void
     */
    protected function getPagination(): void
    {
        helper('pagination');

        $total         = (new Categories())->total();
        $currentPage   = Input::url('page');
        $currentPage   = ctype_digit($currentPage) ? (int)$currentPage : 0;
        $listCount     = 9;
        $paginationUrl = 'blogs';

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
