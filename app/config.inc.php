<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 10/9/2020
 * Time: 21:35
 */

//DB
define("nombre_servidor","localhost");
define("usuario","root");
define("contrasenia","");
define("nombre_base_de_datos","salas");


$server=$_SERVER["HTTP_HOST"];

$componentes_url=parse_url($_SERVER["REQUEST_URI"]);

$ruta=$componentes_url["path"];

$partes_ruta=explode("/",$ruta);
$partes_ruta=array_filter($partes_ruta);

$partes_ruta=array_slice($partes_ruta,0);

if(isset($partes_ruta[0]) && $partes_ruta[0]=="salas_app"){
$server.="/salas_app";
}


//rutas
define("Servidor","http://$server/");

define("Ruta_Login",Servidor."login");

define("Ruta_Actualizar",Servidor."actualizar");
define("Ruta_Logout",Servidor."logout");
define("Ruta_Registro_Correcto",Servidor."registro_correcto");
define("Ruta_Editar_Sala",Servidor."sala/");
define("Ruta_Borrar_Sala",Servidor."borrar_sala");
define("Ruta_Borrar_Artefacto",Servidor."borrar_artefacto");
define("Ruta_Editar_Artefacto",Servidor."editar_artefacto/");
define("Ruta_Crear_Artefacto",Servidor."crear_artefacto/");
define("Ruta_Ver_Artefacto",Servidor."ver_artefacto/");
define("Ruta_Crear_Sala",Servidor."crear_sala");
define("Ruta_Editar_Datos_Sala",Servidor."editar_sala/");



//rutas API//

define("Ruta_Obtener_Todo",Servidor."api/v1/todo");
define("Ruta_Obtener_Todo_Salas",Servidor."api/salas/todo");
define("Ruta_Obtener_Todo_artefactos",Servidor."api/artefactos/todo");
define("Ruta_Obtener_Artefacto_QR",Servidor."api/qr/#_#");
define("Ruta_Obtener_Artefacto_ID",Servidor."api/id/#");




define("Directorio_Raiz",realpath(dirname(__FILE__)."/.."));

//recursos
define("Ruta_CSS",Servidor."css/");
define("Ruta_js",Servidor."js/");


//utils
define("Tam_Max_Video",32000000);
define("Tam_Max_Imagen",2100000);