<?php

class Account_Model {

    public static function login($name, $pass) {

        if (empty($name) OR empty($pass)) {
            return false;
        }

        $valid_user = self::validate_and_get_user($name, $pass);

        if(!$valid_user) {
            return false;
        }

        self::set_session_login($valid_user['ID'], $valid_user['user_login'], $valid_user['user_email']);

        return $valid_user;
    }

    private static function set_session_login($id, $name, $email) {

        Session::init();

        session_regenerate_id(true);
        $_SESSION = array();

        Session::set('user_id', $id);
        Session::set('user_name', $name);
        Session::set('user_email', $email);

        Session::set('is_logged_in', true);

        Session::update_session_id($id, session_id());

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

    private static function validate_and_get_user($name, $pass) {
        $user = User_Model::get_user_by_username($name);

        if(!$user) {
            return false;
        }

        if(!password_verify($pass, $user['user_pass'])) {
            return false;
        }

        return $user;
    }

    public static function logout() {
        $user_id = Session::get('user_id');

        Session::destroy();
        Session::update_session_id($user_id);
    }

    public static function is_logged_in() {
        return Session::user_is_logged_in();
    }

}

?>