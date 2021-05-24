<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 12/9/2020
 * Time: 20:05
 */
include_once "app/Conexion.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";
include_once "app/RepositorioSalas.inc.php";
include_once "app/RepositorioArtefactos.inc.php";


$title="Ver Artefacto";
$rutaback=Servidor."sala/".$artefacto->getIdSala();
include_once "plantillas/cabecera.inc.php";
?>

<div class="container" style="margin-top: 90px">
<div class="form-group">

    <input type="hidden" value="<?php echo $artefacto->getId()?>" id="idartefacto">
    <input type="hidden" value="<?php echo $artefacto->getIdSala()?>" id="inputidSala">
      <label for="ver_numero" class="col-sm-2 col-form-label" style="padding-left: 0px">Número:</label>
      <input class="form-control col-sm-12" type="text" value="<?php echo $artefacto->getNumero()?>" readonly  id="ver_numero">

       <label for="inputArtefacto" class="col-sm-2 col-form-label" style="padding-left: 0px">Nombre:</label>

        <input type="text" class="form-control col-sm-12" id="inputArtefacto" name="inputArtefacto" readonly value="<?php echo $artefacto->getNombre() ?>" required>



       <label for="inputArtefacto" class="col-sm-2 col-form-label" style="padding-left: 0px">Nombre en inglés:</label>

       <input type="text" class="form-control col-sm-12" id="inputArtefactoIngles"  readonly value="<?php echo $artefacto->getNombreIngles() ?>" required>




       <label for="descripcion" class="col-sm-2 col-form-label" style="padding-left: 0px" >Descripción:</label>

       <textarea class="form-control col-sm-12" id="descripcion" rows="3" name="descripcion" readonly><?php echo $artefacto->getDescripcion() ?></textarea>




        <label for="descripcion" class="col-sm-2 col-form-label" style="padding-left: 0px" >Descripción en inglés:</label>

        <textarea class="form-control col-sm-12" id="descripcion" rows="3"  readonly><?php echo $artefacto->getDescripcionIngles() ?></textarea>






</div>


    <div  class="ver_campos">

        <div id="verImagen" class="ver_campos_multimedia">
            <img src="<?php echo Servidor."public/imagenes/".$artefacto->getImagen()."?".getdate()[0]?>" id="ver_imagen" alt="Problemas al cargar la imagen" class="rounded">
        </div>

            <div id="contenedorVideo" class="ver_campos_multimedia">
                <video controls width="300px" height="300px">

                    <source id="source" src="<?php echo Servidor."public/videos/".$artefacto->getVideo()."?".getdate()[0]?>"
                            type="video/mp4">

                    Sorry, your browser doesn't support embedded videos.
                </video>


            </div>




<div id="placeHolder"></div>

        <a class="btn btn_agregar" id="descargar" style="align-self: center"><img src="<?php echo Servidor."css/iconos/Download.png" ?>"> QR</a>
    </div>



    <a type="submit"  class="btn btn_agregar" value="editarArtefacto" name="editarArtefacto" id="botoneditarartefacto"
       href="<?php echo Ruta_Editar_Artefacto.$artefacto->getId() ?>">EDITAR ARTEFACTO</a>

    <script>
        $(function() {
           generateQR();


        });


    </script>

</div>


