<?php

declare(strict_types=1);

namespace App\Controllers\Technologies;

use App\Models\Technologies\Technologies;
use App\Models\Technologies\Technology;
use App\Models\Technologies\Categories\Categories;
use App\Models\Technologies\Categories\Category;
use App\Models\Technologies\Categories\CategoryParents;
use Gaur\Controller;
use Gaur\HTTP\Response;

class Item extends Controller
{
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

        if (!$technology
            || !$technology['status']
        ) {
            Response::pageNotFound();
            return;
        }

        $category = (new Category())->get($technology['cid']);

        if (!$category
            || !$category['status']
        ) {
            (new Response())->pageNotFound();
        }

        helper('categories');

        $technologyCategories = getCategories(
            [ $technology['cid'] ],
            Categories::class,
            CategoryParents::class
        );
        $technologyCategories = $technologyCategories[$technology['cid']];

        $data = [];

        $data['technology']     = $technology;
        $data['category'] = $category;
        $data['technologies'] = (new Technologies())->get($technology['cid'], 3, 0);

        $data['technologyCategories'] = $technologyCategories;

        echo view('app/default/technologies/item', $data);
    }
}
