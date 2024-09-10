<?php
// routes.php

// Assuming the Router class is already included

$router = new Router();

// Define routes
$router->get('/', 'views/index.php');
$router->get('/about-us', 'views/about_us.php');
$router->get('/contact-us', 'views/contact_us.php');

$router->get('/products', 'views/products.php');
$router->get('/products/$gender', 'views/products.php');

$router->post('/signup', 'controllers/signup.php');
$router->post('/login', 'controllers/login.php');

$router->get('/user/gender/$g', 'views/user.php');

$router->post('/user', 'controllers/create_user.php');

$router->delete('/item/$id', 'controllers/delete_item.php');

$router->any('/404', 'views/404.php');

// You can also define routes with callbacks
$router->get('/test', function () {
    echo 'This is a test page!';
});

// Return the router instance
return $router;
