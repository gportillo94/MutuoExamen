<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use \Firebase\JWT\JWT;

include_once("Modelos/Usuario.php");
include_once("Modelos/TipoDocumento.php");
include_once("Modelos/Documento.php");
include_once("Modelos/Autenticacion.php");
include_once("AccesoDatos/DAL.php");
include_once("AccesoDatos/DALUsuario.php");
include_once("AccesoDatos/DALDocumento.php");

return function (App $app) {

    $container = $app->getContainer();

    $app->get('/index', function (Request $request, Response $response, array $args) use ($container) {
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });

    $app->post('/login', function (Request $request, Response $response, array $args) {
        $dalUsuario = new DALUsuario();
        $body = $request->getParsedBody();
        $usuario = $dalUsuario->ConsultarUsuario($body["username"]);
        $autenticacion = new  Autenticacion();
        if($usuario == null){
            $autenticacion->mensaje = "Usuario no existe";
            return json_encode($autenticacion);
        }
        else if (!$usuario->PasswordCorrecto($body["password"])){
            $autenticacion->mensaje = "Contraseña incorrecta";
            return json_encode($autenticacion);
        }
        else{
            $settings = $this->get('settings'); 
            $token = JWT::encode($usuario, $settings['jwt']['secret'], "HS256");
            $autenticacion->token =  JWT::encode($usuario, $settings['jwt']['secret'], "HS256");
            $autenticacion->autenticadoCorrecto = true;
            return json_encode($autenticacion);
        }
	});

    $app->group('/api', function(\Slim\App $app) {

        $app->get('/tiposDocumento', function (Request $request, Response $response, array $args) {
            $dalDocs = new DALDocumento();
            $tipos = $dalDocs->ConsultarTiposDocumento(); 
            return json_encode($tipos);
        });

        $app->get('/documento', function (Request $request, Response $response, array $args) {
            $dalDocs = new DALDocumento();
            $idUsuario = 1;
            $documentos = $dalDocs->ConsultarDocumentos($idUsuario); 
            return json_encode($documentos);
        });

        $app->get('/documento/{idDocumento}', function (Request $request, Response $response, array $args) {
            $dalDocs = new DALDocumento();
            $idDocumento = $request->getAttribute('route')->getArgument('idDocumento');
            $doc = $dalDocs->ConsultarDocumento($idDocumento);
            return json_encode($doc);
        });

        $app->post('/documento', function (Request $request, Response $response, array $args) {
            $dalDocs = new DALDocumento();
            $documento = new Documento();
            $documento->SetFromRequest($request->getParsedBody());
            $dalDocs->GuardarDocumento($documento);
            return json_encode($documento);
        });
   
    });

};
