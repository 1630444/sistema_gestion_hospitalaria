<?php
  require '../basedatos/conexion.php';

    $table = 'carreras';
    $errores = '';

    if(isset($_POST['submit'])){

        #$id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $siglas = $_POST['siglas'];


        #if(empty($id)){
         # $errores = 'Dame el idetificador <br/>';
        #}

        if(empty($nombre)){
          $errores .= 'Dame el nombre <br/>';
        }

        if(empty($siglas)){
          $errores .= 'Dame las siglas <br/>';
        }

        if(empty($errores)){
          $query = "insert into {$table} (nombre, siglas) values ('{$nombre}','{$siglas}');";
          $agregar = crear_registro($conexion,$query);
          if($agregar){
            redirect('carreras.php');
          }
        }
    }
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<title>Agregar carrera</title>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Carreras
        <small>Nueva carrera.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
<div class="row" >
        <div class="col-xs-6">
          <div class="box" >
            <div class="box-header">
              <h3 class="box-title">Agregar carrera</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="box-body">
                  <!--<div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" name="id" placeholder="Ingrese el ID" required>
                  </div>-->
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese la carrera" required>
                  </div>
                  <div class="form-group">
                    <label for="siglas">Siglas</label>
                    <input type="text" class="form-control" name="siglas" placeholder="Ingrese las siglas" required>
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Agregar</button>
                </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col -->
      </div>






    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php require '../menus/footer.php' ?>

</div>

</body>
</html>
