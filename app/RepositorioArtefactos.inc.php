<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 19:27
 */
class RepositorioArtefactos{

    public static function insertar_Artefacto($conexion,$id_sala,$nombre,$video,$descripcion,$nombre_ingles,$descripcion_ingles,$imagen,$numero){
        $artefacto_insertado=null;

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $conexion->beginTransaction();
                //insertar artefacto
                $sql="INSERT INTO  artefacto(id_sala,nombre,nombre_ingles,video,imagen,descripcion,descripcion_ingles,numero,actualizado)
                                         VALUES (:id_sala,:nombre,:nombre_ingles,:video,:imagen,:descripcion,:descripcion_ingles,:numero,NOW())";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":id_sala",$id_sala,PDO::PARAM_INT);
                $sentencia->bindParam(":nombre",$nombre,PDO::PARAM_STR);
                $sentencia->bindParam(":video",$video,PDO::PARAM_STR);
                $sentencia->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
                $sentencia->bindParam(":nombre_ingles",$nombre_ingles,PDO::PARAM_STR);
                $sentencia->bindParam(":imagen",$imagen,PDO::PARAM_STR);
                $sentencia->bindParam(":descripcion_ingles",$descripcion_ingles,PDO::PARAM_STR);
                $sentencia->bindParam(":numero",$numero,PDO::PARAM_INT);

                $artefacto_insertado=$sentencia->execute();
                //obtener id artefacto insertado
                $sql="Select * from artefacto where nombre=:nombre and id_sala=:id_sala";
                $sentencia=$conexion->prepare($sql);
                $sentencia->bindParam(":id_sala",$id_sala,PDO::PARAM_INT);
                $sentencia->bindParam(":nombre",$nombre,PDO::PARAM_STR);

                $sentencia->execute();

                $resultado=$sentencia->fetch();

                $codqr=$resultado["id"]."_".$id_sala;

                //actualizar codigo qr en el artefacto "id_id_sala"
                $sql="UPDATE artefacto SET qr=:qr WHERE id=:id ";

                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":id",$resultado["id"],PDO::PARAM_INT);
                $sentencia->bindParam(":qr",$codqr,PDO::PARAM_STR);

                $actualizado=$sentencia->execute();




