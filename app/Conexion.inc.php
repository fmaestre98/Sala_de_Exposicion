<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 10/9/2020
 * Time: 21:44
 */

class Conexion
{
private static $conexion;

public static function abrir_Conexion(){
    if (!isset(self::$conexion)){
      try{
      include_once "config.inc.php";

      self::$conexion=new PDO("mysql:host=".nombre_servidor.";dbname=".nombre_base_de_datos,usuario,contrasenia);
      self::$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      self::$conexion->exec("SET CHARACTER SET utf8");


      }catch (Exception $ex){
     print "Error". $ex->getMessage()."<br>";
     die();
        }
    }
}

public static function cerrar_Conexion(){
    if (isset(self::$conexion)){

        self::$conexion=null;
    }
}
public static function obtener_Conexion(){

    return self::$conexion;
}

}