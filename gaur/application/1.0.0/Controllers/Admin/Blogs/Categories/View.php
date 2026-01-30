<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Blogs\Categories;

use App\Models\Admin\Blogs\Categories\Category;
use Gaur\Controller;
use Gaur\Controller\APIControllerTrait;
use Gaur\HTTP\Response;
use Gaur\HTTP\StatusCode;

class View extends Controller
{
    use APIControllerTrait;

    /**
     * Toggle category status
     *
     * @param string $id category id
     *
     * @return void
     */
    protected function toggleStatus(string $id): void
    {
        $id       = (int)$id;
        $category = new Category();

        // Prevent invalid id
        if (!$category->exists($id)) {
            Response::setStatus(StatusCode::NOT_FOUND);
            Response::setJson();
            return;
        }

        $category->changeStatus($id);

        Response::setStatus(StatusCode::OK);
        Response::setJson();
    }
}
