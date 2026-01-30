<?php

declare(strict_types=1);

namespace App\Controllers\Technologies;

use App\Models\Technologies\Technologies;
use App\Models\Technologies\Categories\Categories;
use App\Models\Technologies\Categories\CategoryParents;
use App\Models\Technologies\Categories\Category as TechnologyCategory;
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
        $category = (new TechnologyCategory())->getBySlug($slug);

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

        $technologies = (new Technologies())->get($cid, $listCount + 1, $offset);

        $pageNext = null;
        $pagePrev = null;

        if ($technologies) {
            if (count($technologies) > $listCount) {
                array_splice($technologies, $listCount);
                $pageNext = true;
            }

            if ($currentPage > 1) {
                $pagePrev = true;
            }
        }

        helper('categories');

        $technologyCategories = getCategories(
            array_column($technologies, 'cid'),
            Categories::class,
            CategoryParents::class
        );

        $data = [];

        $data['technologies']       = $technologies;
        $data['category']    = $category;
        $data['pageNext']    = $pageNext;
        $data['pagePrev']    = $pagePrev;
        $data['currentPage'] = $currentPage;

        $data['technologyCategories'] = $technologyCategories;

        echo view('app/default/technologies/category', $data);
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
        $category = (new TechnologyCategory())->getBySlug($slug);

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
        $paginationUrl = 'technologies/' . $slug;

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
