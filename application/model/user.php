<?php
class User_Model {

    // User parameters
    public $id;
    public $name;
    public $email;
    public $status;
    public $user_registered;

    public function __construct($id, $name, $email, $status, $user_registered) {
        $this->id              = $id;
        $this->name            = $name;
        $this->email           = $email;
        $this->status          = $status;
        $this->user_registered = $user_registered;
    }

    // Get user from database by username
    public static function get_user_by_username($name) {

        $db = Db::get_instance();

        $sql = "SELECT ID, user_login, user_email, user_pass, user_registered, user_status FROM tv_users WHERE user_login = :name LIMIT 1";

        $query = $db->prepare($sql);

        $query->execute(array(':name' => $name));

        $user_data = $query->fetch();

        return $user_data;

    }

}
?>