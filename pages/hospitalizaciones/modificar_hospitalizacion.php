<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=3){
    header('Location: ../../index.php');
		exit;
  }

  $dato = $_GET['id_hospitalizacion'];
  $paciente = select($conexion, 'pacientes');
  $cama = select($conexion, 'cama');
  
  $id_hops = $dato;

  foreach ($cama as $camita) {
    $id = $camita['id_cama'];
  }
  
  $h_medico = "select med.id_medico as id_medico, us.nombre as nombre_medico, us.apellido as apellido_medico 
              from medico med 
              inner join usuarios us
              on med.usuario_id = us.id_usuario";
  
  $h_paciente = "select pac.id_paciente as id_paciente, us.nombre as nombre_paciente, us.apellido as apellido_paciente 
              from pacientes pac 
              inner join usuarios us
              on pac.usuario_id = us.id_usuario";
  
  $medico = mysqli_query($conexion,$h_medico) or die('Error al ejecutar la consulta');
  $paciente = mysqli_query($conexion,$h_paciente) or die('Error al ejecutar la consulta');

  

  $query_paciente = "select hosp.id_hospitalizacion as id_hospitalizacion, hosp.id_urgencia, hosp.id_cama as cama, hosp.fecha_ingreso as fecha_ingreso, 
  hosp.fecha_egreso as fecha_egreso, hosp.corta_estancia as corta_estancia, urg.id_urgencia as id_urgencia, urg.id_paciente as id_paciente, 
  urg.diagnostico as diagnostico, us.nombre as nombre_paciente, us.apellido as apellido_paciente

    from 
    hospitalizacion hosp
    inner join urgencias urg
      on hosp.id_urgencia = urg.id_urgencia
    inner join pacientes pac 
      on urg.id_paciente = pac.id_paciente
    inner join usuarios us
      on pac.usuario_id = us.id_usuario
    where hosp.id_hospitalizacion = ".$dato.";";

  


