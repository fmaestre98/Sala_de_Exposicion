<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 21:16
 */
include_once "app/Conexion.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";
include_once "app/RepositorioSalas.inc.php";
include_once "app/RepositorioArtefactos.inc.php";


if (!ControldeSesion::session_iniciada()){
    Redireccion::redirigir(Ruta_Login);
}

if (isset($_POST["eliminar_sala"])){

    Conexion::abrir_Conexion();

    //borrar imagenes y videos de los artefactos de la sala eliminada
    $artefactos=array();
    $artefactos=RepositorioArtefactos::obtener_Artefactos_por_Sala(Conexion::obtener_Conexion(),$_POST["id_sala"]);

    if(count($artefactos)>0){
        foreach($artefactos as $art){
            unlink(Directorio_Raiz."/public/videos/".$art->getVideo());
            unlink(Directorio_Raiz."/public/imagenes/".$art->getImagen());
        }
    }



    RepositorioSalas::Eliminar_Sala(Conexion::obtener_Conexion(),$_POST["id_sala"]);

    Conexion::cerrar_Conexion();



}
Redireccion::redirigir(Servidor);