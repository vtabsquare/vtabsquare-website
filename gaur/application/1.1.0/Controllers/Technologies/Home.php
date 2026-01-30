<?php

declare(strict_types=1);

namespace App\Controllers\Technologies;

use App\Models\Technologies\Technologies;
use App\Models\Technologies\Categories\Categories;
use App\Models\Technologies\Categories\CategoryParents;
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

        $technologies = (new Technologies())->get(0, $listCount + 1, $offset);

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
        $data['pageNext']    = $pageNext;
        $data['pagePrev']    = $pagePrev;
        $data['currentPage'] = $currentPage;

        $data['technologyCategories'] = $technologyCategories;

        echo view('app/default/technologies/home', $data);
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
        $paginationUrl = 'technologies';

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
