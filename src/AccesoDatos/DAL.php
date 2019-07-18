<?php

	class DAL{
		
		private  $config = [
			"db_host" => "127.0.0.1",
			"db_database" => "Prueba",
			"db_username" => "root",
			"db_password" => ""
		];
		protected $pdo = null;

		public function __construct(){
			$this->pdo = new PDO( 'mysql:host=' . $this->config["db_host"] . ';dbname=' . $this->config["db_database"],
				$this->config["db_username"],
				$this->config["db_password"],
				array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ) );
		}
	}
?>