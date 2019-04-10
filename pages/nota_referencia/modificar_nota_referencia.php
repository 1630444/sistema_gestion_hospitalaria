<?php
  require '../basedatos/conexion.php';
  $dato = $_GET['id'];
  $cita = $_GET['cita'];

  $query = "select * from nota_evolucion where id_nota_evolucion = '{$dato}'";
  $res= selectEspecial($conexion,$query);

  if(isset($_POST['submit'])){

      $id_nota = $_POST['id_nota_evolucion'];
      $descripcion = $_POST['descripcion'];
      //$id_cita = $_POST['id_cita'];
      $pronostico = $_POST['pronostico'];


      //if(empty($id_nota)){
      //  $errores = 'Por favor, ingrese un ID del cuatrimestre<br/>';
      //}

      /*
      if(empty($descripcion))
        $errores .= 'Por favor, describa las sustancias que consume el paciente.<br/>';
      else if(strlen($descripcion) > 250)
        $errores .= 'Asegurese de no superar los 250 caracteres en la descripción de sustancias.<br/>';

      if(empty($pronostico))
        $errores .= 'Por favor, ingrese un pronóstico para el paciente.<br/>';
      else if(strlen($pronostico) > 250)
        $errores .= 'Asegurese de no superar los 250 caracteres en el pronóstico del paciente.<br/>';*/

      if(empty($errores)){
        $query = "update nota_evolucion set abuso_sustancia='{$descripcion}', pronostico='{$pronostico}' WHERE id_nota_evolucion={$id_nota}";
        selectEspecial($conexion,$query);
        //if(selectEspecial($conexion,$query)){          
        redirect("nota_evolucion.php?id={$cita}");
        //}
      }
  }
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Modificar nota de evolución</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

    <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Nota de evolución
        <small>Editar nota de evolución.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <div class="row" >
     <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar nota de evolución</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$dato}&cita={$cita}" ?>" role="form">
            

              <?php foreach ($res as $nota) {    ?>

                
              <div class="box-body">

              <h5 style="color: red;">
                  <?php echo $errores; ?>
                </h5>

                  
                  <div class="form-group">
                    <label for="">Número de nota</label>
                    <input type="text" class="form-control" name="id_nota_evolucion" placeholder="" value=" <?php echo $nota["id_nota_evolucion"]?>" required readonly></input>
                  </div>
                  <br>
 
                  <div class="form-group">
                    <label for="">Abuso de sustancias</label>
                    <input type="text" class="form-control" name="descripcion" placeholder="" value="<?php echo $nota["abuso_sustancia"]?>" required></input>
                  </div>
                  <br>

                  
                  <div class="form-group">
                    <label for="">Número de cita</label>
                    <input type="text" class="form-control" name="id_cita" placeholder="" value="<?php echo $nota["id_cita"]?>" required readonly></input>
                  </div>
                  <br>

                  
                  <div class="form-group">
                    <label for="">Pronóstico</label>
                    <input type="text" class="form-control" name="pronostico" placeholder="" value="<?php echo $nota["pronostico"]?>" required></input>
                  </div>
                  <br> 

              </div>
              <!-- /.box-body -->
                <?php } ?>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" style="float: right;" name="submit">Modificar</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        </div>

    </section>
    </div>
  </div>
    <!-- /.content -->
  <?php require  '../menus/footer.php' ?>
</body>
</html>
