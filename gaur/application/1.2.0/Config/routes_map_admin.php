<?php

// admin - home
$routes->get('admin', 'Admin\Home::index');

// admin - clients
$routes->get('admin/clients', 'Admin\Clients::index');
$routes->post('api/admin/clients', 'Admin\Clients::api/submit');

// admin - slides
$routes->get('admin/slides', 'Admin\Slides::index');
$routes->post('api/admin/slides', 'Admin\Slides::api/submit');

// admin - socialicons
$routes->get('admin/socialicons', 'Admin\Socialicons::index');
$routes->post('api/admin/socialicons', 'Admin\Socialicons::api/submit');

// admin - statistics
$routes->get('admin/statistics', 'Admin\Statistics::index');
$routes->post('api/admin/statistics', 'Admin\Statistics::api/submit');

// admin - blogs
$routes->get('admin/blogs/add', 'Admin\Blogs\Add::index');
$routes->post('api/admin/blogs', 'Admin\Blogs\Add::api/submit');

$routes->get('admin/blogs/edit/([0-9]+)', 'Admin\Blogs\Edit::index/$1');
$routes->post('api/admin/blogs/([0-9]+)', 'Admin\Blogs\Edit::api/submit/$1');

$routes->get('admin/blogs', 'Admin\Blogs\Home::index');
$routes->get('api/admin/blogs', 'Admin\Blogs\Home::api/getItems');
$routes->get('api/admin/blogs/total', 'Admin\Blogs\Home::api/getTotal');

$routes->get('admin/blogs/view/([0-9]+)', 'Admin\Blogs\View::index/$1');
$routes->post('api/admin/blogs/([0-9]+)/status', 'Admin\Blogs\View::api/toggleStatus/$1');

// admin - blogs - categories
$routes->get('admin/blogs/categories/add', 'Admin\Blogs\Categories\Add::index');
$routes->post('api/admin/blogs/categories', 'Admin\Blogs\Categories\Add::api/submit');

$routes->get('admin/blogs/categories/edit/([0-9]+)', 'Admin\Blogs\Categories\Edit::index/$1');
$routes->put('api/admin/blogs/categories/([0-9]+)', 'Admin\Blogs\Categories\Edit::api/submit/$1');

$routes->get('admin/blogs/categories', 'Admin\Blogs\Categories\Home::index');
$routes->get('api/admin/blogs/categories', 'Admin\Blogs\Categories\Home::api/getItems');
$routes->get('api/admin/blogs/categories/all', 'Admin\Blogs\Categories\Home::api/getAll');
$routes->get('api/admin/blogs/categories/total', 'Admin\Blogs\Categories\Home::api/getTotal');

$routes->post('api/admin/blogs/categories/([0-9]+)/status', 'Admin\Blogs\Categories\View::api/toggleStatus/$1');

// admin - images
$routes->post('api/admin/images/(\w+)', 'Admin\Images\Add::api/submit/$1');

$routes->get('api/admin/images/(\w+)', 'Admin\Images\Home::api/getItems/$1');
$routes->get('api/admin/images/(\w+)/total', 'Admin\Images\Home::api/getTotal/$1');

$routes->delete('api/admin/images/(\w+)/([a-fA-F0-9]{32}\.[a-zA-Z0-9]{3,4})', 'Admin\Images\View::api/deleteItem/$1/$2');

// admin - photos
$routes->get('admin/photos/add', 'Admin\Photos\Add::index');
$routes->post('api/admin/photos', 'Admin\Photos\Add::api/submit');

$routes->get('admin/photos/edit/([0-9]+)', 'Admin\Photos\Edit::index/$1');
$routes->put('api/admin/photos/([0-9]+)', 'Admin\Photos\Edit::api/submit/$1');

$routes->post('api/admin/photos/files', 'Admin\Photos\Files::api/submit');

$routes->get('admin/photos', 'Admin\Photos\Home::index');
$routes->get('api/admin/photos', 'Admin\Photos\Home::api/getItems');
$routes->get('api/admin/photos/total', 'Admin\Photos\Home::api/getTotal');

$routes->get('admin/photos/view/([0-9]+)', 'Admin\Photos\View::index/$1');
$routes->post('api/admin/photos/([0-9]+)/status', 'Admin\Photos\View::api/toggleStatus/$1');

