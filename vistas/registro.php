<?php

include_once "app/Conexion.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/config.inc.php";

include_once "app/Redireccion.inc.php";
include_once "app/Usuario.inc.php";
$title="Actualizar Usuario";
include_once "plantillas/cabecera.inc.php";

if (!ControldeSesion::session_iniciada()){
    Redireccion::redirigir(Ruta_Login);
}


if (isset($_POST["guardar"])){

    Conexion::abrir_Conexion();
    RepositorioUsuario::actualizar_usuario(Conexion::obtener_Conexion(),$_POST["id_usuario"],$_POST["exampleInputEmail1"]
        ,$_POST["exampleInputPassword1"]);
    Conexion::cerrar_Conexion();
    Redireccion::redirigir(Servidor);

}

?>

<div class="container" style="margin-top: 100px">
    <form role="form" method="post" class="form-control formLogin col-xs-12 col-sm-5" action="<?php echo Ruta_Actualizar ?>" enctype="multipart/form-data">
        <h2 style="text-align: center">Modificar usuario</h2>
        <div class="form-group">
            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION["id_usuario"] ?>">
            <label for="exampleInputEmail1">Usuario</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entre su usuario" value="<?php echo $_SESSION["nombre_usuario"]?>" required>

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Nueva contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1" placeholder="Contraseña" required>
            <img id="imgver" src="<?php echo Servidor."css/iconos/View2.png"  ?>" alt=""/>
        </div>
  <!--      <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="check1">
            <label class="form-check-label" for="check1">Mostrar contraseña</label>
        </div>-->


        <button type="submit" class="btn btn_agregar float-right" value="guardar" name="guardar">MODIFICAR</button>
    </form>
</div>

