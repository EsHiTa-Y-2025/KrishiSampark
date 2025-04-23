<?php
session_start();

if (isset($_POST['language'])) {
    $language = $_POST['language'];

    // You can store the selected language in the session variable
    $_SESSION['selected_language'] = $language;

    // You can also perform other actions related to language selection here

    // Send a response back to the client
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Language not provided']);
}