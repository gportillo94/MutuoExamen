<?php  

	class Documento{
		public $idDocumento = 0;
		public $idTipoDocumento = 0;
		public $nombre = '';
		public $contenido = '';
		
		public function SetFromRequest($diccDocumento){
			$this->idTipoDocumento = $diccDocumento["idTipoDocumento"];
			$this->nombre = $diccDocumento["nombre"];
			$this->contenido = $diccDocumento["contenido"];
		}

		public function SetFromDB($dbDocumento){
			$this->idDocumento = $dbDocumento["IdDocumento"];
			$this->idTipoDocumento = $dbDocumento["FK_IdTipoDocumento"];
			$this->nombre = $dbDocumento["Nombre"];
		}
	}

?>