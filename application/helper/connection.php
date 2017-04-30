<?php
class Db {
	private static $instance = NULL;

	public static function getInstance() {

		if (!isset(self::$instance)) {

            $conf = parse_ini_file('../../conf.ini');

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			self::$instance = new PDO('mysql:host='.$conf['dbhost'].';dbname='.$conf['dbname'], $conf['username'], $conf['password'], $pdo_options);
		}
		return self::$instance;
	}
}