<?php

	class Usuario {
		public $idUsuario = 0;
		public $username = '';
		public $password = '';

		public function SetFromDB($dbUsuario){
			$this->username = $dbUsuario["Username"];
			$this->idUsuario = $dbUsuario["IdUsuario"];
			$this->password = $dbUsuario["Password"];
		}

		public function PasswordCorrecto($passwordRequest){
			return $this->password == $passwordRequest;
		}

	}

?>