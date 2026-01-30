<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Models\Services\Services;
use App\Models\Services\Service;
use App\Models\Services\Categories\Categories;
use App\Models\Services\Categories\Category;
use App\Models\Services\Categories\CategoryParents;
use Gaur\Controller;
use Gaur\HTTP\Response;

class Item extends Controller
{
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

        if (!$service
            || !$service['status']
        ) {
            Response::pageNotFound();
            return;
        }

        $category = (new Category())->get($service['cid']);

        if (!$category
            || !$category['status']
        ) {
            (new Response())->pageNotFound();
        }

        helper('categories');

        $serviceCategories = getCategories(
            [ $service['cid'] ],
            Categories::class,
            CategoryParents::class
        );
        $serviceCategories = $serviceCategories[$service['cid']];

        $data = [];

        $data['service']     = $service;
        $data['category'] = $category;
        $data['services'] = (new Services())->get($service['cid'], 3, 0);

        $data['serviceCategories'] = $serviceCategories;

        echo view('app/default/services/item', $data);
    }
}
