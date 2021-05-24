<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 11/9/2020
 * Time: 16:43
 */
include_once "app/Conexion.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";
include_once "app/RepositorioSalas.inc.php";
include_once "app/RepositorioArtefactos.inc.php";

$title="Editar Sala";
include_once "plantillas/cabecera.inc.php";
$error_actualizar=false;

if (!ControldeSesion::session_iniciada()){
    Redireccion::redirigir(Ruta_Login);
}








Conexion::abrir_Conexion();

$artefactos=RepositorioArtefactos::obtener_Artefactos_por_Sala(Conexion::obtener_Conexion(),$sala->getId());

Conexion::cerrar_Conexion();

?>

<div style="margin-top: 80px">
<div class="" style="height: 100px; min-height: 100px !important; background: #eed195; display: flex; justify-content: center;">

    <h1 class="text-center"  style="font-size: xx-large; width: 80%; align-self: center;"><?php echo $sala->getNombre() ?></h1>

</div>
<div class="row" style="width: 100%; margin-top: 20px;">
    <div class="col-sm-2">
        <a href="<?php echo Ruta_Editar_Datos_Sala.$sala->getId() ?>" class="btn btn_agregar" style="margin-bottom:10px; margin-left: 10px ">EDITAR DATOS SALA</a>
    </div>
<div class="col-sm-2">
    <a href="<?php echo Ruta_Crear_Artefacto.$sala->getId() ?>" class="btn btn_agregar" style="margin-bottom:10px;margin-left: 10px; ">CREAR ARTEFACTO</a>
</div>

</div>

</div>
<div class="container-fluid">
<table class="table" style="margin-bottom: 0px !important;">
    <thead>
    <tr>
        <th scope="col" class="d-none d-sm-table-cell" style="max-width: 10% !important; min-width: 10% !important;">Número</th>
        <th scope="col" style="max-width: 25% !important; min-width: 25% !important;">Nombre</th>

        <th scope="col" class="d-none d-sm-table-cell text-center" style="max-width: 15% !important; min-width: 15% !important;"><span style="margin-left: 10px">Imagen Portada</span></th>
        <th scope="col" class="d-none d-sm-table-cell" style="max-width: 30% !important; min-width: 30% !important;"><span style="margin-left: 20px">Descripción</span></th>

        <th scope="col"><span  style="margin-left: 30%;  max-width: 15% !important; min-width: 15% !important;">Acciones</span></th>

    </tr>
    </thead>
    </table>
    <div class="pre-scrollable" style="max-height: 55vh !important;">
    <table class="table">
    <tbody>

    <?php
    if (count($artefactos)){
        foreach ($artefactos as $artefacto ){
            ?>
            <tr>
                <th scope="row" class="d-none d-sm-table-cell" style="max-width: 10% !important; min-width: 10% !important;"><span style="margin-left: 25px"><?php echo $artefacto->getNumero() ?></span></th>
                <td style="max-width: 200px !important; min-width: 25% !important;"><?php echo $artefacto->getNombre() ?></td>

                <td class="d-none d-sm-table-cell text-center" style="max-width: 15% !important; min-width: 15% !important;"><img style="max-width:90px; height: 60px;" src="<?php echo Servidor."public/imagenes/".$artefacto->getImagen() ?>" alt="Portada Video"></td>
                <td class="d-none d-sm-table-cell" style="max-width: 30% !important; min-width: 30% !important;"><?php echo $artefacto->getDescripcionResumida() ?></td>

                <td style="max-width: 15% !important; min-width: 15% !important;">
                    <a href="<?php echo Ruta_Editar_Artefacto.$artefacto->getId() ?>"><img
                                src="<?php echo Servidor."css/iconos/edit.png"?>" alt="Editar" title="Editar"></a>

                    <!-- Button trigger modal -->
                    <a type="button"  style="margin-left: 10px"  class="botones_icons" data-toggle="modal" data-target="#exampleModal<?php echo $artefacto->getNumero() ?>"><img
                                src="<?php echo Servidor."css/iconos/garbage.png"?>" alt="Eliminar" title="Eliminar"></a>


                    <a style="margin-left: 10px" href="<?php echo Ruta_Ver_Artefacto.$artefacto->getId() ?>"><img
                                src="<?php echo Servidor."css/iconos/View.png"?>" alt="Ver" title="Ver"></a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $artefacto->getNumero() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $artefacto->getNumero() ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel<?php echo $artefacto->getNumero() ?>">Eliminar artefacto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p style="font-weight: normal">¿Está seguro de eliminar el artefacto <?php echo $artefacto->getNombre() ?>?</p>
                                    <p style="font-weight: lighter">(Se eliminaran sus ficheros correspondientes del servidor)</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="<?php echo Ruta_Borrar_Artefacto ?>" method="post">
                                        <input type="hidden" name="id_artefacto" value="<?php echo $artefacto->getId() ?>">
                                        <input type="hidden" name="id_sala" value="<?php echo $artefacto->getIdSala() ?>">
                                        <input type="hidden" name="video" value="<?php echo $artefacto->getVideo() ?>">
                                        <input type="hidden" name="imagen" value="<?php echo $artefacto->getImagen() ?>">
                                        <button type="button" class="btn btn_agregar" data-dismiss="modal">CANCELAR</button>
                                        <button type="submit" name="eliminar_artefacto"  class="btn btn_agregar">ACEPTAR</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </td>
            </tr>
        <?php }}?>

    </tbody>
</table>
        <?php if (!count($artefactos)){?>
            <div class="alert alert-primary myalert" role="alert" style="margin-left: 15px; background-color:#eed195 !important;color: #634909 !important; ">
               <p style="font-weight: bold; margin-bottom: 0px !important;">No hay artefactos creados</p>
            </div>

        <?php }?>

    </div>


</div>