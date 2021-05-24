<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 02:04
 */
header($_SERVER["SERVER_PROTOCOL"]."404 Not found",true,404);
$title="404";
include_once "plantillas/cabecera.inc.php";
echo "<h1 class='text-center' style='margin-top: 90px'>La Página no existe</h1>";