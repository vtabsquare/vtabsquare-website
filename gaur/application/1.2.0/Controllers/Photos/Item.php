<?php

declare(strict_types=1);

namespace App\Controllers\Photos;

use App\Models\Photos\Categories\Categories;
use App\Models\Photos\Categories\Category;
use App\Models\Photos\Categories\CategoryParents;
use App\Models\Photos\Photo;
use Gaur\Controller;
use Gaur\HTTP\Response;

class Item extends Controller
{
    /**
     * Default page for this controller
     *
     * @param string $id photo id
     *
     * @return void
     */
    protected function index(string $slug): void
    {
        $photo = (new Photo())->getBySlug($slug);

        if (!$photo
            || !$photo['status']
        ) {
            Response::pageNotFound();
            return;
        }

        $category = (new Category())->get($photo['cid']);

        if (!$category
            || !$category['status']
        ) {
            (new Response())->pageNotFound();
        }

        helper('categories');

        $photoCategories = getCategories(
            [ $photo['cid'] ],
            Categories::class,
            CategoryParents::class
        );
        $photoCategories = $photoCategories[$photo['cid']];

        $data = [];

        $data['photo']    = $photo;
        $data['category'] = $category;

        $data['photoCategories'] = $photoCategories;

        echo view('app/default/photos/item', $data);
    }
}
