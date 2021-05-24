<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 18:43
 */
include_once "app/Conexion.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";
include_once "app/RepositorioSalas.inc.php";
include_once "app/Artefacto.inc.php";
include_once "app/RepositorioArtefactos.inc.php";

$title="Crear Artefacto";
$rutaback=Servidor."sala/".$sala->getId();
$errores=array();
$nombre_video="";
$nombre_artefacto="";
$error=false;
include_once "plantillas/cabecera.inc.php";


 ///Subir Video
if (isset($_POST["crearArtefacto"])&& !empty($_FILES["video"]["tmp_name"]) && !empty($_FILES["imagen"]["tmp_name"])){


    $directorio_video=Directorio_Raiz."/public/videos/";
    $directorio_imagen=Directorio_Raiz."/public/imagenes/";
    $carpeta_objetivo_video=$directorio_video.basename($_FILES["video"]["name"]);
    $carpeta_objetivo_imagen=$directorio_imagen.basename($_FILES["imagen"]["name"]);
    $subida_correcta=1;
    $tipo_video=pathinfo($carpeta_objetivo_video,PATHINFO_EXTENSION);
    if ($tipo_video!="mp4"){
        $errores[]="Formato de Video Incorrecto solo se acepta mp4";
    }


    $tipo_imagen=pathinfo($carpeta_objetivo_imagen,PATHINFO_EXTENSION);
    if ($tipo_imagen!="png" && $tipo_imagen!="jpg"){
        $errores[]="Formato de imagen Incorrecto solo se acepta png y jpg";
    }



  if($_FILES["imagen"]["size"]>Tam_Max_Imagen){
      $errores[]="La imagen exede el tamaño permitido de 2MB";
 }
 if($_FILES["video"]["size"]>Tam_Max_Video){
     $errores[]="El video  exede el tamaño permitido de 30MB";
 }



    Conexion::abrir_Conexion();


    if (RepositorioArtefactos::obtener_Artefacto_por_Numero(Conexion::obtener_Conexion(),$_POST["inputArtefactoNumero"])){
        $errores[]="Ya existe un artefacto con ese número";
    }

    if (empty($errores)){

    if (move_uploaded_file($_FILES["video"]["tmp_name"],$directorio_video.$_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_video)
         && move_uploaded_file($_FILES["imagen"]["tmp_name"],$directorio_imagen.$_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_imagen)){


      $id=RepositorioArtefactos::insertar_Artefacto(Conexion::obtener_Conexion(),$_POST["id_sala"],$_POST["inputArtefacto"],
          $_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_video,$_POST["descripcion"],$_POST["inputArtefactoIngles"],$_POST["descripcion_ingles"]
          ,$_POST["inputArtefactoNumero"]."_".$_POST["id_sala"].".".$tipo_imagen,$_POST["inputArtefactoNumero"]);



      Redireccion::redirigir(Ruta_Ver_Artefacto.$id);

    }else{
        $errores[]="Hubo un error en la subida del video y la imagen";
    }
    }
    Conexion::cerrar_Conexion();
}else if (isset($_POST["crearArtefacto"]) && empty($_FILES["video"]["tmp_name"])){{
    $errores[]="ERROR Puede ser que le falten algunas configuraciones en su servidor para la subida de archivos";

}



}
?>




<div class="container" style="margin-top: 90px">

    <?php

    $top=20;
    if (!empty($errores)){
        foreach ($errores as $error){
            ?>
            <div class="alert alert-danger myalert"  role="alert" style="top:<?php echo ($top+=75)."px" ?> ;">
                <?php echo $error."<br>" ?>
            </div>

        <?php }}?>
<form role="form" class="form" method="post" action="<?php echo Ruta_Crear_Artefacto.$sala->getId() ?>" enctype="multipart/form-data" id="formularioArtefacto">


        <input class="form-control" type="hidden" value="<?php echo $sala->getId()?>" readonly name="id_sala">


        <div class="form-group">

            <label for="inputArtefactoNumero" class="col-sm-2 col-form-label">Número:</label>
            <div class="col-sm-12">
                <input type="number" class="form-control" id="inputArtefactoNumero" name="inputArtefactoNumero" placeholder="#"
                       value="<?php if (isset($_POST["inputArtefactoNumero"])){ echo $_POST["inputArtefactoNumero"];} ?>" required>
            </div>


            <label for="inputArtefacto" class="col-sm-2 col-form-label">Nombre:</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="inputArtefacto" name="inputArtefacto" placeholder="Nombre artefacto"
                      value="<?php if (isset($_POST["inputArtefacto"])){ echo $_POST["inputArtefacto"];} ?>" required>
            </div>

            <label for="inputArtefactoIngles" class="col-sm-2 col-form-label">Nombre en inglés:</label>
            <div class="col-sm-12">
                <input type="text" class="form-control" id="inputArtefactoIngles" name="inputArtefactoIngles" placeholder="Nombre artefacto en inglés"
                       value="<?php if (isset($_POST["inputArtefactoIngles"])){ echo $_POST["inputArtefactoIngles"];} ?>" required>
            </div>



            <label for="descripcion" class="col-sm-2 col-form-label">Descripción:</label>
            <div class="col-sm-12">
                <textarea class="form-control" id="descripcion" rows="3" name="descripcion"><?php if (isset($_POST["descripcion"])){
                    echo $_POST["descripcion"];
                    } ?></textarea>
            </div>

            <label for="descripcion_ingles" class="col-sm-3 col-form-label">Descripción en inglés:</label>
            <div class="col-sm-12">
                <textarea class="form-control" id="descripcion_ingles" rows="3" name="descripcion_ingles"><?php if (isset($_POST["descripcion_ingles"])){
                        echo $_POST["descripcion_ingles"];
                    } ?></textarea>
            </div>

            <div class="form-inline">
                <label for="subir_video" id="etiqueta_subir" class="btn_agregar">SUBIR VIDEO</label>
                <input type="file" class="form-control-file videofff" id="subir_video" name="video" accept="video/mp4"
                     required files="<?php if (isset($_FILES["video"])){
                     echo $_FILES["video"]["tmp_name"];
                } ?>">
                <input id="preview_nombre2" value="No se ha seleccionado ningún video" readonly class="form-control" style="width: 45%">

            </div>

            <div class="form-inline">
                <label for="subir_imagen" id="etiqueta_subir_imagen" class="btn_agregar">SUBIR IMAGEN</label>
                <input type="file" class="form-control-file videofff" id="subir_imagen" name="imagen" accept=".png, .jpg" required>
                <input id="preview_nombre3" value="No se ha seleccionado ninguna imagen" readonly class="form-control" style="width: 45%">

            </div>


            <button type="submit" class="btn btn_agregar" value="crearArtefacto" name="crearArtefacto" id="botonartefacto">CREAR ARTEFACTO</button>

        </div>
</form>
    <script>




    </script>

</div>