<?php
session_start();

// Application helper classes
require_once('application/helper/conf.php');       // App globals and config
require_once('application/helper/common.php');     // Helper functions
require_once('application/helper/connection.php'); // Manage database connection
require_once('application/helper/password.php');   // Simplified password hashing API
require_once('application/helper/request.php');    // Abstracts the access to $_GET, $_POST and $_COOKIE
require_once('application/helper/session.php');    // Handles the session stuff

// Go to login screen if no controller or action is set
if ( isset($_GET['controller']) && isset($_GET['action']) ) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
} else {
    $controller = 'account';
    $action     = 'index';
}

// Main site layout
if (is_ajax()) {
    require_once('application/lib/routes.php'); // If ajax request go directly to routes
} else {
    require_once('application/views/layout.php');
}

?>