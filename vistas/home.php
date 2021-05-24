
<?php
include_once "app/Conexion.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";
include_once "app/RepositorioSalas.inc.php";

$title="Inicio";
include_once "plantillas/cabecera.inc.php";

if (!ControldeSesion::session_iniciada()){
    Redireccion::redirigir(Ruta_Login);
}

Conexion::abrir_Conexion();


$salas=RepositorioSalas::obtenerTodos(Conexion::obtener_Conexion());

Conexion::cerrar_Conexion();

?>
<div style="margin-top: 90px">
<a href="<?php echo Ruta_Crear_Sala?>"  class="btn mb-2 btn_agregar" style="margin-top: 20px; margin-left: 15px;" name="agregar">AGREGAR SALA</a>

<div class="container-fluid" id="tabla-home">
<table class="table" style="margin-bottom: 0px !important;" id="tabla-cabecera">
    <thead>
    <tr>
        <th scope="col" class="d-none d-sm-table-cell" style="max-width: 100px !important; min-width: 10% !important;">Número</th>
        <th scope="col" style="max-width: 200px !important; min-width: 40% !important;">Nombre</th>
        <th scope="col" class="d-none d-sm-table-cell" style="max-width: 200px !important; min-width: 40% !important;">Nombre inglés</th>

        <th scope="col"  style=" max-width: 200px !important; min-width: 10% !important;"><span>Acciones</span></th>

    </tr>
    </thead>
   </table>
    <div class="pre-scrollable" style="max-height: 65vh !important;">
    <table class="table" id="tabla-row">
    <tbody>

<?php
if (count($salas)){
foreach ($salas as $sala ){
?>
   <tr>
        <td scope="row" class="d-none d-sm-table-cell" style="max-width: 100px !important; min-width: 10% !important; font-weight: bold;">
            <spam style="margin-left: 20%;"><?php echo $sala->getNumero() ?></spam></td>
        <td style="max-width: 200px !important; min-width: 40% !important;"><spam style="margin-left: 1%;"><?php echo $sala->getNombre() ?></spam></td>
        <td class="d-none d-sm-table-cell" style="max-width: 200px !important; min-width: 40% !important;"><spam style="margin-left: 1%;"><?php echo $sala->getNombreIngles() ?></spam></td>

        <td  style=" max-width: 200px !important; min-width: 10% !important;">  <a href="<?php echo Ruta_Editar_Sala.$sala->getId() ?>" ><img
                        src="<?php echo Servidor."css/iconos/edit.png"?>" alt="Editar" title="Editar"></a>



               <!-- Button trigger modal -->
                <a type="button" style="margin-left: 10px"  class="botones_icons" data-toggle="modal" data-target="#exampleModal<?php echo $sala->getNumero() ?>"><img
                            src="<?php echo Servidor."css/iconos/garbage.png"?>" alt="Eliminar" title="Eliminar"></a>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $sala->getNumero() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $sala->getNumero() ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" style="font-weight: bold;" id="exampleModalLabel<?php echo $sala->getNumero() ?>">Eliminar sala</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p style="font-weight: normal">¿Está seguro de eliminar la sala <?php echo $sala->getNombre() ?>?</p>
                            <p style="font-weight: lighter">(Se eliminaran todos sus artefactos)</p>
                        </div>
                        <div class="modal-footer">
                            <form action="<?php echo Ruta_Borrar_Sala ?>" method="post">
                                <input type="hidden" name="id_sala" value="<?php echo $sala->getId() ?>">
                                <button type="button" class="btn btn_agregar" data-dismiss="modal">CANCELAR</button>
                                <button type="submit" name="eliminar_sala"  class="btn btn_agregar">ACEPTAR</button>
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
    </div>




    <?php if (!count($salas)){?>
        <div class="alert alert-primary myalert" role="alert" style="margin-left: 15px; background-color:#eed195 !important;color: #634909 !important; ">
            <p style="font-weight: bold; margin-bottom: 0px !important;">No hay salas creadas</p>
        </div>

    <?php }?>
</div>
</div>