// admin - photos - categories
$routes->get('admin/photos/categories/add', 'Admin\Photos\Categories\Add::index');
$routes->post('api/admin/photos/categories', 'Admin\Photos\Categories\Add::api/submit');

$routes->get('admin/photos/categories/edit/([0-9]+)', 'Admin\Photos\Categories\Edit::index/$1');
$routes->put('api/admin/photos/categories/([0-9]+)', 'Admin\Photos\Categories\Edit::api/submit/$1');

$routes->get('admin/photos/categories', 'Admin\Photos\Categories\Home::index');
$routes->get('api/admin/photos/categories', 'Admin\Photos\Categories\Home::api/getItems');
$routes->get('api/admin/photos/categories/all', 'Admin\Photos\Categories\Home::api/getAll');
$routes->get('api/admin/photos/categories/total', 'Admin\Photos\Categories\Home::api/getTotal');

$routes->post('api/admin/photos/categories/([0-9]+)/status', 'Admin\Photos\Categories\View::api/toggleStatus/$1');

// admin - services
$routes->get('admin/services/add', 'Admin\Services\Add::index');
$routes->post('api/admin/services', 'Admin\Services\Add::api/submit');

$routes->get('admin/services/edit/([0-9]+)', 'Admin\Services\Edit::index/$1');
$routes->post('api/admin/services/([0-9]+)', 'Admin\Services\Edit::api/submit/$1');

$routes->get('admin/services', 'Admin\Services\Home::index');
$routes->get('api/admin/services', 'Admin\Services\Home::api/getItems');
$routes->get('api/admin/services/total', 'Admin\Services\Home::api/getTotal');

$routes->get('admin/services/view/([0-9]+)', 'Admin\Services\View::index/$1');
$routes->post('api/admin/services/([0-9]+)/status', 'Admin\Services\View::api/toggleStatus/$1');

// admin - services - categories
$routes->get('admin/services/categories/add', 'Admin\Services\Categories\Add::index');
$routes->post('api/admin/services/categories', 'Admin\Services\Categories\Add::api/submit');

$routes->get('admin/services/categories/edit/([0-9]+)', 'Admin\Services\Categories\Edit::index/$1');
$routes->put('api/admin/services/categories/([0-9]+)', 'Admin\Services\Categories\Edit::api/submit/$1');

$routes->get('admin/services/categories', 'Admin\Services\Categories\Home::index');
$routes->get('api/admin/services/categories', 'Admin\Services\Categories\Home::api/getItems');
$routes->get('api/admin/services/categories/all', 'Admin\Services\Categories\Home::api/getAll');
$routes->get('api/admin/services/categories/total', 'Admin\Services\Categories\Home::api/getTotal');

$routes->post('api/admin/services/categories/([0-9]+)/status', 'Admin\Services\Categories\View::api/toggleStatus/$1');

// admin - technologies
$routes->get('admin/technologies/add', 'Admin\Technologies\Add::index');
$routes->post('api/admin/technologies', 'Admin\Technologies\Add::api/submit');

$routes->get('admin/technologies/edit/([0-9]+)', 'Admin\Technologies\Edit::index/$1');
$routes->post('api/admin/technologies/([0-9]+)', 'Admin\Technologies\Edit::api/submit/$1');

$routes->get('admin/technologies', 'Admin\Technologies\Home::index');
$routes->get('api/admin/technologies', 'Admin\Technologies\Home::api/getItems');
$routes->get('api/admin/technologies/total', 'Admin\Technologies\Home::api/getTotal');

$routes->get('admin/technologies/view/([0-9]+)', 'Admin\Technologies\View::index/$1');
$routes->post('api/admin/technologies/([0-9]+)/status', 'Admin\Technologies\View::api/toggleStatus/$1');

// admin - technologies - categories
$routes->get('admin/technologies/categories/add', 'Admin\Technologies\Categories\Add::index');
$routes->post('api/admin/technologies/categories', 'Admin\Technologies\Categories\Add::api/submit');

$routes->get('admin/technologies/categories/edit/([0-9]+)', 'Admin\Technologies\Categories\Edit::index/$1');
$routes->put('api/admin/technologies/categories/([0-9]+)', 'Admin\Technologies\Categories\Edit::api/submit/$1');

