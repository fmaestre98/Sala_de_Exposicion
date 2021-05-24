<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 10/9/2020
 * Time: 23:57
 */

include_once "app/config.inc.php";

include_once "app/Conexion.inc.php";
include_once "app/RepositorioUsuario.inc.php";
include_once "app/ControldeSesion.inc.php";
include_once "app/Redireccion.inc.php";

$title="Login";
$login=true;
include_once "plantillas/cabecera.inc.php";

if (ControldeSesion::session_iniciada()){
    Redireccion::redirigir(Servidor);
}

if (isset($_POST["login"])){
    Conexion::abrir_Conexion();

    $user=RepositorioUsuario::obtener_Usuario(Conexion::obtener_Conexion(),$_POST["exampleInputEmail1"]);
    if ($user && password_verify($_POST["exampleInputPassword1"],$user->getContrasenia())){
        ControldeSesion::iniciar_sesion($user->getId(),$_POST["exampleInputEmail1"]);
        Redireccion::redirigir(Servidor);

    }else{
       $login=false;
    }

    Conexion::cerrar_Conexion();

}

?>






<div class="container" style="margin-top: 90px;">

    <form role="form" id="" class="form-control formLogin col-xs-12 col-sm-5" method="post" action="<?php echo Ruta_Login?>" enctype="multipart/form-data">
          <h2 style="text-align: center">Autenticación</h2>
        <div class="form-group">
            <label for="exampleInputEmail1">Usuario:</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entre su usuario" required autofocus>

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Contraseña:</label>

                <input type="password" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1" placeholder="Contraseña" required="">
                <img id="imgver" src="<?php echo Servidor."css/iconos/View2.png"  ?>" alt=""/>


        </div>
  <!--      <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="check1">
            <label class="form-check-label" for="check1">Mostrar contraseña</label>
        </div>-->
        <button type="submit" class="btn btn_agregar float-right" value="login" style="width: 150px;"
                name="login">ENTRAR</button>
    </form>
    <?php if (!$login){ ?>
    <div class="alert alert-danger myalert" role="alert" style="margin-left: 15px">
        Datos Incorrectos
    </div>
    <?php } ?>

</div>

