<?php
session_start();

require_once 'models/UserModel.php';
$userModel = new UserModel();

// Check if CSRF token exists and matches
if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
    die('Invalid CSRF token. Operation denied.');
}

// Check if user ID is provided
if (!empty($_GET['id'])) {
    $userId = $_GET['id'];

    // Delete user by ID (optional: add authorization checks)
    $userModel->deleteUserById($userId);

    // After successful deletion, redirect back to the list
    header('Location: list_users.php');
} else {
    die('User ID is required for deletion.');
}
// Optional: Check if the logged-in user has permission to delete
if ($_SESSION['user_role'] !== 'admin') {
    die('You do not have permission to delete users.');
}

?>

