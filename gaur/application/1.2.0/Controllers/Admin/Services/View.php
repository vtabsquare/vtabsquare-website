<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Services;

use App\Models\Admin\Services\Service;
use App\Models\Admin\Services\Categories\Categories;
use App\Models\Admin\Services\Categories\Category;
use App\Models\Admin\Services\Categories\CategoryParents;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;

class View extends Controller
{
    use APIControllerTrait;

    /**
     * Default page for this controller
     *
     * @param string $id service id
     *
     * @return void
     */
    protected function index(string $id): void
    {
        $id   = (int)$id;
        $service = (new Service())->get($id);

        if (!$service) {
            Response::pageNotFound();
            return;
        }

        helper('categories');

        $categories = getCategories(
            [ $service['cid'] ],
            Categories::class,
            CategoryParents::class
        );
        $categories = $categories[$service['cid']];

        $data = [];

        $data['service']       = $service;
        $data['categories'] = $categories;

        echo view('app/admin/services/view', $data);
    }

    /**
     * Toggle service status
     *
     * @param string $id service id
     *
     * @return void
     */
    protected function toggleStatus(string $id): void
    {
        $id   = (int)$id;
        $service = new Service();

        $item = $service->get($id);

        // Prevent invalid id
        if (!$item) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        (new Category())->updateTotal(
            $item['cid'],
            $item['status'] ? '-' : '+'
        );

        $service->changeStatus($id);

        Response::setStatus(StatusCode::OK);
        Response::setJson();
    }
}
