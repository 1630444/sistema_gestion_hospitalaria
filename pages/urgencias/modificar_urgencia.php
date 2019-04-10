<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=3){
    header('Location: ../../index.php');
		exit;
  }

  $dato = $_GET['id'];
  $res = selectEspecial($conexion, "select * from urgencias where id_urgencia = {$dato}");
  $resmed = selectEspecial($conexion,"select m.id_medico idmedico, u.nombre unombre from medico m, usuarios u where m.usuario_id = u.id_usuario");
  $respac = selectEspecial($conexion,"select p.id_paciente idpaciente, u.nombre unombre from pacientes p, usuarios u where p.usuario_id = u.id_usuario");
  $errores = '';
  
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

        if(empty($fecha) or $fecha != date("Y-m-d") ){
          $errores .= 'Dame la Fecha de Ingreso <br/>';
        }

      if(empty($errores)){
          # Consulta para evitar que existan registros iguales en la tabla
          $res = selectEspecial($conexion,"SELECT * FROM urgencias WHERE id_paciente = {$id_paciente} AND id_medico = {$id_medico} AND diagnostico = '{$diagnostico}' AND fecha = '{$fecha}'");
          
          $res_id = selectEspecial($conexion,"SELECT * FROM urgencias WHERE id_paciente = {$id_paciente} AND id_medico = {$id_medico} AND diagnostico = '{$diagnostico}'  AND fecha = '{$fecha}' AND id_urgencia = {$id}");
        
          if($res == false){
            $query = "update urgencias SET id_paciente={$id_paciente},id_medico={$id_medico},diagnostico='{$diagnostico}',fecha='{$fecha}' WHERE id_urgencia={$id}";
            $actualizar = crear_registro($conexion,$query); 
            if($actualizar){
              redirect('urgencias.php');
            }
          }else if($res_id == false){
            redirect('carreras.php');
          }else{
            echo "El registro ya existe. Ingrese datos Distintos.";
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

         <!--Titulo dentro del contened-->
      <section class="content-header">
        <h1>
          Urgencias
          <small>Modificar urgencia.</small>
        </h1>
      </section>

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
                    <label for="id_medico">Médico</label>
                    <select name="id_medico" class="form-control">
                  <?php
                    while ($row = mysqli_fetch_array($resmed)) {
                      if($urge["id_medico"] == $row['idmedico']){
                        $medico_m = $row['unombre'];
                        echo "<option value={$urge['id_medico']} selected>{$medico_m}</option>";
                      }else{
                        echo "<option value={$row['idmedico']}>{$row['unombre']}</option>"; 
                      }
                    }
                  ?> 
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="id_paciente">Paciente</label>
                    <select name="id_paciente" class="form-control">
                  <?php
                    while ($row = mysqli_fetch_array($respac)) {

                      if($urge["id_paciente"] == $row['idpaciente']){
                        $paciente_m = $row['unombre'];
                        echo "<option value={$urge['id_paciente']} selected>{$paciente_m}</option>";
                      }else{
                        echo "<option value={$row['idpaciente']}>{$row['unombre']}</option>"; 
                      }
                    }
                  ?> 
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="diagnostico">Diagnóstico</label>
                    <textarea name="diagnostico" rows="5" cols="60" class="form-control" required><?php echo $urge['diagnostico']?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="fecha">Fecha de Ingreso</label>
                    <input type="date" class="form-control" name="fecha" value=<?php echo $urge['fecha']?> required>
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
