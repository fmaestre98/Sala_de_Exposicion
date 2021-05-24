<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 00:25
 */

class ControldeSesion
{

    public static function iniciar_sesion($id_usuario,$nombre_usuario){

        if (session_id()==""){
           session_start();
        }
         $_SESSION["id_usuario"]=$id_usuario;
        $_SESSION["nombre_usuario"]=$nombre_usuario;
    }

    public static function cerrar_sesion(){
        if (session_id()==""){
            session_start();
        }

        if (isset($_SESSION["id_usuario"])){
            unset($_SESSION["id_usuario"]);
        }


        if (isset($_SESSION["nombre_usuario"])){
            unset($_SESSION["nombre_usuario"]);
        }

     session_destroy();
    }

    public static function session_iniciada(){
        if (session_id()==""){
            session_start();
        }

        if (isset($_SESSION["id_usuario"]) && isset($_SESSION["nombre_usuario"]) ){
            return true;
        }else{
            return false;
        }




    }

}