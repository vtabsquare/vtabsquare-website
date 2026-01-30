<?php

declare(strict_types=1);

namespace App\Controllers\Casestudy;

use App\Models\Casestudy\Casestudies;
use App\Models\Casestudy\Casestudy;
// use App\Models\Services\Categories\Categories;
// use App\Models\Services\Categories\Category;
// use App\Models\Services\Categories\CategoryParents;
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
    protected function index(string $slug): void
    {
        $casestudy = (new Casestudy())->getBySlug($slug);

        if (!$casestudy
            || !$casestudy['status']
        ) {
            Response::pageNotFound();
            return;
        }

        // $category = (new Category())->get($service['cid']);

        // if (!$category
        //     || !$category['status']
        // ) {
        //     (new Response())->pageNotFound();
        // }

        // helper('categories');

        // $serviceCategories = getCategories(
        //     [ $service['cid'] ],
        //     Categories::class,
        //     CategoryParents::class
        // );
        // $serviceCategories = $serviceCategories[$service['cid']];

        $data = [];

        $data['casestudy']     = $casestudy;
        // $data['category'] = $category;
        
        $data['casestudies'] = (new Casestudies())->get(0, 10, 0);
        $data['currentCasestudyId'] = $casestudy['id'];

        $data['og_title'] = 'VTAB Square | '.$casestudy['title'];
        $data['og_image'] = base_url('images/casestudies/'.$casestudy['image']);
        $data['og_url']   = base_url('case-studies/'.hentities($casestudy['slug']));

        // $data['serviceCategories'] = $serviceCategories;

        echo view('app/default/casestudy/item', $data);
    }
}
