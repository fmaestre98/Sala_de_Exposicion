<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 12/9/2020
 * Time: 11:01
 */
include_once "app/Conexion.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";
include_once "app/RepositorioSalas.inc.php";
include_once "app/RepositorioArtefactos.inc.php";


$title="Editar Artefacto";
$rutaback=Servidor."sala/".$artefacto->getIdSala();
include_once "plantillas/cabecera.inc.php";

$errores=array();

$error=false;

if (!ControldeSesion::session_iniciada()){
    Redireccion::redirigir(Ruta_Login);
}


///Subir Video
if (isset($_POST["editarArtefacto"])&& !empty($_FILES["video"]["tmp_name"]) && !empty($_FILES["imagen"]["tmp_name"])){
    $directorio_video=Directorio_Raiz."/public/videos/";
    $directorio_imagen=Directorio_Raiz."/public/imagenes/";
    $carpeta_objetivo_video=$directorio_video.basename($_FILES["video"]["name"]);
    $carpeta_objetivo_imagen=$directorio_imagen.basename($_FILES["imagen"]["name"]);
    $subida_correcta=1;
    $tipo_video=pathinfo($carpeta_objetivo_video,PATHINFO_EXTENSION);
    if ($tipo_video!="mp4"){
        $errores[]="Formato de Video Incorrecto solo se acepta mp4";
    }



    if($_FILES["imagen"]["size"]>Tam_Max_Imagen){
        $errores[]="La imagen exede el tamaño permitido de 2MB";
    }
    if($_FILES["video"]["size"]>Tam_Max_Video){
        $errores[]="El video  exede el tamaño permitido de 30MB";
    }




    $tipo_imagen=pathinfo($carpeta_objetivo_imagen,PATHINFO_EXTENSION);
    if ($tipo_imagen!="png" && $tipo_imagen!="jpg"){
        $errores[]="Formato de imagen Incorrecto solo se acepta png y jpg";
    }


    Conexion::abrir_Conexion();
    if ($artefacto->getNumero()!=$_POST["inputArtefactoNumero"] && RepositorioArtefactos::obtener_Artefacto_por_Numero(Conexion::obtener_Conexion(),$_POST["inputArtefactoNumero"])){
        $errores[]="Ya existe un artefacto con ese número";
    }

    if (empty($errores)){

        if (move_uploaded_file($_FILES["video"]["tmp_name"],$directorio_video.$_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_video)
            && move_uploaded_file($_FILES["imagen"]["tmp_name"],$directorio_imagen.$_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_imagen)){


            RepositorioArtefactos::actualizar_artefacto(Conexion::obtener_Conexion(),$_POST["id"],$_POST["inputArtefacto"],
                $_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_video,$_POST["descripcion"],$_POST["inputArtefactoIngles"],$_POST["descripcion_ingles"]
                ,$_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_imagen,$_POST["inputArtefactoNumero"]);




           Redireccion::redirigir(Ruta_Ver_Artefacto.$artefacto->getId());

        }else{
            $error=true;
        }
    }
    Conexion::cerrar_Conexion();
}else if (isset($_POST["editarArtefacto"]) && !empty($_FILES["video"]["tmp_name"])){
    $directorio_video=Directorio_Raiz."/public/videos/";

    $carpeta_objetivo_video=$directorio_video.basename($_FILES["video"]["name"]);

    $subida_correcta=1;
    $tipo_video=pathinfo($carpeta_objetivo_video,PATHINFO_EXTENSION);
    if ($tipo_video!="mp4"){
        $errores[]="Formato de Video Incorrecto solo se acepta mp4";
    }




    if($_FILES["video"]["size"]>Tam_Max_Video){
        $errores[]="El video  exede el tamaño permitido de 30MB";
    }








    Conexion::abrir_Conexion();


    if ($artefacto->getNumero()!=$_POST["inputArtefactoNumero"] && RepositorioArtefactos::obtener_Artefacto_por_Numero(Conexion::obtener_Conexion(),$_POST["inputArtefactoNumero"])){
        $errores[]="Ya existe un artefacto con ese número";
    }


    if (empty($errores)){

        if (move_uploaded_file($_FILES["video"]["tmp_name"],$directorio_video.$_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_video)){


            RepositorioArtefactos::actualizar_artefacto(Conexion::obtener_Conexion(),$_POST["id"],$_POST["inputArtefacto"],
                $_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_video,$_POST["descripcion"],$_POST["inputArtefactoIngles"],$_POST["descripcion_ingles"]
                ,"",$_POST["inputArtefactoNumero"]);




            Redireccion::redirigir(Ruta_Ver_Artefacto.$artefacto->getId());

        }else{
            $error=true;
        }
    }
    Conexion::cerrar_Conexion();
}else if (isset($_POST["editarArtefacto"]) && !empty($_FILES["imagen"]["tmp_name"])){

    $directorio_imagen=Directorio_Raiz."/public/imagenes/";

    $carpeta_objetivo_imagen=$directorio_imagen.basename($_FILES["imagen"]["name"]);
    $subida_correcta=1;

    if($_FILES["imagen"]["size"]>Tam_Max_Imagen){
        $errores[]="La imagen exede el tamaño permitido de 2MB";
    }





    $tipo_imagen=pathinfo($carpeta_objetivo_imagen,PATHINFO_EXTENSION);
    if ($tipo_imagen!="png" && $tipo_imagen!="jpg"){
        $errores[]="Formato de imagen Incorrecto solo se acepta png y jpg";
    }

    Conexion::abrir_Conexion();


    if ($artefacto->getNumero()!=$_POST["inputArtefactoNumero"] && RepositorioArtefactos::obtener_Artefacto_por_Numero(Conexion::obtener_Conexion(),$_POST["inputArtefactoNumero"])){
        $errores[]="Ya existe un artefacto con ese número";
    }

    if (empty($errores)){

        if (move_uploaded_file($_FILES["imagen"]["tmp_name"],$directorio_imagen.$_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_imagen)){


            RepositorioArtefactos::actualizar_artefacto(Conexion::obtener_Conexion(),$_POST["id"],$_POST["inputArtefacto"],
                "",$_POST["descripcion"],$_POST["inputArtefactoIngles"],$_POST["descripcion_ingles"]
                ,$_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_imagen,$_POST["inputArtefactoNumero"]);




            Redireccion::redirigir(Ruta_Ver_Artefacto.$artefacto->getId());

        }else{
            $error=true;
        }
    }
    Conexion::cerrar_Conexion();
}else if (isset($_POST["editarArtefacto"])){
    Conexion::abrir_Conexion();

    if ($artefacto->getNumero()!=$_POST["inputArtefactoNumero"] && RepositorioArtefactos::obtener_Artefacto_por_Numero(Conexion::obtener_Conexion(),$_POST["inputArtefactoNumero"])){
        $errores[]="Ya existe un artefacto con ese número";
    }

    if (empty($errores)){




            RepositorioArtefactos::actualizar_artefacto(Conexion::obtener_Conexion(),$_POST["id"],$_POST["inputArtefacto"],
                "",$_POST["descripcion"],$_POST["inputArtefactoIngles"],$_POST["descripcion_ingles"]
                ,"",$_POST["inputArtefactoNumero"]);




            Redireccion::redirigir(Ruta_Ver_Artefacto.$artefacto->getId());


    }
    Conexion::cerrar_Conexion();
}
?>


