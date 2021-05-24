<?php
include_once "app/ControldeSesion.inc.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="<?php echo Ruta_CSS?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Ruta_CSS?>estilos.css">
    <!-- Cargando iconos -->
    <link href='<?php echo Ruta_CSS?>font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link rel="shorcout icon" type="image/x-icon" href="<?php echo Servidor."icono.ico"?>"/>

    <script src="<?php echo Ruta_js?>jquery-3.3.1.min.js"></script>
    <script src="<?php echo Ruta_js?>bootstrap.js"></script>

</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light" id="nav_user">
            <?php if (ControldeSesion::session_iniciada()){ ?>

            <div>
            <a class="navbar-brand" href="<?php echo Servidor?>"><img src="<?php echo Servidor."css/iconos/Home.png"?>" alt="Home" title="Inicio"></a>
           <?php if (isset($rutaback)){ ?>
            <a class="navbar-brand"  href="<?php echo $rutaback ?>"><img src="<?php echo Servidor."css/iconos/back.png"?>" alt="Back" title="Atrás"></a>
           <?php } ?>
          </div>
            <?php } ?>

          <h5 id="title_nav">El Genio de Leonardo Da Vinci</h5>
            <?php if (ControldeSesion::session_iniciada()){ ?>
            <ul class="navbar-nav" style="display: flex !important;
              flex-direction: row !important;" >
                   <li class="nav-item" style="margin-right: 10px">
                       <a class="nav-link" href="<?php echo Ruta_Actualizar ?>"><img src="<?php echo Servidor."css/iconos/Login User.png"?>" alt="User" title="Usuario"></a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link" href="<?php echo Ruta_Logout ?>"><img src="<?php echo Servidor."css/iconos/Logout.png"?>" alt="Logout" title="Salir"></a>
                   </li>

               </ul>

            <?php } ?>
        </nav>


</header>
