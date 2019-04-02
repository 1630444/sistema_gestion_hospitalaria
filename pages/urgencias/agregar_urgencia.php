<?php
  require '../basedatos/conexion.php';
  $resmed = select($conexion,'medico');
  $respac = select($conexion,'pacientes');

    $table = 'urgencias';
    $errores = '';

    if(isset($_POST['submit'])){

        $id_paciente = $_POST['id_paciente'];
        $id_medico = $_POST['id_medico'];
        $diagnostico = $_POST['diagnostico'];
        $fecha = $_POST['fecha'];
        

        if(empty($id_paciente)){
          $errores .= 'Dame el ID del paciente <br/>';
        }

        if(empty($id_medico)){
          $errores .= 'Dame el ID del Médico <br/>';
        }

        if(empty($diagnostico)){
          $errores .= 'Dame el diagnóstico <br/>';
        }

        if(empty($fecha)){
          $errores .= 'Dame la Fecha de Ingreso <br/>';
        }

        if(empty($errores)){
          $query = "insert into {$table} (id_paciente, id_medico, diagnostico, fecha) values ({$id_paciente},{$id_medico},'{$diagnostico}','{$fecha}');";
          $agregar = crear_registro($conexion,$query);
          if($agregar){
            redirect('urgencias.php');
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

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
<div class="row" >
        <div class="col-xs-6">
          <div class="box" >
            <div class="box-header">
              <h3 class="box-title">Urgencias</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="box-body">
                  <!--<div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" name="id" placeholder="Ingrese el ID" required>
                  </div>  ES AUTOINCREMENTABLE-->
                  <div class="form-group">
                    <label for="id_medico">ID del Médico</label>
                    <select name="id_medico" class="form-control">
                  <?php
                    while ($row = mysqli_fetch_array($resmed)) {
                      echo "<option value='{$row['id_medico']}'>{$row['nombre']}</option>"; 
                    }
                  ?> 
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="id_paciente">ID del Paciente</label>
                    <select name="id_paciente" class="form-control">
                  <?php
                    while ($row = mysqli_fetch_array($respac)) {
                      echo "<option value='{$row['id_paciente']}'>{$row['nombre']}</option>"; 
                    }
                  ?> 
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="diagnostico">Diagnóstico</label>
                    <textarea name="diagnostico" rows="5" cols="60" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" name="fecha" required>
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Añadir</button>
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
