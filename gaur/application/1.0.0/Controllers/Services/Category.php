<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Models\Services\Services;
use App\Models\Services\Categories\Categories;
use App\Models\Services\Categories\CategoryParents;
use App\Models\Services\Categories\Category as ServiceCategory;
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
    protected function index(string $cid): void
    {
        $cid      = (int)$cid;
        $category = (new ServiceCategory())->get($cid);

        if (!$category
            || !$category['status']
        ) {
            (new Response())->pageNotFound();
        }

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

        $services = (new Services())->get($cid, $listCount + 1, $offset);

        $pageNext = null;
        $pagePrev = null;

        if ($services) {
            if (count($services) > $listCount) {
                array_splice($services, $listCount);
                $pageNext = true;
            }

            if ($currentPage > 1) {
                $pagePrev = true;
            }
        }

        helper('categories');

        $serviceCategories = getCategories(
            array_column($services, 'cid'),
            Categories::class,
            CategoryParents::class
        );

        $data = [];

        $data['services']       = $services;
        $data['category']    = $category;
        $data['pageNext']    = $pageNext;
        $data['pagePrev']    = $pagePrev;
        $data['currentPage'] = $currentPage;

        $data['serviceCategories'] = $serviceCategories;

        echo view('app/default/services/category', $data);
    }

    /**
     * Get pagination
     *
     * @param string $cid category id
     *
     * @return void
     */
    protected function getPagination(string $cid): void
    {
        $cid      = (int)$cid;
        $category = (new ServiceCategory())->get($cid);

        if (!$category
            || !$category['status']
        ) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        helper('pagination');

        $total         = (new Categories())->total($cid);
        $currentPage   = Input::url('page');
        $currentPage   = ctype_digit($currentPage) ? (int)$currentPage : 0;
        $listCount     = 9;
        $paginationUrl = 'services/category/' . $cid;

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
