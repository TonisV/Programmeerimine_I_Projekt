<?php
session_start();

// Application helper classes
require_once('application/helper/connection.php'); // Manage database connection
require_once('application/helper/password.php');   // Simplified password hashing API
require_once('application/helper/request.php');    // Abstracts the access to $_GET, $_POST and $_COOKIE
require_once('application/helper/session.php');    // Handles the session stuff

// Go to login screen if no action is set
if ( isset($_GET['controller']) && isset($_GET['action']) ) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'login';
    $action     = 'index';
}

// Main site layout
require_once('application/views/layout.php');
?>