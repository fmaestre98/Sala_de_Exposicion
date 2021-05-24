<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 00:36
 */

class Redireccion
{

    public static function redirigir($url){

    header("Location: ".$url,true,301);
    exit();
    }

}