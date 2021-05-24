<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 00:51
 */
include_once "app/Conexion.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";

ControldeSesion::cerrar_sesion();
Redireccion::redirigir(Ruta_Login);