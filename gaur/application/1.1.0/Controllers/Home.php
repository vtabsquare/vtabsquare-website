<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Teams\Teams;
use App\Models\Testimonials\Testimonials;
use App\Models\Blogs\Blogs;
use App\Models\Photos\Photos;
use App\Models\Services\Services;
use Gaur\Controller;

class Home extends Controller
{
    /**
     * Default page for this controller
     *
     * @return void
     */
    protected function index(): void
    {
        helper('data');

        $data = [];

        $data['blogs'] = (new Blogs())->get(0, 6, 0);
        $data['photos'] = (new Photos())->get(2, 12, 0);
        $data['services'] = (new Services())->get(0, 4, 0);

        $data['teams'] = (new Teams())->get();
        $data['testimonials'] = (new Testimonials())->get();

        $data['clients'] = getDataContents('clients');
        $data['slides'] = getDataContents('slides');
        $data['statistics'] = getDataContents('statistics');

        echo view('app/default/home', $data);
    }
}
