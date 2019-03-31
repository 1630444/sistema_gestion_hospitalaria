<?php
  require '../basedatos/conexion.php';

    $table = 'cuatrimestres';
    $errores = '';

    if(isset($_POST['submit'])){

        $id = $_POST['id'];
        $desc = $_POST['descripcion'];
        $inicio = $_POST['inicio'];
        $termino = $_POST['termino'];


        if(empty($id))
          $errores = 'Por favor, ingrese un ID del cuatrimestre<br/>';
        else if(!is_numeric($id))
          $errores = 'El ID debe ser numerico<br/>';

        if(empty($desc))
          $errores .= 'Por favor, ingrese una descrpción del cuatrimestre<br/>';
        else if(strlen($desc) > 20)
          $errores .= 'Asegurese de no superar los 20 caracteres en la descripción.<br/>';

        if(empty($inicio)){
          $errores .= 'Por favor, ingrese una fecha de inicio del cuatrimestre<br/>';
        }

        if(empty($termino))
          $termino = 'null';
        else
          $termino = "'".$termino."'";

        if(empty($errores)){
          $query = "insert into {$table} values ({$id},'{$desc}','{$inicio}',{$termino});";
          $agregar = crear_registro($conexion,$query);
          if($agregar){
            redirect('cuatrimestres.php');
          } else {
            $errores .= "El ID '$id' ya fue asigano antes.<br/>";
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

<title>Agregar cuatrimestre</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Cuatrimestres
        <small>Nuevo cuatrimestre.</small>
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
              <h3 class="box-title">Agregar cuatrimestre</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                
                <h5 style="color: red;">
                  <?php echo $errores; ?>
                </h5>

                <div class="box-body">

                <label for="id">* ID</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" name="id" placeholder="Ingrese el ID de cuatrimestre" required>
                  </div>
                  <br>

                  <label for="descripcion">* Descrcipción</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-info "></i></span>
                    <input type="text" class="form-control" name="descripcion" placeholder="Ingrese una descripción del cuatrimestre" required>
                  </div>
                  <br>

                  <label for="inicio">* Fecha Inicio</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-calendar"></i></span>
                    <input type="date" class="form-control" name="inicio" placeholder="Fecha de inicio del cuatrimestre" required>
                  </div>
                  <br>

                  <label for="termino">Fecha Termino</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa   fa-calendar-check-o "></i></span>
                    <input type="date" class="form-control" name="termino" placeholder="Fecha de termino del cuatrimestre">
                  </div>
                  <br>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" style="float: right;" name="submit">Agegar</button>
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
