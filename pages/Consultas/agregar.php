<?php
  require '../basedatos/conexion.php';

    $table = 'tabla';
    $errores = '';

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        if(empty($id)){
          $errores = 'Dame tu nombre <br/>';
        }
        if(empty($errores)){
          $query = "insert into {$table} values ({$id});";
          $agregar = crear_registro($conexion,$query);
          if($agregar){
            redirect('mostrar.php');
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
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">


        <div class="row" >
        <div class="col-xs-6">
          <div class="box" >
            <div class="box-header">
              <h3 class="box-title">Plantilla</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="box-body">
                  <div class="form-group">
                    <label for="">ID</label>
                    <input type="text" class="form-control" name="id" placeholder="Ingrese el ID" required>
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
