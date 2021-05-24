<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 24/9/2020
 * Time: 10:28
 */

include_once "app/Conexion.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";
include_once "app/config.inc.php";
include_once "app/RepositorioSalas.inc.php";

$title="Crear Sala";
include_once "plantillas/cabecera.inc.php";

if (!ControldeSesion::session_iniciada()){
    Redireccion::redirigir(Ruta_Login);
}

$errores=array();
$insertada=false;

if (isset($_POST["agregar"])){
    Conexion::abrir_Conexion();
    if (RepositorioSalas::obtener_Sala_Nombre(Conexion::obtener_Conexion(),$_POST["sala"])!=0){
        $errores[]="Ya existe una sala con ese nombre";
    }
    if (RepositorioSalas::obtener_Sala_Numero(Conexion::obtener_Conexion(),$_POST["sala_numero"])!=0){
        $errores[]="Ya existe una sala con ese número";
    }
    if (RepositorioSalas::obtener_Sala_Nombre_Ingles(Conexion::obtener_Conexion(),$_POST["sala_ingles"])!=0){
        $errores[]="Ya existe una sala con ese nombre en ingles";
    }

    if (empty($errores)){
        $insertada=RepositorioSalas::insertar_Sala(Conexion::obtener_Conexion(),$_POST["sala"],$_POST["sala_ingles"],$_POST["sala_numero"]);
    }

    Conexion::cerrar_Conexion();
    if ($insertada){
        Redireccion::redirigir(Servidor);
    }

}


?>

<div class="container" style="margin-top: 90px">
    <?php
    $top=20;
    if (isset($_POST["agregar"])){
        foreach ($errores as $error){
            ?>
            <div class="alert alert-danger myalert"  role="alert" style="top:<?php echo ($top+=75)."px" ?> ;">
                <?php echo $error."<br>" ?>
            </div>

        <?php }}?>

<form class="form" id="formularioSala" method="post" action="<?php echo Ruta_Crear_Sala ?>">
    <label for="sala_numero" class="col-sm-3 col-form-label">Número de sala:</label>
    <div class="col-sm-12">
        <input type="number" class="form-control" id="sala_numero" name="sala_numero" placeholder="#"
               value="<?php if (isset($_POST["sala_numero"])){ echo $_POST["sala_numero"];} ?>" required>
    </div>


    <div class="form-group">
        <label for="inputSala" class="col-sm-2 col-form-label">Nombre:</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" id="inputSala" name="sala" placeholder="Nombre exposición"
                   value="<?php if (isset($_POST["sala"])){ echo $_POST["sala"];} ?>" required>
        </div>
    </div>

    <div class="form-group">
        <label for="inputSalaIngles" class="col-sm-3 col-form-label">Nombre en inglés:</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" id="inputSalaIngles" name="sala_ingles" placeholder="Nombre exposición en ingles"
                   value="<?php if (isset($_POST["sala_ingles"])){ echo $_POST["sala_ingles"];} ?>" required>
        </div>
    </div>



    <button type="submit"  class="btn btn_agregar" name="agregar" style="margin-top: 20px;float: right;margin-right: 15px;">AGREGAR</button>

</form>

</div>