                $conexion->commit();


            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                $conexion->rollBack();
                die();
            }

        }
        return $resultado["id"];

    }


    public static function obtener_Artefactos_por_Sala($conexion,$id_sala){
        $artefactos=array();

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select * from artefacto where id_sala=:id_sala order by id ";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":id_sala",$id_sala,PDO::PARAM_INT);

                $sentencia->execute();

                $resultado=$sentencia->fetchAll();

                if (count($resultado)){
                    foreach ($resultado as $fila){
                        $artefactos[]=new Artefacto($fila["id"],$fila["id_sala"],$fila["nombre"],$fila["video"],$fila["qr"]
                            ,$fila["descripcion"],$fila["descripcion_ingles"],$fila["nombre_ingles"],$fila["imagen"],$fila["numero"],$fila["actualizado"]);
                    }
                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                $conexion->rollBack();
                die();
            }
        }

        return $artefactos;
    }




    public static function Eliminar_Artefactos($conexion,$id){
        $res=null;
        if (isset($conexion)){
            try{
                $conexion->beginTransaction();
                $sql="Delete  from artefacto where id=:id ";
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


    public static function obtener_Artefactos_por_Id($conexion,$id){
        $artefacto=null;

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select * from artefacto where id=:id ";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":id",$id,PDO::PARAM_INT);

                $sentencia->execute();

                $resultado=$sentencia->fetch();

                if (count($resultado)){

                        $artefacto=new Artefacto($resultado["id"],$resultado["id_sala"],$resultado["nombre"],$resultado["video"],$resultado["qr"]
                            ,$resultado["descripcion"],$resultado["descripcion_ingles"],$resultado["nombre_ingles"],$resultado["imagen"],$resultado["numero"],$resultado["actualizado"]);
                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";
                die();
            }
        }

        return $artefacto;
    }


    public static function obtener_Artefacto_por_nombre($conexion,$nombre){
        $artefacto=false;

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select * from artefacto where nombre=:nombre";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":nombre",$nombre,PDO::PARAM_STR);

                $sentencia->execute();

                $resultado=$sentencia->fetchAll();

                if (count($resultado)){
                    $artefacto=true;
                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";

                die();
            }
        }

        return $artefacto;
    }

    public static function obtener_Artefacto_por_video($conexion,$video){
        $artefacto=false;

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select * from artefacto where video=:video";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":video",$video,PDO::PARAM_STR);

                $sentencia->execute();

                $resultado=$sentencia->fetchAll();

                if (count($resultado)){
                    $artefacto=true;
                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";

                die();
            }
        }

        return $artefacto;
    }

    public static function obtener_Artefacto_por_Imagen($conexion,$imagen){
        $artefacto=false;

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select * from artefacto where imagen=:imagen";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":imagen",$imagen,PDO::PARAM_STR);

                $sentencia->execute();

                $resultado=$sentencia->fetchAll();

                if (count($resultado)){
                    $artefacto=true;
                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";

                die();
            }
        }

        return $artefacto;
    }


    public static function obtener_Artefacto_por_Nombre_Ingles($conexion,$nombre){
        $artefacto=false;

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select * from artefacto where nombre_ingles=:nombre";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":nombre",$nombre,PDO::PARAM_STR);

                $sentencia->execute();

                $resultado=$sentencia->fetchAll();

                if (count($resultado)){
                    $artefacto=true;
                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";

                die();
            }
        }

        return $artefacto;
    }

    public static function obtener_Artefacto_por_Numero($conexion,$numero){
        $artefacto=false;

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select * from artefacto where numero=:numero";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":numero",$numero,PDO::PARAM_INT);

                $sentencia->execute();

                $resultado=$sentencia->fetchAll();

                if (count($resultado)){
                    $artefacto=true;
                }

            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";

                die();
            }
        }

        return $artefacto;
    }







    public static function actualizar_artefacto($conexion,$id,$nombre,$video,$descripcion,$nombre_ingles,$descripcion_ingles,$imagen,$numero){
        $actualizado=null;

        if (isset($conexion)){
            try{
                $sql="UPDATE artefacto SET nombre=:nombre, descripcion=:descripcion,nombre_ingles=:nombre_ingles,
                       descripcion_ingles=:descripcion_ingles,numero=:numero,actualizado=NOW()";
                if ($video!=""){
                    $sql.=",video=:video";
                }
                if ($imagen!=""){
                    $sql.=",imagen=:imagen";
                }

                $sql.="  WHERE id=:id ";

                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":nombre",$nombre,PDO::PARAM_STR);
                $sentencia->bindParam(":nombre_ingles",$nombre_ingles,PDO::PARAM_STR);
                $sentencia->bindParam(":descripcion",$descripcion,PDO::PARAM_STR);
                $sentencia->bindParam(":descripcion_ingles",$descripcion_ingles,PDO::PARAM_STR);
                $sentencia->bindParam(":numero",$numero,PDO::PARAM_INT);
                if ($video!=""){
                    $sentencia->bindParam(":video",$video,PDO::PARAM_STR);
                }
                if ($imagen!=""){
                    $sentencia->bindParam(":imagen",$imagen,PDO::PARAM_STR);
                }

                $sentencia->bindParam(":id",$id,PDO::PARAM_INT);


                $actualizado=$sentencia->execute();






            }catch (Exception $ex){
                print "<div class=\"alert alert-danger\" role=\"alert\">"."Error". $ex->getMessage()."</div><br>";


                die();
            }



        }


        return $actualizado;

    }


    public static function obtener_Artefactos_por_SalaAPI($conexion,$id_sala,$fecha=null){
        $artefactos=array();
        $artefacto=array();

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select * from artefacto where id_sala=:id_sala";
                if($fecha){
                    $sql.=" AND actualizado >= :fecha";
                }
                $sql.=" order by id ";

                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":id_sala",$id_sala,PDO::PARAM_INT);
                if($fecha){
                    $sentencia->bindParam(":fecha",$fecha);
                }



                $sentencia->execute();

                $resultado=$sentencia->fetchAll();

                if (count($resultado)){
                    foreach ($resultado as $fila){
                        $artefacto["id"]=$fila["id"];
                        $artefacto["id_sala"]=$fila["id_sala"];
                        $artefacto["nombre_artefacto"]=$fila["nombre"];
                        $artefacto["nombre_ingles_artefacto"]=$fila["nombre_ingles"];
                        $artefacto["numero_artefacto"]=$fila["numero"];
                        $artefacto["imagen"]=$fila["imagen"];
                        $artefacto["actualizado_artefacto"]=$fila["actualizado"];
                        $artefactos[]=$artefacto;
                    }
                }

            }catch (Exception $ex){
                print "Error". $ex->getMessage()."<br>";
                die();
            }
        }

        return $artefactos;
    }

    public static function obtener_Artefactos_por_QR_API($conexion,$qr,$fecha=null){
        $artefacto=array();

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select a.id, a.nombre as nombre_artefacto,s.nombre as nombre_sala,a.nombre_ingles as nombre_ingles_artefacto,s.nombre_ingles
                     as nombre_ingles_sala,a.numero as numero_artefacto, s.numero as numero_sala,s.actualizado as actualizado_sala,a.actualizado as actualizado_artefacto, a.video,a.imagen,
                     a.qr,a.descripcion,a.descripcion_ingles,a.id_sala from artefacto as a JOIN sala as s where s.id=a.id_sala and a.qr=:qr ";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":qr",$qr,PDO::PARAM_STR);

                $sentencia->execute();

                $resultado=$sentencia->fetch();

                if (!empty($resultado) && count($resultado)){

                    $artefacto["id"]=$resultado["id"];
                    $artefacto["id_sala"]=$resultado["id_sala"];
                    $artefacto["nombre_artefacto"]=$resultado["nombre_artefacto"];
                    $artefacto["nombre_ingles_artefacto"]=$resultado["nombre_ingles_artefacto"];
                    $artefacto["video"]=$resultado["video"];
                    $artefacto["imagen"]=$resultado["imagen"];
                    $artefacto["qr"]=$resultado["qr"];
                    $artefacto["descripcion"]=$resultado["descripcion"];
                    $artefacto["descripcion_ingles"]=$resultado["descripcion_ingles"];
                    $artefacto["numero_artefacto"]=$resultado["numero_artefacto"];
                    $artefacto["actualizado_artefacto"]=$resultado["actualizado_artefacto"];
                    $artefacto["nombre_sala"]=$resultado["nombre_sala"];
                    $artefacto["nombre_ingles_sala"]=$resultado["nombre_ingles_sala"];
                    $artefacto["numero_sala"]=$resultado["numero_sala"];
                    $artefacto["actualizado_sala"]=$resultado["actualizado_artefacto"];


                }

            }catch (Exception $ex){
                print "Error". $ex->getMessage()."<br>";
                die();
            }
        }

        return $artefacto;
    }

    public static function obtener_Artefactos_por_ID_API($conexion,$id,$fecha=null){
        $artefacto=array();

        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select a.id, a.nombre as nombre_artefacto,s.nombre as nombre_sala,a.nombre_ingles as nombre_ingles_artefacto,s.nombre_ingles
                     as nombre_ingles_sala,a.numero as numero_artefacto, s.numero as numero_sala,s.actualizado as actualizado_sala,a.actualizado as actualizado_artefacto,a.video,a.imagen,
                     a.qr,a.descripcion,a.descripcion_ingles,a.id_sala from artefacto as a JOIN sala as s where s.id=a.id_sala and a.id=:id ";
                $sentencia=$conexion->prepare($sql);

                $sentencia->bindParam(":id",$id,PDO::PARAM_INT);

                $sentencia->execute();

                $resultado=$sentencia->fetch();

                if (!empty($resultado) &&count($resultado)){

                   $artefacto["id"]=$resultado["id"];
                    $artefacto["id_sala"]=$resultado["id_sala"];
                    $artefacto["nombre_artefacto"]=$resultado["nombre_artefacto"];
                    $artefacto["nombre_ingles_artefacto"]=$resultado["nombre_ingles_artefacto"];
                    $artefacto["video"]=$resultado["video"];
                    $artefacto["imagen"]=$resultado["imagen"];
                    $artefacto["qr"]=$resultado["qr"];
                    $artefacto["descripcion"]=$resultado["descripcion"];
                    $artefacto["descripcion_ingles"]=$resultado["descripcion_ingles"];
                    $artefacto["numero_artefacto"]=$resultado["numero_artefacto"];
                    $artefacto["actualizado_artefacto"]=$resultado["actualizado_artefacto"];
                    $artefacto["nombre_sala"]=$resultado["nombre_sala"];
                    $artefacto["nombre_ingles_sala"]=$resultado["nombre_ingles_sala"];
                    $artefacto["numero_sala"]=$resultado["numero_sala"];
                    $artefacto["actualizado_sala"]=$resultado["actualizado_artefacto"];


                }

            }catch (Exception $ex){
                print "Error". $ex->getMessage()."<br>";
                die();
            }
        }

        return $artefacto;
    }

    public static function obtener_Artefactos_API($conexion,$fecha=null){
        $artefactos=array();
        $artefacto=array();
        if (isset($conexion)){
            try{
                include_once "Artefacto.inc.php";

                $sql="Select * from artefacto";
                if($fecha){
                    $sql.=" where actualizado >= :fecha";
                }
                $sql.=" order by id ";


                $sentencia=$conexion->prepare($sql);
                if($fecha){
                    $sentencia->bindParam(":fecha",$fecha);
                }

                $sentencia->execute();

                $resultado=$sentencia->fetchAll();

                if (!empty($resultado) && count($resultado)){
                    foreach ($resultado as $fila){
                        $artefacto["id"]=$fila["id"];
                        $artefacto["id_sala"]=$fila["id_sala"];
                        $artefacto["nombre_artefacto"]=$fila["nombre"];
                        $artefacto["nombre_ingles_artefacto"]=$fila["nombre_ingles"];
                        $artefacto["video"]=$fila["video"];
                        $artefacto["imagen"]=$fila["imagen"];
                        $artefacto["qr"]=$fila["qr"];
                        $artefacto["descripcion"]=$fila["descripcion"];
                        $artefacto["descripcion_ingles"]=$fila["descripcion_ingles"];
                        $artefacto["numero_artefacto"]=$fila["numero"];
                        $artefacto["actualizado_artefacto"]=$fila["actualizado"];
                        $artefactos[]=$artefacto;
                    }
                }

            }catch (Exception $ex){
                print "Error". $ex->getMessage()."<br>";
                die();
            }
        }

        return $artefactos;
    }


}