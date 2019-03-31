<?php
  require '../basedatos/conexion.php';
  $dato = $_GET['id'];
  $res= obtener_resultado_por_id($conexion,$dato,'materias');

  if(isset($_POST['submit'])){

      $id = $_POST['id'];
      $nombre = $_POST['nombre'];
      $nombre_corto = $_POST['nombre_corto'];


      if(empty($id)){
        $errores = 'Dame tu nombre <br/>';
      }

      if(empty($nombre)){
        $errores .= 'Dame tu nombre_corto <br/>';
      }

      if(empty($errores)){
        $query = "update materias SET nombre='$nombre',nombre_corto='$nombre_corto' WHERE id=$id";
        $actualizar = crear_registro($conexion,$query);
        if($actualizar){
          redirect('materias.php');
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
<title>Modificar materia</title>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Materias
        <small>Editar materia.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar materia</h3>
            </div>
            <!-- /.box-header -->
            <!-- IMPORTANTE NO CAMBIAR ?id= a menos que tu llave no se llame id pero
            es necesario que al hacer el post mandes de nuevo el valor que tienes por parametro-->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$dato}" ?>" role="form">
              <?php foreach ($res as $valor) {    ?>
              <div class="box-body">
                <div class="form-group">

                  <label for="">ID</label>
                  <input type="text" class="form-control" name="id" placeholder="Ingrese el ID" value=" <?php echo $valor["id"]?> " required readonly>
                </div>
                <div class="form-group">
                  <label for="">Nombre</label>
                  <input type="text" class="form-control" name="nombre" placeholder="Ingrese una descripcion" value="<?php echo $valor["nombre"]?>" required>
                </div>
                <div class="form-group">
                  <label for="">Nombre Corto</label>
                  <input type="text" class="form-control" name="nombre_corto" placeholder="Ingrese una descripcion" value="<?php echo $valor["nombre_corto"]?>" required>
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
