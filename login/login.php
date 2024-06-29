<?php

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if credentials are empty
    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Please enter both username and password.']);
        exit();
    }

    // Endpoint to post the login credentials
    $endpoint = 'https://api.onedivinesingularity.com/login';

    // Create POST request body
    $data = [
        'login' => $username,
        'password' => $password
    ];

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data)
    ]);

    // Execute cURL request
    $response = curl_exec($curl);

    // Check for cURL errors
    if (curl_errno($curl)) {
        echo json_encode(['success' => false, 'message' => 'cURL Error: ' . curl_error($curl)]);
        curl_close($curl);
        exit();
    }

    // Close cURL session
    curl_close($curl);

    // Decode JSON response
    $responseData = json_decode($response, true);

    // Check if response is valid JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(['success' => false, 'message' => 'Invalid response from server.']);
        exit();
    }

    // Check if login was successful
    if (isset($responseData['status']) && $responseData['status'] === 'success') {
        // Set session variable for admin

        setcookie("farzad_admin", "1234567890", time() + 86400, "/");

        // Return JSON response for success
        echo json_encode(['success' => true]);
        // exit();
    } else {
        // If server provided error message, use it
        $message = isset($responseData['message']) ? $responseData['message'] : 'Invalid username or password. Please try again.';
        echo json_encode(['success' => false, 'message' => $message]);
    }
} else {
    // Return JSON response for invalid request
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
