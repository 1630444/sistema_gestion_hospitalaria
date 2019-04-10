<?php
  require '../basedatos/conexion.php';
  require '../sesion/abre_sesion.php';
  if(!($_SESSION['tipo']==5 || $_SESSION['tipo']==4)){
    header('Location: index.php');
		exit;
  }
 ?>
 <!DOCTYPE html>

<html>

<title>Inicio</title>

<?php require '../menus/head.php' ?>


<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
  <h1>BIENVENIDO EMPLEADO</h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php require '../menus/footer.php' ?>

</div>

</body>
</html>
