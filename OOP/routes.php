<?php
// Create a new Router instance
$router = new Router();

// Define routes
$router->get('/', function () {
    echo "Welcome to the homepage3!";
});

// Callback Function
$router->get('/about', function () {
    echo "This is the About page";
});
// This will output "This is the About page" when '/about' is visited

$router->get('/user/$id', function ($id) {
    echo "User profile for ID: " . $id;
});

$router->post('/submit', function () {
    // Access POST data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Process the data
    echo "Received:" . "</br>" .  "Username: $username" . "</br>" . "Password: $password";
});

// File Path Notation
$router->get('/contact-us', 'views/contact_us.php');
// This will execute the code in 'views/contact_us.php' when '/contact-us' is visited

$router->put('/user/$id', 'views/update_user.php');

// Return the router instance
return $router;
