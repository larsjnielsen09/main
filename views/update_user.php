<?php
// update_user.php

// Get the user ID from the URL parameter
$userId = $id ?? null; // $id should be provided by the router

if (!$userId) {
    http_response_code(400);
    echo json_encode(['error' => 'User ID is required']);
    exit;
}

// Since PHP doesn't parse PUT request bodies automatically,
// we need to get the raw input and parse it ourselves
$putData = file_get_contents('php://input');
$data = json_decode($putData, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON data']);
    exit;
}

// Validate the data (example validation)
$requiredFields = ['name', 'email'];
foreach ($requiredFields as $field) {
    if (!isset($data[$field]) || empty($data[$field])) {
        http_response_code(400);
        echo json_encode(['error' => "Missing required field: $field"]);
        exit;
    }
}

// Here you would typically interact with your database
// For this example, we'll just pretend we updated the user
try {
    // Simulate database update
    // In a real application, you would update the user in your database here
    $updatedUser = [
        'id' => $userId,
        'name' => $data['name'],
        'email' => $data['email'],
        // Include other fields as necessary
    ];

    // Send a success response
    http_response_code(200);
    echo json_encode([
        'message' => 'User updated successfully',
        'user' => $updatedUser
    ]);
} catch (Exception $e) {
    // Handle any errors
    http_response_code(500);
    echo json_encode(['error' => 'Failed to update user: ' . $e->getMessage()]);
}
