<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 10/9/2020
 * Time: 22:07
 */

class RepositorioUsuario
{
public static function obtenerTodos($conexion){
    $usuarios=array();

    if (isset($conexion)){
        try{
            include_once "Usuario.inc.php";

            $sql="Select * from usuario";
            $sentencia=$conexion->prepare($sql);
            $sentencia->execute();
            $resultado=$sentencia->fetchAll();

            if (count($resultado)){
                foreach ($resultado as $fila){
                    $usuarios[]=new Usuario($fila["id"],$fila["username"],$fila["contrasenia"]);

                }

            }else{
                print "No hay usuarios"."<br>";
            }

        }catch (Exception $ex){
            print "Error". $ex->getMessage()."<br>";
            die();
        }

    }
  return $usuarios;
}


public static function insertar_Usuario($conexion,$usuario){
 $usuario_insertado=false;
    if (isset($conexion)){
        try{
            include_once "Usuario.inc.php";

            $sql="INSERT INTO  usuario(username,contrasenia) VALUES (:username, :contrasenia)";
            $sentencia=$conexion->prepare($sql);

            $sentencia->bindParam(":username",$usuario->getUsuario(),PDO::PARAM_STR);
            $sentencia->bindParam(":contrasenia",$usuario->getContrasenia(),PDO::PARAM_STR);

            $usuario_insertado=$sentencia->execute();




        }catch (Exception $ex){
            print "Error". $ex->getMessage()."<br>";
            die();
        }

    }
return $usuario_insertado;

}


public static function obtener_Usuario($conexion,$username){
$usuario=null;

if (isset($conexion)){
    try{
        include_once "Usuario.inc.php";

        $sql="Select * from usuario where username=:name ";
        $sentencia=$conexion->prepare($sql);

        $sentencia->bindParam(":name",$username,PDO::PARAM_STR);

        $sentencia->execute();

        $resultado=$sentencia->fetch();

        if (!empty($resultado)){
          $usuario=new Usuario($resultado["id"],$resultado["username"],$resultado["contrasenia"]);

        }

    }catch (Exception $ex){
        print "Error". $ex->getMessage()."<br>";
        die();
    }
}

return $usuario;
}

public static function actualizar_usuario($conexion,$id,$username,$clave){
    $actualizado=null;

    if (isset($conexion)){
        try{
       $sql="UPDATE usuario SET username=:username, contrasenia=:clave WHERE id=:id ";

       $sentencia=$conexion->prepare($sql);

       $sentencia->bindParam(":username",$username,PDO::PARAM_STR);
       $sentencia->bindParam(":clave",password_hash($clave,PASSWORD_BCRYPT),PDO::PARAM_STR);
       $sentencia->bindParam(":id",$id,PDO::PARAM_INT);

       $actualizado=$sentencia->execute();





        }catch (Exception $ex){
            print "Error". $ex->getMessage()."<br>";
            die();
        }



    }


return $actualizado;

}

}