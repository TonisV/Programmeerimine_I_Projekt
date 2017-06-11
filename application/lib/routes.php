<?php

function call($controller, $action) {
    require_once('application/controllers/'.$controller.'_controller.php');

    switch ($controller) {
        case 'pages':
            $controller = new Pages_Controller();
            break;

        case 'account':
            require_once('application/model/user.php');
            require_once('application/model/account.php');
            $controller = new Account_Controller();
            break;

        case 'worksheet':
            require_once('application/model/worksheet.php');
            $controller = new Worksheet_Controller();
            break;

    }
    $controller->{$action}();
}

$controllers = array(
    'pages'     => ['index', 'error'],
    'account'   => ['index', 'login', 'logout', 'settings'],
    'worksheet' => ['index', 'insert', 'update', 'delete'],
);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {

        // Allow only logged in users to view pages
        if(!Session::get('is_logged_in')){
            call('account', 'login');
        } else {
            call($controller, $action);
        }

    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}