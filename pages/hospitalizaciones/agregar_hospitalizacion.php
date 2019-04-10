<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=3){
    header('Location: ../../index.php');
		exit;
  }

    $d_medico = selectEspecial($conexion, "select med.id_medico as id_medico, med.usuario_id, us.nombre as nombre_medico, us.apellido as apellido_medico 
                  from medico med, usuarios us 
                  where med.usuario_id = us.id_usuario");    
    $d_paciente = selectEspecial($conexion, "select pac.id_paciente as id_paciente, pac.usuario_id, us.nombre as nombre_paciente, us.apellido as apellido_paciente 
                  from pacientes pac, usuarios us 
                  where pac.usuario_id = us.id_usuario");    
    
    $medico = select($conexion, 'medico');
    $paciente = select($conexion, 'pacientes');
    $cama = selectEspecial($conexion, 'select id_cama from cama where estado = 0');

    $table = 'hospitalizacion';
    $errores = '';

    if(isset($_POST['submit'])){
        
        $id_paciente = $_POST['id_paciente'];
        $id_medico = $_POST['id_medico'];
        $diagnostico = $_POST['diagnostico'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $fecha_egreso = $_POST['fecha_egreso'];
        $id_cama = $_POST['id_cama'];
        $corta_estancia = $_POST['corta_estancia'];


        if(empty($id_paciente)){
          $errores .= 'Dame el ID del paciente <br/>';
        }

        if(empty($id_medico)){
          $errores .= 'Dame el ID del Médico <br/>';
        }

        if(empty($diagnostico)){
          $errores .= 'Dame el diagnóstico <br/>';
        }

        if(empty($fecha_ingreso)){
          $errores .= 'Dame la Fecha de Ingreso <br/>';
        }

        if(empty($fecha_egreso)){
          $errores .= 'Dame la Fecha de Egreso <br/>';
        }

        if(empty($id_cama)){
          $errores .= 'Dame el ID de la Cama <br/>';
        }

        if(empty($corta_estancia)){
          $errores .= 'Corta estancia <br/>';
        }

        if(empty($errores)){
          $query_urg = "insert into urgencias (id_paciente, id_medico, diagnostico, fecha) values ('{$id_paciente}', '{$id_medico}', '{$diagnostico}', '{$fecha_ingreso}');";

          $agregar = crear_registro($conexion,$query_urg);
          
          $d_urg = select($conexion, 'urgencias');
          foreach ($d_urg as $urg) {
            $id_urgencia = $urg['id_urgencia'];
          }
          
          $query = "insert into hospitalizacion (id_urgencia, id_cama, fecha_ingreso, fecha_egreso, corta_estancia) values ('{$id_urgencia}',{$id_cama},'{$fecha_ingreso}','{$fecha_egreso}',{$corta_estancia});";          
          
          $agregar1 = crear_registro($conexion,$query);
          
          $query_cama = "update cama set estado = 1 where id_cama = {$id_cama};";
          $agregar_cama = crear_registro($conexion,$query_cama);
         
          if($agregar && $agregar1){
            redirect('hospitalizaciones.php');
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

<title>Agregar hospitalización</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Hospitalizaciones
        <small>Nueva hospitalización.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
<div class="row" >
        <div class="col-xs-12">
          <div class="box" >
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="box-body">
                  <!--<div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" name="id" placeholder="Ingrese el ID" required>
                  </div>  ES AUTOINCREMENTABLE-->
                  <div class="form-group">
                    <label for="id_medico">Médico</label>
                    <select name="id_medico" class="form-control">
                  <?php
                    foreach ($d_medico as $medico) {
                      echo "<option value='{$medico['id_medico']}'>{$medico['id_medico']} "." " ."{$medico['apellido_medico']} "." " ."{$medico['nombre_medico']}  </option>"; 
                    }

                  ?> 
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="id_paciente">Paciente</label>
                    <select name="id_paciente" class="form-control">
                  <?php
                    foreach ($d_paciente as $paciente) {
                      echo "<option value='{$paciente['id_paciente']}'>{$paciente['id_paciente']} "." " ."{$paciente['apellido_paciente']} "." " ."{$paciente['nombre_paciente']}  </option>";
                    }
                  ?> 
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="diagnostico">Diagnóstico</label>
                    <textarea name="diagnostico" rows="5" cols="60" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <?php $fecha_actual = date("d-m-Y"); ?>
                    
                    <input type="date" class="form-control" name="fecha_ingreso" value=<?php echo  date("Y-m-d");?> required </inpu>
                  </div>
                  <div class="form-group">
                  <label for="fecha_egreso">Fecha de Egreso</label>
                    
                  <input type="date" class="form-control" name="fecha_egreso"  value=<?php echo  date("Y-m-d",strtotime($fecha_actual."+ 5 days"));?> required>
                  </div>

                  <div class="form-group">
                    <label for="id_cama">Cama</label>
                    <select name="id_cama" class="form-control">
                  <?php
                    foreach ($cama as $d_cama) {
                      echo "<option value='{$d_cama['id_cama']}'>{$d_cama['id_cama']} </option>";
                    }
                  ?> 
                  </select>
                  </div>

                  <div class="form-group">
                    <label for="corta_estancia">¿Corta Estancia?</label>
                    <input type="radio" name="corta_estancia" value="1">Si &nbsp;&nbsp;&nbsp;
                    <input type="radio" name="corta_estancia" value="2">No
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" style="float: right;" name="submit">Añadir</button>
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