<div class="container" style="margin-top: 90px">

    <?php
    $top=20;
    if (isset($_POST["editarArtefacto"])){
        foreach ($errores as $error){
            ?>
            <div class="alert alert-danger myalert"  role="alert" style="top:<?php echo ($top+=75)."px" ?> ;">
                <?php echo $error."<br>" ?>
            </div>

        <?php }}?>

    <form role="form" class="form" method="post" action="<?php echo Ruta_Editar_Artefacto.$artefacto->getId() ?>" enctype="multipart/form-data" id="formularioArtefactoEditar">


        <input class="form-control" type="hidden" value="<?php echo $artefacto->getId()?>" readonly name="id" id="inputidArtefacto">
        <input class="form-control" type="hidden" value="<?php echo $artefacto->getIdSala()?>" readonly name="id_sala" id="inputidSala">

        <label for="inputArtefactoNumero" class="col-sm-2 col-form-label">Número:</label>
        <div class="col-sm-12">
            <input type="number" class="form-control" id="inputArtefactoNumero" name="inputArtefactoNumero"
                   value="<?php  echo $artefacto->getNumero() ?>" required>
        </div>

        <div class="form-group">
            <label for="inputArtefacto" class="col-sm-2 col-form-label">Nombre:</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="inputArtefacto" name="inputArtefacto" value="<?php echo $artefacto->getNombre() ?>" required>
            </div>

            <label for="inputArtefactoIngles" class="col-sm-2 col-form-label">Nombre en inglés:</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="inputArtefactoIngles" name="inputArtefactoIngles" placeholder="Nombre Artefacto en Inglés"
                       value="<?php echo $artefacto->getNombreIngles() ?>" required>
            </div>



            <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
            <div class="col-sm-12">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion" ><?php echo $artefacto->getDescripcion() ?></textarea>
            </div>

            <label for="descripcion_ingles" class="col-sm-3 col-form-label">Descripción en inglés:</label>
            <div class="col-sm-12">
                <textarea class="form-control" id="descripcion_ingles" rows="3" name="descripcion_ingles"><?php echo $artefacto->getDescripcionIngles() ?></textarea>
            </div>


            <div class="form-inline">
                <label for="editar_video" id="etiqueta_subir" class="btn_agregar">CAMBIAR VIDEO</label>
                <input type="file" class="form-control-file videofff" id="editar_video" name="video" accept="video/mp4">

                <input id="preview_nombre" value="<?php echo $artefacto->getVideo() ?>" readonly class="form-control" style="width: 55%">
            </div>

            <div class="form-inline">
                <label for="subir_imagen2" id="etiqueta_subir_imagen" class="btn_agregar">CAMBIAR IMAGEN</label>
                <input type="file" class="form-control-file videofff" id="subir_imagen2" name="imagen" accept=".png, .jpg">
                <input id="preview_nombre35" value="<?php echo $artefacto->getImagen() ?>" readonly class="form-control" style="width: 55%">

            </div>

            <button type="submit" class="btn btn_agregar" value="editarArtefacto" name="editarArtefacto" id="botoneditarartefacto" style="margin-bottom: 10px;margin-left: 10px;">EDITAR ARTEFACTO</button>

        </div>
    </form>



</div>
