<?php

declare(strict_types=1);

namespace App\Controllers\Admin\Photos;

use App\Models\Admin\Photos\Categories\Categories;
use App\Models\Admin\Photos\Categories\Category;
use App\Models\Admin\Photos\Categories\CategoryParents;
use App\Models\Admin\Photos\Photo;
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
     * @param string $id photo id
     *
     * @return void
     */
    protected function index(string $id): void
    {
        $id    = (int)$id;
        $photo = (new Photo())->get($id);

        if (!$photo) {
            Response::pageNotFound();
            return;
        }

        helper('categories');

        $categories = getCategories(
            [ $photo['cid'] ],
            Categories::class,
            CategoryParents::class
        );
        $categories = $categories[$photo['cid']];

        $data = [];

        $data['photo']      = $photo;
        $data['categories'] = $categories;

        echo view('app/admin/photos/view', $data);
    }

    /**
     * Toggle photo status
     *
     * @param string $id photo id
     *
     * @return void
     */
    protected function toggleStatus(string $id): void
    {
        $id    = (int)$id;
        $photo = new Photo();

        $item = $photo->get($id);

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

        $photo->changeStatus($id);

        Response::setStatus(StatusCode::OK);
        Response::setJson();
    }
}
