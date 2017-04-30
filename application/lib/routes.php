<?php

function call($controller, $action) {
    require_once('application/controllers/'.$controller.'_controller.php');

    switch ($controller) {
        case 'pages':
            $controller = new PagesController();
            break;

        case 'account':
            require_once('application/model/user.php');
            require_once('application/model/account.php');
            $controller = new AccountController();
            break;

        case 'worksheet':
            $controller = new WorksheetController();
            break;

    }
    $controller->{$action}();
}

$controllers = array(
    'pages'     => ['index', 'error'],
    'account'   => ['index', 'login', 'logout', 'settings'],
    'worksheet' => ['index'],
);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}