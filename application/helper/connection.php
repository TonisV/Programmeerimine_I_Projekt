<?php
class Db {
	private static $instance = NULL;

	public static function getInstance() {

		if (!isset(self::$instance)) {
	

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			self::$instance = new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_pass, $pdo_options);
		}
		return self::$instance;
	}
}