<?php

	include_once("DAL.php");

	class DALUsuario extends DAL{

		public function __construct() {
     	   parent::__construct();
    	}
	    
	    public function ConsultarUsuario($username){
			$stmt = $this->pdo->query("SELECT * FROM Usuario WHERE Username = '" . $username . "' ");
			$dbUsuario = $stmt->fetch();
			if(!$dbUsuario){
				return null;
			}
			else {
				$usuario = new Usuario();
				$usuario->SetFromDB($dbUsuario);
				return $usuario;
			}
		}
	}

?>
