<?php
  require '../basedatos/conexion.php';
  $dato = $_GET['id'];
  $res= obtener_resultado_por_id2($conexion,$dato,'urgencias','id_urgencia');
  $resmed = select($conexion,'medico');
  $respac = select($conexion,'pacientes');

  if(isset($_POST['submit'])){
        $id = $_POST['id'];
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
        $query = "update urgencias SET id_paciente={$id_paciente},id_medico={$id_medico},diagnostico='{$diagnostico}',fecha='{$fecha}' WHERE id_urgencia={$id}";
        $actualizar = crear_registro($conexion,$query); 
        if($actualizar){
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

     <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Urgencias</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$dato}" ?>" role="form">
              <?php foreach ($res as $urge) {    ?>
              <div class="box-body">  
                  <div class="form-group">
                  <label for="id">ID</label>
                  <input type="text" class="form-control" name="id" placeholder="Ingrese el ID" value=" <?php echo $urge["id_urgencia"]?> " required readonly>
                </div>

                <div class="form-group">
                    <label for="id_medico">ID del Médico</label>
                    <select name="id_medico" class="form-control">
                    <option value=" <?php echo $urge["id_medico"]?> " selected></option>
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
                    <option value=" <?php echo $urge["id_paciente"]?> " selected></option>
                  <?php
                    while ($row = mysqli_fetch_array($respac)) {
                      echo "<option value='{$row['id_paciente']}'>{$row['nombre']}</option>";
                    }
                  ?> 
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="diagnostico">Diagnóstico</label>
                    <textarea name="diagnostico" rows="5" cols="60" class="form-control" value="<?php echo $urge["diagnostico"]?>" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="fecha">Fecha de Ingreso</label>
                    <input type="date" class="form-control" name="fecha" value=" <?php echo $urge["fecha"]?> " required>
                  </div>
              </div>
              <!-- /.box-body -->
                <?php } ?>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit">Modificar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
  <?php require  '../menus/footer.php' ?>
</body>
</html>
