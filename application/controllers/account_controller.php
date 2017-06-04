<?php
class Account_Controller {

    function index() {
        require_once('application/views/account/index.php');
    }

    function login() {
        $user = Account_Model::login(
            Request::post('user_name'),
            Request::post('user_password')
        );
        if ($user) {
            header('Location: '.APP_URL.'?controller=worksheet&action=index');
        } else {
            self::index();
        }
    }

    function logout() {
        Account_Model::logout();
        header('Location: '.APP_URL);
        exit();
    }

}
?>