$query_medico =  "select hosp.id_hospitalizacion as id_hospitalizacion, hosp.id_urgencia, hosp.id_cama as cama, hosp.fecha_ingreso as fecha_ingreso, 
  hosp.fecha_egreso as fecha_egreso, hosp.corta_estancia as corta_estancia, urg.id_urgencia as id_urgencia, urg.id_medico as id_medico, 
  urg.diagnostico as diagnostico, us.nombre as nombre_medico, us.apellido as apellido_medico

    from 
    hospitalizacion hosp
    inner join urgencias urg
      on hosp.id_urgencia = urg.id_urgencia
    inner join medico med 
      on urg.id_medico = med.id_medico
    inner join usuarios us
      on med.usuario_id = us.id_usuario
    where hosp.id_hospitalizacion = ".$dato.";";
  
  $hosp_paciente = mysqli_query($conexion,$query_paciente) or die('Error al ejecutar la consulta');
  $hosp_medico = mysqli_query($conexion,$query_medico) or die('Error al ejecutar la consulta');
  
  //echo "hola";
  //echo $query_medico;

  if(isset($_POST['submit'])){

        $id_paciente = $_POST['id_paciente'];
        $id_medico = $_POST['id_medico'];
        $diagnostico = $_POST['diagnostico'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $fecha_egreso = $_POST['fecha_egreso'];
        $id_cama = $_POST['id_cama'];
        $corta_estancia = $_POST['corta_estancia'];
        $id_urgencia = $_POST['id_urgencia'];
    
        if(empty($id_urgencia)){
          $errores.= 'Dame el ID de Urgencia <br />';
        }
    
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

        # Es opcional para corta estancia
        #if(empty($fecha_egreso)){
          #$errores .= 'Dame la fecha de egreso <br/>';
          #$fecha_egreso = '1999/11/02';
        #}

        if(empty($id_cama)){
          $errores .= 'Dame el ID de la Cama <br/>';
        }

        # Es opcional para corta estancia
        #if(empty($corta_estancia)){
          #$errores .= 'Dame el número de cama <br/>';
          #$corta_estancia=0;
        #}
       
       if(empty($errores)){
        $query = "UPDATE hospitalizacion hosp 
        INNER JOIN urgencias urg on urg.id_urgencia = '{$id_urgencia}'
        set urg.id_paciente = '{$id_paciente}', urg.id_medico = '{$id_medico}', urg.diagnostico = '{$diagnostico}', 
        hosp.id_cama = '{$id_cama}', hosp.fecha_ingreso='{$fecha_ingreso}',hosp.fecha_egreso='{$fecha_egreso}',
        hosp.corta_estancia ='{$corta_estancia}'
        WHERE id_hospitalizacion= ".$id_hops .";";

         
        $actualizar = crear_registro($conexion,$query); 
        if($actualizar){
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

<title>Modificar hospitalización</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        <Pacientes>Hospitalización</Pacientes>
        <small>Editar hospitalización.</small>
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
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id_hospitalizacion={$id_hops}" ?>" role="form">
                
                <h5 style="color: red;">
                  <?php echo $errores; ?>
                </h5>
                

                <?php while(($d_med = mysqli_fetch_array($hosp_medico))!=NULL and ($d_pac = mysqli_fetch_array($hosp_paciente))!=NULL) { ?>
             
              <div class="box-body">  
                <div class="form-group">
                      
                  <label for="id_medico">N° de Urgencia</label>
                  <div class="form-group">
                    <input type="text" name="id_urgencia" class="form-control" value="<?php echo $d_med['id_urgencia']?>" required readonly/> 
                  </div>    
 
                  
                  <label for="id_medico">Médico</label>
                    <select name="id_medico" class="form-control">
                  <?php
                    foreach ($medico as $d_medico) {
                      if($d_med['id_medico'] == $d_medico['id_medico']){
                        echo "<option value='{$d_med['id_medico']}' selected>{$d_med['id_medico']} "." "."{$d_med['apellido_medico']} "." " ."{$d_med['nombre_medico']}</option>"; 
                      }else{
                        echo "<option value='{$d_medico['id_medico']}'>{$d_medico['id_medico']} "." "."{$d_medico['apellido_medico']} "." " ."{$d_medico['nombre_medico']}</option>"; 
                      } 
                    }
                  ?> 
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="id_paciente">Paciente</label>
                    <select name="id_paciente" class="form-control">

                  
                  <?php
                    foreach ($paciente as $d_paciente) {
                      if($d_pac['id_paciente'] == $d_paciente['id_paciente']){
                        echo "<option value='{$d_pac['id_paciente']}' selected>{$d_pac['id_paciente']} "." " ."{$d_pac['apellido_paciente']} "." " ."{$d_pac['nombre_paciente']}  </option>";
                      }else{
                        echo "<option value='{$d_paciente['id_paciente']}'>{$d_paciente['id_paciente']} "." " ."{$d_paciente['apellido_paciente']} "." " ."{$d_paciente['nombre_paciente']}  </option>";
                      }
                    }
                  ?> 
                  </select>

                  </div>
                  <div class="form-group">
                    <label for="diagnostico">Diagnóstico</label>
                    <textarea name="diagnostico" rows="5" cols="60" class="form-control" value="<?php echo $d_med['diagnostico']?>" required><?php echo $d_med['diagnostico']?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                    <input type="date" class="form-control" name="fecha_ingreso" value="<?php echo $d_med['fecha_ingreso'];?>" required>
                  </div>
                  

                  <div class="form-group">
                  <label for="fecha_egreso">Fecha de Egreso</label>
                  <input type="date" class="form-control" name="fecha_egreso" value="<?php echo $d_med['fecha_egreso'];?>">
                  </div>

                  <div class="form-group">
                    <label for="id_cama">Cama</label>
                    <select name="id_cama" class="form-control">
                    
                  <?php
                    foreach ($cama as $d_cama) {
                      if($d_cama['id_cama'] == $d_med['cama']){
                        echo "<option value=".$d_cama['id_cama']." selected>". $d_cama['id_cama']." </option>";  
                      }else{
                        echo "<option value=".$d_cama['id_cama'].">". $d_cama['id_cama']." </option>";  
                      }
                      
                    }
                  ?> 
                  </select>
                  </div>

                  <div class="form-group">
                    <label for="corta_estancia">¿Corta Estancia?</label>
                    <?php if($d_med['corta_estancia'] == 0){ ?>
                      <input type="radio" name="corta_estancia" value="1">Si &nbsp;&nbsp;&nbsp;
                      <input type="radio" name="corta_estancia" value="0" checked>No
                    <?php }else{ ?>
                      <input type="radio" name="corta_estancia" value="1" checked>Si &nbsp;&nbsp;&nbsp;
                      <input type="radio" name="corta_estancia" value="0">No
                    <?php } ?>
                  </div>
              </div>
              <!-- /.box-body -->
                <?php } ?>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" style="float: right;" name="submit">Modificar</button>
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
