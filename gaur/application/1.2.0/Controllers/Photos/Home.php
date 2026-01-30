<?php

declare(strict_types=1);

namespace App\Controllers\Photos;

use App\Models\Photos\Categories\Categories;
use App\Models\Photos\Categories\CategoryParents;
use App\Models\Photos\Photos;
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

        $photos = (new Photos())->get(0, $listCount + 1, $offset);

        $pageNext = null;
        $pagePrev = null;

        if ($photos) {
            if (count($photos) > $listCount) {
                array_splice($photos, $listCount);
                $pageNext = true;
            }

            if ($currentPage > 1) {
                $pagePrev = true;
            }
        }

        helper('categories');

        $photoCategories = getCategories(
            array_column($photos, 'cid'),
            Categories::class,
            CategoryParents::class
        );

        $data = [];

        $data['photos']      = $photos;
        $data['pageNext']    = $pageNext;
        $data['pagePrev']    = $pagePrev;
        $data['currentPage'] = $currentPage;

        $data['photoCategories'] = $photoCategories;

        echo view('app/default/photos/home', $data);
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
        $paginationUrl = 'photos';

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
