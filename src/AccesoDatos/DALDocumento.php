<?php

	include_once("DAL.php");

	class DALDocumento extends DAL{

		private $PATH = 'C:\\Users\\Gilberto\\Desktop\\';
		private $SELECT_FROM_TipoDocumento = "SELECT * FROM TipoDocumento ";
		private $SELECT_FROM_Documento = "SELECT * FROM Documento WHERE Activo = 1 ";
		private $INSERT_Documento = "INSERT INTO Documento (Fk_IdUsuario, Fk_idtipodocumento, Nombre, Activo) VALUES (:idUsuario, :idTipoDocumento, :nombre, 1)";

		public function __construct() {
     	   parent::__construct();
    	}
	    
	    public function ConsultarTiposDocumento(){
			$stmt = $this->pdo->query($this->SELECT_FROM_TipoDocumento);
			$tipos = [];
			while($dbTipo = $stmt->fetch()){
				$tipoDoc = new TipoDocumento();
				$tipoDoc->SetFromDB($dbTipo);
				array_push($tipos, $tipoDoc);
			}
			return $tipos;
		}

		public function ActualizarDocumento($documento){
			
		}

		public function GuardarDocumento($documento){
			$data = base64_decode( $documento->contenido );
			file_put_contents( $this->PATH . $documento->nombre , $data);
			print_r($documento);
			$stmt = $this->pdo->prepare($this->INSERT_Documento);
			$stmt->bindParam(':idUsuario', $idUsuario);
			$stmt->bindParam(':idTipoDocumento', $idTipoDocumento);
			$stmt->bindParam(':nombre', $nombre);
			$idUsuario = 1;
			$idTipoDocumento = $documento->idTipoDocumento;
			$nombre = $documento->nombre;
			$stmt->execute();
		}

		public function ConsultarDocumentos($idUsuario){
			$stmt = $this->pdo->query($this->SELECT_FROM_Documento . " AND Fk_IdUsuario = " . $idUsuario);
			$documentos = [];
			while($dbDoc = $stmt->fetch()){
				$doc = new Documento();
				$doc->SetFromDB($dbDoc);
				array_push($documentos, $doc);
			}
			return $documentos;	
		}

		public function ConsultarDocumento($idDocumento){
			$stmt = $this->pdo->query($this->SELECT_FROM_Documento . " AND IdDocumento = " . $idDocumento);
			$dbDocumento = $stmt->fetch();
			if($dbDocumento){
				$data = file_get_contents($this->PATH . $dbDocumento["Nombre"]);
				$doc = new Documento();
				$doc->SetFromDB($dbDocumento);
				$doc->contenido = base64_encode($data);
				return $doc;
			}
			return null;
		}

	}

?>
