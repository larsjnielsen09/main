<?php
require_once __DIR__ . '/router.php';
// Define your routes here using the get(), post(), etc. functions from router.php

get('/', 'views/index.php');
get('/user/$id', 'views/user.php');
get('/contact', 'controllers/contact_us.php');
put('/user/$id', 'views/update_user.php');

// Callback Function
get('/about', function () {
    echo "This is the About page";
});

get('/callback', function () {
    echo 'Callback executed';
});

get('/test', function () {
    echo 'This is a test page!';
});

get('/callback/$name/$last_name', function ($name, $last_name) {
    echo "Callback executed. The full name is $name $last_name";
});

get('/callback/$name', function ($name) {
    echo "Callback executed. The name is $name";
});

get('/product/$type/color/$color', 'views/product.php');

post(
    '/submit',
    function () {
        // Access POST data
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Process the data
        echo "Received:" . "</br>" .  "Username: $username" . "</br>" . "Password: $password";
    }
);

// ... (define more routes) ...

any('/404', 'views/404.php');
