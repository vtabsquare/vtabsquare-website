<?php

declare(strict_types=1);

namespace App\Controllers\Casestudy;

use App\Models\Casestudy\Casestudies;
use App\Models\Casestudy\Casestudy;
// use App\Models\Services\Categories\Categories;
// use App\Models\Services\Categories\CategoryParents;
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

        $casestudies = (new Casestudies())->get(0, $listCount + 1, $offset);

        $pageNext = null;
        $pagePrev = null;

        if ($casestudies) {
            if (count($casestudies) > $listCount) {
                array_splice($casestudies, $listCount);
                $pageNext = true;
            }

            if ($currentPage > 1) {
                $pagePrev = true;
            }
        }

        // helper('categories');

        // $serviceCategories = getCategories(
        //     array_column($services, 'cid'),
        //     Categories::class,
        //     CategoryParents::class
        // );

        $data = [];

        $data['casestudies']       = $casestudies;
        $data['pageNext']    = $pageNext;
        $data['pagePrev']    = $pagePrev;
        $data['currentPage'] = $currentPage;

        $data['og_title'] = 'VTAB Square | Case Studies';
        $data['og_image'] = base_url('assets/img/logo.png');
        $data['og_url']   = base_url('case-studies');

        // $data['serviceCategories'] = $serviceCategories;

        echo view('app/default/casestudy/home', $data);
    }

    /**
     * Get pagination
     *
     * @return void
     */
    protected function getPagination(): void
    {
        helper('pagination');

        $total         = (new Casestudies())->total();
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
