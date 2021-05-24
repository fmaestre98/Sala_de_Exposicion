<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 16:36
 */
class RepositorioSalas{

    public static function insertar_Sala($conexion,$nombre,$nombre_ingles,$numero){
        $sala_insertado=false;
        if (isset($conexion)){
            try{
                include_once "Sala.inc.php";


                $sql="INSERT INTO  sala(nombre,nombre_ingles,numero,actualizado) VALUES (:nombre,:nombre_ingles,:numero,NOW())";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":nombre",$nombre,PDO::PARAM_STR);
                $sentencia->bindParam(":nombre_ingles",$nombre_ingles,PDO::PARAM_STR);

                $sentencia->bindParam(":numero",$numero,PDO::PARAM_INT);


                $sala_insertado=$sentencia->execute();




            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                die();
            }

        }
        return $sala_insertado;

    }

    public static function actualizar_sala($conexion,$id,$nombre,$nombre_ingles,$numero){
        $actualizado=null;

        if (isset($conexion)){
            try{


                $sql="UPDATE sala SET nombre=:nombre,nombre_ingles=:nombre_ingles,
                     numero=:numero,actualizado=NOW() WHERE id=:id ";

                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":nombre",$nombre,PDO::PARAM_STR);
                $sentencia->bindParam(":nombre_ingles",$nombre_ingles,PDO::PARAM_STR);

                $sentencia->bindParam(":numero",$numero,PDO::PARAM_INT);

                $sentencia->bindParam(":id",$id,PDO::PARAM_INT);

                $actualizado=$sentencia->execute();





            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                die();
            }



        }


        return $actualizado;

    }




    public static function obtenerTodos($conexion){
        $salas=array();

        if (isset($conexion)){
            try{
                include_once "Sala.inc.php";


                $sql="Select * from sala order by id";
                $sentencia=$conexion->prepare($sql);
                $sentencia->execute();
                $resultado=$sentencia->fetchAll();

                if (count($resultado)){
                    foreach ($resultado as $fila){
                        $salas[]=new Sala($fila["id"],$fila["nombre"],$fila["nombre_ingles"],$fila["numero"],$fila["actualizado"]);

                    }

                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                die();
            }

        }
        return $salas;
    }


    public static function obtener_Sala($conexion,$id){
        $sala=null;

        if (isset($conexion)){
            try{
                include_once "Sala.inc.php";

                $sql="Select * from sala where id=:id ";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":id",$id,PDO::PARAM_INT);

                $sentencia->execute();

                $resultado=$sentencia->fetch();

                if (!empty($resultado)){
                    $sala=new Sala($resultado["id"],$resultado["nombre"],$resultado["nombre_ingles"],$resultado["numero"],$resultado["actualizado"]);

                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                die();
            }
        }

        return $sala;
    }



    public static function Eliminar_Sala($conexion,$id){
      $res=null;

        if (isset($conexion)){
            try{
                $conexion->beginTransaction();
                $sql="Delete  from artefacto where id_sala=:id ";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":id",$id,PDO::PARAM_INT);

                $res=$sentencia->execute();



                $sql="Delete  from sala where id=:id ";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":id",$id,PDO::PARAM_INT);

                $res=$sentencia->execute();


                $conexion->commit();

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
               $conexion->rollBack();
                die();
            }
        }

        return $res;





    }


    public static function obtener_Sala_Nombre($conexion,$nombre){
        $sala=0;

        if (isset($conexion)){
            try{
                include_once "Sala.inc.php";

                $sql="Select * from sala where nombre=:nombre ";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":nombre",$nombre,PDO::PARAM_STR);

                $sentencia->execute();

                $resultado=$sentencia->fetch();

                if (!empty($resultado)){
                    $sala=count($resultado);

                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                die();
            }
        }

        return $sala;
    }

    public static function obtener_Sala_Nombre_Ingles($conexion,$nombre){
        $sala=0;

        if (isset($conexion)){
            try{
                include_once "Sala.inc.php";

                $sql="Select * from sala where nombre_ingles=:nombre ";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":nombre",$nombre,PDO::PARAM_STR);

                $sentencia->execute();

                $resultado=$sentencia->fetch();

                if (!empty($resultado)){
                    $sala=count($resultado);

                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                die();
            }
        }

        return $sala;
    }

    public static function obtener_Sala_Numero($conexion,$numero){
        $sala=0;

        if (isset($conexion)){
            try{
                include_once "Sala.inc.php";

                $sql="Select * from sala where numero=:numero";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":numero",$numero,PDO::PARAM_INT);

                $sentencia->execute();

                $resultado=$sentencia->fetch();

                if (!empty($resultado)){
                    $sala=count($resultado);

                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                die();
            }
        }

        return $sala;
    }





    public static function obtener_TodoAPI($conexion,$fecha=null){
        $salas=array();
        $sala=array();
        if (isset($conexion)){
            try{
                include_once "Sala.inc.php";
                include_once "Artefacto.inc.php";

                $sql="Select * from sala order by id";
                $sentencia=$conexion->prepare($sql);
                $sentencia->execute();
                $resultado=$sentencia->fetchAll();

                if (!empty($resultado) && count($resultado)){
                    foreach ($resultado as $fila){
                        $artefactos=RepositorioArtefactos::obtener_Artefactos_por_SalaAPI($conexion,$fila["id"],$fecha);
                        $sala["id"]=$fila["id"];
                        $sala["nombre_sala"]=$fila["nombre"];
                        $sala["nombre_ingles_sala"]=$fila["nombre_ingles"];
                        $sala["numero_sala"]=$fila["numero"];
                        $sala["actualizado_sala"]=$fila["actualizado"];
                         $sala["artefactos"]=$artefactos;
                        $salas[]=$sala;

                    }

                }

            }catch (Exception $ex){
                print "Error". $ex->getMessage()."<br>";
                die();
            }

        }
        return $salas;
    }

    public static function obtener_Salas_API($conexion,$fecha=null){
        $salas=array();
        $sala=array();
        if (isset($conexion)){
            try{
                include_once "Sala.inc.php";

                $sql="Select * from sala order by id";
                $sentencia=$conexion->prepare($sql);
                $sentencia->execute();
                $resultado=$sentencia->fetchAll();

                if (!empty($resultado) && count($resultado)){
                    foreach ($resultado as $fila){

                        $sala["id"]=$fila["id"];
                        $sala["nombre_sala"]=$fila["nombre"];
                        $sala["nombre_ingles_sala"]=$fila["nombre_ingles"];
                        $sala["numero_sala"]=$fila["numero"];
                        $sala["actualizado_sala"]=$fila["actualizado"];

                        $salas[]=$sala;

                    }

                }

            }catch (Exception $ex){
                print "Error". $ex->getMessage()."<br>";
                die();
            }

        }
        return $salas;
    }

}