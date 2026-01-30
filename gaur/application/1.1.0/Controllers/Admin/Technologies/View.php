<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Technologies;

use App\Models\Admin\Technologies\Technology;
use App\Models\Admin\Technologies\Categories\Categories;
use App\Models\Admin\Technologies\Categories\Category;
use App\Models\Admin\Technologies\Categories\CategoryParents;
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
     * @param string $id technology id
     *
     * @return void
     */
    protected function index(string $id): void
    {
        $id   = (int)$id;
        $technology = (new Technology())->get($id);

        if (!$technology) {
            Response::pageNotFound();
            return;
        }

        helper('categories');

        $categories = getCategories(
            [ $technology['cid'] ],
            Categories::class,
            CategoryParents::class
        );
        $categories = $categories[$technology['cid']];

        $data = [];

        $data['technology']       = $technology;
        $data['categories'] = $categories;

        echo view('app/admin/technologies/view', $data);
    }

    /**
     * Toggle technology status
     *
     * @param string $id technology id
     *
     * @return void
     */
    protected function toggleStatus(string $id): void
    {
        $id   = (int)$id;
        $technology = new Technology();

        $item = $technology->get($id);

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

        $technology->changeStatus($id);

        Response::setStatus(StatusCode::OK);
        Response::setJson();
    }
}
