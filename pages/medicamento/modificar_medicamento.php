<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=5){
    header('Location: ../../index.php');
		exit;
  }

  $id = $_GET['id'];
  $query = "select * from medicamento where id_medicamento = '{$id}';";
  $medicamento = selectEspecial($conexion,$query);
  $table = 'medicamento';
  $errores = '';

  if(isset($_POST['submit'])){


      $nombre = $_POST['nombre'];
      $almacen = $_POST['almacen'];
      $via = $_POST['via'];
      $tipo = $_POST['tipo'];

      $ruta="images/";//ruta carpeta donde queremos copiar las imágenes
      $uploadfile_temporal=$_FILES['imagen']['tmp_name'];
      echo $uploadfile_temporal;
      $uploadfile_nombre=$ruta.$_FILES['imagen']['name'];
      $nueva = '';
      if (is_uploaded_file($uploadfile_temporal))
      {
          $nueva = '1';
      }
      else
      {
          $nueva = '0';
      }
      if(empty($errores)){
        $imagenactual = '';
        if($medicamento){
          foreach ($medicamento as $dato) {
            $imagenactual = $dato["imagen"];
          }
        }
        echo $nueva;
        if($nueva == '1'){
            $query = "update {$table} SET nombre='{$nombre}',imagen='{$uploadfile_nombre}',almacen='{$almacen}',via_administracion='{$via}',tipo='{$tipo}' where id_medicamento='{$id}';";
            unlink($imagenactual);
            move_uploaded_file($uploadfile_temporal,$uploadfile_nombre);
        }else{
            $query = "update {$table} SET nombre='{$nombre}',almacen='{$almacen}',via_administracion='{$via}',tipo='{$tipo}' where id_medicamento='{$id}';";
        }
        $agregar = crear_registro($conexion,$query);
        echo $query;
        if($agregar){
          redirect('medicamento.php');
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

<title>Modificar Medicamento</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

    <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Medicamentos
        <small>Editar de Medicamento.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <div class="row" >
     <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Medicamento</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$id}" ?>" role="form" enctype="multipart/form-data">
              <?php foreach ($medicamento as $medi) {    ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="">Nombre</label>
                  <input type="text" class="form-control" name="nombre" placeholder="Nombre Medicamento" required
                  value="<?php echo $medi["nombre"]  ?>">
                </div>
                <div class="">
                  <label for="">Imagen Actual</label>
                    <img src="<?php echo $medi["imagen"] ?>" class="img-circle" alt="User Image" width="50" height="50" >
                </div>
                <div class="form-group">
                  <label for="">Imagen Nueva</label>
                  <input type="file" name="imagen">
                </div>
                 <div class="form-group">
                  <label for="">Almacen</label>
                  <input type="number" class="form-control" name="almacen" placeholder="Ingrese una capacidad." required
                  value="<?php echo $medi["almacen"] ?>">
                  <?php $imagenactual = $medi["almacen"]; ?>
                </div>
                <div class="form-group">
                  <label for="">Vía de administracion</label>
                  <select name="via" class="form-control" >
                    <option value="<?php echo $medi["via_administracion"] ?>"><?php echo $medi["via_administracion"] ?></option>
                    <option value="oral">oral</option>
                    <option value="intramuscular">intramuscular</option>
                    <option value="intravenosa">intravenosa</option>
                    <option value="subcutanea">subcutanea</option>
                    <option value="inhalatoria">inhalatoria</option>
                    <option value="transdermica">transdermica</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Tipo</label>
                  <select name="tipo" class="form-control" >
                    <option value="<?php echo $medi["tipo"] ?>"><?php echo $medi["tipo"] ?></option>                    
                    <option value="capsulas">capsulas</option>
                    <option value="jarabes">jarabes</option>
                    <option value="jeringas">jeringas</option>
                    <option value="capsulas">capsulas</option>
                    <option value="pastillas">pastillas</option>
                  </select>
                </div>

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