$routes->get('admin/technologies/categories', 'Admin\Technologies\Categories\Home::index');
$routes->get('api/admin/technologies/categories', 'Admin\Technologies\Categories\Home::api/getItems');
$routes->get('api/admin/technologies/categories/all', 'Admin\Technologies\Categories\Home::api/getAll');
$routes->get('api/admin/technologies/categories/total', 'Admin\Technologies\Categories\Home::api/getTotal');

$routes->post('api/admin/technologies/categories/([0-9]+)/status', 'Admin\Technologies\Categories\View::api/toggleStatus/$1');

// admin - teams
$routes->get('admin/teams/add', 'Admin\Teams\Add::index');
$routes->post('api/admin/teams', 'Admin\Teams\Add::api/submit');

$routes->get('admin/teams/edit/([0-9]+)', 'Admin\Teams\Edit::index/$1');
$routes->post('api/admin/teams/([0-9]+)', 'Admin\Teams\Edit::api/submit/$1');

$routes->get('admin/teams', 'Admin\Teams\Home::index');
$routes->get('api/admin/teams', 'Admin\Teams\Home::api/getItems');
$routes->get('api/admin/teams/total', 'Admin\Teams\Home::api/getTotal');

$routes->get('admin/teams/view/([0-9]+)', 'Admin\Teams\View::index/$1');
$routes->post('api/admin/teams/([0-9]+)/status', 'Admin\Teams\View::api/toggleStatus/$1');

// admin - testimonials
$routes->get('admin/testimonials/add', 'Admin\Testimonials\Add::index');
$routes->post('api/admin/testimonials', 'Admin\Testimonials\Add::api/submit');

$routes->get('admin/testimonials/edit/([0-9]+)', 'Admin\Testimonials\Edit::index/$1');
$routes->post('api/admin/testimonials/([0-9]+)', 'Admin\Testimonials\Edit::api/submit/$1');

$routes->get('admin/testimonials', 'Admin\Testimonials\Home::index');
$routes->get('api/admin/testimonials', 'Admin\Testimonials\Home::api/getItems');
$routes->get('api/admin/testimonials/total', 'Admin\Testimonials\Home::api/getTotal');

$routes->get('admin/testimonials/view/([0-9]+)', 'Admin\Testimonials\View::index/$1');
$routes->post('api/admin/testimonials/([0-9]+)/status', 'Admin\Testimonials\View::api/toggleStatus/$1');

// admin - users
$routes->get('admin/users/add', 'Admin\Users\Add::index');
$routes->post('api/admin/users', 'Admin\Users\Add::api/submit');

$routes->get('admin/users/edit/([0-9]+)', 'Admin\Users\Edit::index/$1');
$routes->put('api/admin/users/([0-9]+)', 'Admin\Users\Edit::api/submit/$1');

$routes->get('admin/users', 'Admin\Users\Home::index');
$routes->get('api/admin/users', 'Admin\Users\Home::api/getItems');
$routes->get('api/admin/users/total', 'Admin\Users\Home::api/getTotal');

$routes->get('admin/users/view/([0-9]+)', 'Admin\Users\View::index/$1');
$routes->post('api/admin/users/([0-9]+)/activate', 'Admin\Users\View::api/activate/$1');
$routes->post('api/admin/users/([0-9]+)/status', 'Admin\Users\View::api/toggleStatus/$1');

// admin - Case Studies
$routes->get('admin/casestudies', 'Admin\Casestudy\Home::index');
$routes->get('api/admin/casestudies', 'Admin\Casestudy\Home::api/getItems');
$routes->get('api/admin/casestudies/total', 'Admin\Casestudy\Home::api/getTotal');

$routes->get('admin/casestudy/add', 'Admin\Casestudy\Add::index');
$routes->post('api/admin/casestudies', 'Admin\Casestudy\Add::api/submit');

$routes->get('admin/casestudy/view/([0-9]+)', 'Admin\Casestudy\View::index/$1');
$routes->post('api/admin/casestudy/([0-9]+)/status', 'Admin\Casestudy\View::api/toggleStatus/$1');

$routes->get('admin/casestudy/edit/([0-9]+)', 'Admin\Casestudy\Edit::index/$1');
$routes->post('api/admin/casestudy/([0-9]+)', 'Admin\Casestudy\Edit::api/submit/$1');