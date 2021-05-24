<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 01:51
 */
include_once "app/config.inc.php";
include_once "app/Conexion.inc.php";
include_once "app/Sala.inc.php";
include_once "app/RepositorioSalas.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/RepositorioArtefactos.inc.php";

$componentes_url=parse_url($_SERVER["REQUEST_URI"]);

$ruta=$componentes_url["path"];

$partes_ruta=explode("/",$ruta);
$partes_ruta=array_filter($partes_ruta);

$indice=0;


$partes_ruta=array_slice($partes_ruta,0);

if(isset($partes_ruta[0]) && $partes_ruta[0]=="salas_app"){
    $indice=1;

}

$api=false;
$ruta_elegida="vistas/404.php";


    if (count($partes_ruta)==0+$indice){
        $ruta_elegida="vistas/home.php";
    }else if (count($partes_ruta)==1+$indice){
         switch ($partes_ruta[0+$indice]){
             case "login":
                 $ruta_elegida="vistas/login.php";
                 break;
             case "logout":
                 $ruta_elegida="vistas/logout.php";
                 break;
             case "actualizar":
                 $ruta_elegida="vistas/registro.php";
                 break;
             case "borrar_sala":
                 $ruta_elegida="vistas/borrar_sala.php";
                 break;
             case "borrar_artefacto":
                 $ruta_elegida="vistas/borrar_artefacto.php";
                 break;
             case "crear_sala":
                 $ruta_elegida="vistas/crear_sala.php";
                 break;

         }
    }else if (count($partes_ruta)==2+$indice){
        if ($partes_ruta[0+$indice]=="sala" && ControldeSesion::session_iniciada()){
            $id=$partes_ruta[1+$indice];
            Conexion::abrir_Conexion();
            $sala=RepositorioSalas::obtener_Sala(Conexion::obtener_Conexion(),$id);
            if ($sala!=null){
                $ruta_elegida="vistas/editar_sala.php";
            }


            Conexion::cerrar_Conexion();
        }else if ($partes_ruta[0+$indice]=="crear_artefacto" && ControldeSesion::session_iniciada()){
            $id=$partes_ruta[1+$indice];
            Conexion::abrir_Conexion();
            $sala=RepositorioSalas::obtener_Sala(Conexion::obtener_Conexion(),$id);
            if ($sala!=null){
                $ruta_elegida="vistas/crear_artefacto.php";
            }


            Conexion::cerrar_Conexion();

        }else if ($partes_ruta[0+$indice]=="editar_artefacto" && ControldeSesion::session_iniciada()){
            $id=$partes_ruta[1+$indice];
            Conexion::abrir_Conexion();
            $artefacto=RepositorioArtefactos::obtener_Artefactos_por_Id(Conexion::obtener_Conexion(),$id);
            if ($artefacto!=null){
                $ruta_elegida="vistas/editar_artefacto.php";
            }


            Conexion::cerrar_Conexion();

        }else if ($partes_ruta[0+$indice]=="ver_artefacto" && ControldeSesion::session_iniciada()){
            $id=$partes_ruta[1+$indice];
            Conexion::abrir_Conexion();
            $artefacto=RepositorioArtefactos::obtener_Artefactos_por_Id(Conexion::obtener_Conexion(),$id);
            if ($artefacto!=null){
                $ruta_elegida="vistas/ver_artefacto.php";
            }


            Conexion::cerrar_Conexion();

        }else if ($partes_ruta[0+$indice]=="editar_sala" && ControldeSesion::session_iniciada()){
            $id=$partes_ruta[1+$indice];
            Conexion::abrir_Conexion();
            $sala=RepositorioSalas::obtener_Sala(Conexion::obtener_Conexion(),$id);
            if ($sala!=null){
                $ruta_elegida="vistas/editar_datos_sala.php";
            }


            Conexion::cerrar_Conexion();

        }



    }else if (count($partes_ruta)==3+$indice){
        if ($partes_ruta[0+$indice]=="api" /*&& isset($_SERVER["HTTP_SECRET"]) && $_SERVER["HTTP_SECRET"]=="123456"*/){

            if ($partes_ruta[2+$indice]=="todo" && $partes_ruta[1+$indice]=="v1"){
                $res=array();
                $fecha=null;
                if(isset($_REQUEST["fecha"])){
                    $fecha=$_REQUEST["fecha"];
                }
             Conexion::abrir_Conexion();

             $salas=RepositorioSalas::obtener_TodoAPI(Conexion::obtener_Conexion(),$fecha);
             Conexion::cerrar_Conexion();

             if (count($salas)>0){

                 $res=$salas;

             }

             $api=true;
            echo json_encode($res);
            }else if ($partes_ruta[2+$indice]=="todo" && $partes_ruta[1+$indice]=="salas"){
                $res=array();
                $fecha=null;
                if(isset($_REQUEST["fecha"])){
                    $fecha=$_REQUEST["fecha"];
                }
                Conexion::abrir_Conexion();

                $salas=RepositorioSalas::obtener_Salas_API(Conexion::obtener_Conexion(),$fecha);
                Conexion::cerrar_Conexion();

                if (count($salas)>0){

                    $res=$salas;

                }

                $api=true;
                echo json_encode($res);

            }else if ($partes_ruta[2+$indice]=="todo" && $partes_ruta[1+$indice]=="artefactos"){
                $res=array();
                $fecha=null;
                if(isset($_REQUEST["fecha"])){
                    $fecha=$_REQUEST["fecha"];
                }
                Conexion::abrir_Conexion();

                $artefactos=RepositorioArtefactos::obtener_Artefactos_API(Conexion::obtener_Conexion(),$fecha);
                Conexion::cerrar_Conexion();

                if (count($artefactos)>0){

                    $res=$artefactos;

                }

                $api=true;
                echo json_encode($res);

            }else if($partes_ruta[1+$indice]=="artefactos_x_sala"){
                $res=array();
                $id_sala=$partes_ruta[2+$indice];
                $fecha=null;
                if(isset($_REQUEST["fecha"])){
                    $fecha=$_REQUEST["fecha"];
                }
                Conexion::abrir_Conexion();

                $artefactos=RepositorioArtefactos::obtener_Artefactos_por_SalaAPI(Conexion::obtener_Conexion(),$id_sala,$fecha);
                Conexion::cerrar_Conexion();

                if (count($artefactos)>0){

                    $res=$artefactos;

                }

                $api=true;
                echo json_encode($res);


            }else if ($partes_ruta[1+$indice]=="qr"){

            $codqr=$partes_ruta[2+$indice];
            $res=array();
            Conexion::abrir_Conexion();

            $temp=RepositorioArtefactos::obtener_Artefactos_por_QR_API(Conexion::obtener_Conexion(),$codqr);



            Conexion::cerrar_Conexion();

            if (count($temp)>0){

                $res=$temp;
            }

            $api=true;
            echo json_encode($res);


        }else if ($partes_ruta[1+$indice]=="id"){

            $id=$partes_ruta[2+$indice];
            $res=array();
            Conexion::abrir_Conexion();

            $temp=RepositorioArtefactos::obtener_Artefactos_por_ID_API(Conexion::obtener_Conexion(),$id);



            Conexion::cerrar_Conexion();

            if (count($temp)>0){

                $res=$temp;
            }

            $api=true;
            echo  json_encode($res);


        }
        }

}


if (!$api){
    include_once $ruta_elegida;
    include_once "plantillas/pie.inc.php";

}

