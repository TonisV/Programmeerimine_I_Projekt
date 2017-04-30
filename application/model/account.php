<?php

class AccountModel {

    public static function login($name, $pass) {

        if (empty($name) OR empty($pass)) {
            return false;
        }

        $valid_user = self::validateAndGetUser($name, $pass);

        if(!$valid_user) {
            return false;
        }

        self::setSessionLogin($valid_user['ID'], $valid_user['user_login'], $valid_user['user_email']);

        return $valid_user;
    }

    private static function setSessionLogin($id, $name, $email) {

        Session::init();

        session_regenerate_id(true);
        $_SESSION = array();

        Session::set('id', $id);
        Session::set('name', $name);
        Session::set('email', $email);

        Session::set('logged_in', true);

        Session::updateSessionId($id, session_id());

        setcookie(
            session_name(),
            session_id(),
            time() + 604800,
            '/',
            '',
            false,
            true
        );
    }

    private static function validateAndGetUser($name, $pass) {
        $user = UserModel::getUserByUsername($name);

        if(!$user) {
            return false;
        }

        if(!password_verify($pass, $user['user_pass'])) {
            return false;
        }

        return $user;
    }

    public static function logout() {
        $user_id = Session::get('id');

        Session::destroy();
        Session::updateSessionId($user_id);
    }

    public static function isLoggedIn() {
        return Session::userIsLoggedIn();
    }

}

?>