<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 12/9/2020
 * Time: 10:32
 */
include_once "app/Conexion.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";
include_once "app/RepositorioArtefactos.inc.php";

if (!ControldeSesion::session_iniciada()){
    Redireccion::redirigir(Ruta_Login);
}

if (isset($_POST["eliminar_artefacto"])){
    Conexion::abrir_Conexion();

    RepositorioArtefactos::Eliminar_Artefactos(Conexion::obtener_Conexion(),$_POST["id_artefacto"]);


    Conexion::cerrar_Conexion();

    unlink(Directorio_Raiz."/public/videos/".$_POST["video"]);
    unlink(Directorio_Raiz."/public/imagenes/".$_POST["imagen"]);
}
Redireccion::redirigir(Ruta_Editar_Sala.$_POST["id_sala"]);