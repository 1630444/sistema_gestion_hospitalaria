

<?php
  require '../basedatos/conexion.php';

  $table = 'aulas';
  $errores = '';

  if(isset($_POST['submit'])){
      $nombre = $_POST['nombre'];
      $edificio = $_POST['edificio'];
      $tipo = $_POST['tipo'];
      $capacidad = $_POST['capacidad'];

      $nombre = htmlspecialchars(trim($nombre));
      $edificio = htmlspecialchars(trim($edificio));
      $tipo = htmlspecialchars(trim($tipo));
      $capacidad = htmlspecialchars(trim($capacidad));

      if(empty($nombre)){
        $errores = 'Dame el nombre <br/>';
      }

      if(empty($edificio)){
        $errores .= 'Dame el edificio <br/>';
      }

      if(empty($tipo)){
        $errores .= 'Dame el tipo <br/>';
      }

      if(empty($capacidad)){
        $errores .= 'Dame la capacidad <br/>';
      }

      if(empty($errores)){
          $sql = "INSERT INTO aulas (nombre, edificio, tipo, capacidad)
                         VALUES ({$nombre},'{$edificio}','{$tipo}','{$capacidad}');";
        $agregar = crear_registro($conexion,$sql);
        redirect('aulas.php');
      }
  }

 ?>

 <!DOCTYPE html>
 <!--
 This is a starter template page. Use this page to start your new project from
 scratch. This page gets rid of all links and provides the needed markup only.
 -->
 <html>
 <title>Agregar aulas</title>
 <?php require '../menus/head.php' ?>

 <body class="hold-transition skin-blue sidebar-mini">
 <div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Aulas
        <small>Nueva aula.</small>
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
              <h3 class="box-title">Agregar aula</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="box-body">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Edificio</label>
                    <select name="edificio" class="form-control">
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Tipo</label>
                    <select name="tipo" class="form-control">
                      <option value="Aula">Aula</option>
                      <option value="Laboratorio">Laboratorio</option>
                    </select>
                  </div>

                   <div class="form-group">
                    <label for="exampleInputPassword1">Capacidad</label>
                    <input type="number" class="form-control" name="capacidad" placeholder="Ingrese la capacidad" required>
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
