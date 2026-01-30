<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Models\Services\Services;
use App\Models\Services\Categories\Categories;
use App\Models\Services\Categories\CategoryParents;
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

        $services = (new Services())->get(0, $listCount + 1, $offset);

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
        $data['pageNext']    = $pageNext;
        $data['pagePrev']    = $pagePrev;
        $data['currentPage'] = $currentPage;

        $data['serviceCategories'] = $serviceCategories;

        echo view('app/default/services/home', $data);
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
        $paginationUrl = 'services';

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
