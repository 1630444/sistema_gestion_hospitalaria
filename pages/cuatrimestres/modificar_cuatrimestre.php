<?php
  require '../basedatos/conexion.php';
  $dato = $_GET['id'];
  $res= obtener_resultado_por_id($conexion,$dato,'cuatrimestres');

  if(isset($_POST['submit'])){

      $id = $_POST['id'];
      $desc = $_POST['descripcion'];
      $inicio = $_POST['inicio'];
      $termino = $_POST['termino'];


      if(empty($id)){
        $errores = 'Por favor, ingrese un ID del cuatrimestre<br/>';
      }

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
        $query = "update cuatrimestres SET descripcion='{$desc}',fecha_inicio='{$inicio}',fecha_termino={$termino} WHERE id={$id}";
        $actualizar = crear_registro($conexion,$query);
        if($actualizar){
          echo $query;
          redirect('cuatrimestres.php');
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

<title>Modificar cuatrimestre</title>

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
        <small>Editar de cuatrimestres.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <div class="row" >
     <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar cuatrimestre</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$dato}" ?>" role="form">
            

              <?php foreach ($res as $cuatri) {    ?>

                
              <div class="box-body">

              <h5 style="color: red;">
                  <?php echo $errores; ?>
                </h5>

                  <label for="id">* ID</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" name="id" placeholder="Ingrese el ID de cuatrimestre" value=" <?php echo $cuatri["id"]?>" required readonly>
                  </div>
                  <br>

                  <label for="descripcion">* Descrcipción</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-info "></i></span>
                    <input type="text" class="form-control" name="descripcion" placeholder="Ingrese una descripción del cuatrimestre" value="<?php echo $cuatri["descripcion"]?>" required>
                  </div>
                  <br>

                  <label for="inicio">* Fecha Inicio</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa  fa-calendar"></i></span>
                    <input type="date" class="form-control" name="inicio" placeholder="Fecha de inicio del cuatrimestre" value="<?php echo $cuatri["fecha_inicio"]?>" required>
                  </div>
                  <br>

                  <label for="termino">Fecha Termino</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa   fa-calendar-check-o "></i></span>
                    <input type="date" class="form-control" name="termino" placeholder="Fecha de termino del cuatrimestre" value="<?php echo $cuatri["fecha_termino"]?>">
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
    <!-- /.content -->
  <?php require  '../menus/footer.php' ?>
</body>
</html>
