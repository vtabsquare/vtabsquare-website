<?php

// home
$routes->get('/', 'Home::index');

$a = [
    'about',
    'about/journey',
    'privacy',
    'terms'
];

foreach ($a as $b) {
    $routes->get($b, 'Page::index');
}

// career
$routes->get('career', 'Career::index');
$routes->post('api/career', 'Career::api/submit');

// contact
$routes->get('contact', 'Contact::index');
$routes->post('api/contact', 'Contact::api/submit');

// account - home
$routes->get('account', 'Account\Home::index');

// account - login
$routes->get('account/login', 'Account\Login::index');
$routes->post('api/account/login', 'Account\Login::api/submit');

// account - logout
$routes->get('account/logout', 'Account\Logout::index');

// account - register
$routes->get('account/register', 'Account\Register::index');
$routes->post('api/account/register', 'Account\Register::api/submit');

// account - activate - email
$routes->get('account/activate/email/([a-fA-F0-9]{256})', 'Account\Email\Activate::index/$1');
$routes->post('api/account/activate/email/([a-fA-F0-9]{256})', 'Account\Email\Activate::api/verify/$1');

// account - activate - resend
$routes->get('account/activate/resend', 'Account\Activate\Resend::index');
$routes->post('api/account/activate/resend', 'Account\Activate\Resend::api/submit');

// account - email - home
$routes->get('account/email', 'Account\Email\Home::index');
$routes->post('api/account/email', 'Account\Email\Home::api/submit');

// account - email - update
$routes->get('account/email/update', 'Account\Email\Update::index');
$routes->post('api/account/email/update', 'Account\Email\Update::api/submit');

// account - password - create
$routes->get('account/password/create', 'Account\Password\Create::index');
$routes->post('api/account/password/create', 'Account\Password\Create::api/submit');

// account - password - forgot
$routes->get('account/password/forgot', 'Account\Password\Forgot::index');
$routes->post('api/account/password/forgot', 'Account\Password\Forgot::api/submit');

// account - password - home
$routes->get('account/password', 'Account\Password\Home::index');
$routes->post('api/account/password', 'Account\Password\Home::api/submit');

// account - password - reset
$routes->get('account/password/reset/([a-fA-F0-9]{256})', 'Account\Password\Reset::index/$1');
$routes->post('api/account/password/reset/([a-fA-F0-9]{256})', 'Account\Password\Reset::api/verify/$1');

// account - password - update
$routes->get('account/password/update', 'Account\Password\Update::index');
$routes->post('api/account/password/update', 'Account\Password\Update::api/submit');

// blogs
$routes->get('blogs/category/([0-9]+)', 'Blogs\Category::index/$1');
$routes->get('api/blogs/category/([0-9]+)/pagination', 'Blogs\Category::api/getPagination/$1');

$routes->get('blogs', 'Blogs\Home::index');
$routes->get('api/blogs/pagination', 'Blogs\Home::api/getPagination');

$routes->get('blogs/item/([0-9]+)', 'Blogs\Item::index/$1');

// photos
$routes->get('photos/category/([0-9]+)', 'Photos\Category::index/$1');
$routes->get('api/photos/category/([0-9]+)/pagination', 'Photos\Category::api/getPagination/$1');

$routes->get('photos', 'Photos\Home::index');
$routes->get('api/photos/pagination', 'Photos\Home::api/getPagination');

$routes->get('photos/item/([0-9]+)', 'Photos\Item::index/$1');

// services
$routes->get('services/category/([0-9]+)', 'Services\Category::index/$1');
$routes->get('api/services/category/([0-9]+)/pagination', 'Services\Category::api/getPagination/$1');

$routes->get('services', 'Services\Home::index');
$routes->get('api/services/pagination', 'Services\Home::api/getPagination');

$routes->get('services/item/([0-9]+)', 'Services\Item::index/$1');

// technologies
$routes->get('technologies/category/([0-9]+)', 'Technologies\Category::index/$1');
$routes->get('api/technologies/category/([0-9]+)/pagination', 'Technologies\Category::api/getPagination/$1');

$routes->get('technologies', 'Technologies\Home::index');
$routes->get('api/technologies/pagination', 'Technologies\Home::api/getPagination');

$routes->get('technologies/item/([0-9]+)', 'Technologies\Item::index/$1');
