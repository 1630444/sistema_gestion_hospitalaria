<?php
  require '../basedatos/conexion.php';
  $dato = $_GET['id'];
  $res= obtener_resultado_por_id($conexion,$dato,'carreras');

  if(isset($_POST['submit'])){

      $id = $_POST['id'];
      $nombre = $_POST['nombre'];
      $siglas = $_POST['siglas'];


      if(empty($id)){
        $errores = 'Dame el idetificador <br/>';
      }

      if(empty($nombre)){
        $errores .= 'Dame el nombre <br/>';
      }

      if(empty($siglas)){
        $errores .= 'Dame las siglas <br/>';
      }

      if(empty($errores)){
        $query = "update carreras SET nombre='{$nombre}',siglas='{$siglas}' WHERE id={$id}";
        $actualizar = crear_registro($conexion,$query); 
        if($actualizar){
          redirect('carreras.php');
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
<title>Modificar carrera</title>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Carreras
        <small>Editar carrera.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar carrera</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$dato}" ?>" role="form">
              <?php foreach ($res as $carre) {    ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="id">ID</label>
                  <input type="text" class="form-control" name="id" placeholder="Ingrese el ID" value=" <?php echo $carre["id"]?> " required readonly>
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" name="nombre" placeholder="Ingrese la carrera" value="<?php echo $carre["nombre"]?>" required>
                </div>
                <div class="form-group">
                  <label for="siglas">Siglas</label>
                  <input type="text" class="form-control" name="siglas" placeholder="Ingrese las siglas" value="<?php echo $carre["siglas"]?>" required>
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
