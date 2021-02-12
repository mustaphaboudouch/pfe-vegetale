<?php

	class DatabaseUser {
		
		private static $dbHost = "localhost";
		private static $dbName = "VG";
		private static $dbUser = "root";
		private static $dbUserPassword = "";

		private static $connection = null;

		public static function connect() {
			try {
				self::$connection = new PDO("mysql: host=" . self::$dbHost . "; dbname=" . self::$dbName.";charset=utf8", self::$dbUser, self::$dbUserPassword);
			} catch (PDOException $e) {
				die($e->getMessage());
			}
			return self::$connection;
		}

		public static function disconnect() {
			self::$connection = null;
		}
	}

?>