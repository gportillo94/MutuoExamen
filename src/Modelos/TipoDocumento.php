<?php  

	class TipoDocumento{

		public $idTipoDocumento = 0;
		public $descripcion = '';

		public function SetFromDB($dbTipo){
			$this->idTipoDocumento = $dbTipo["IdTipoDocumento"];
			$this->descripcion = $dbTipo["Descripcion"];
		}
	}

?>