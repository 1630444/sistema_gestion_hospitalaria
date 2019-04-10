<?php
  require '../basedatos/conexion.php';
  require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=5){
    header('Location: ../../index.php');
		exit;
  }

    $table = 'medicamento';
    $errores = '';

    if(isset($_POST['submit'])){


        $nombre = $_POST['nombre'];
        $almacen = $_POST['almacen'];
        $via = $_POST['via'];
        $tipo = $_POST['tipo'];

        $ruta="images/";//ruta carpeta donde queremos copiar las imágenes
        $uploadfile_temporal=$_FILES['imagen']['tmp_name'];
        $uploadfile_nombre=$ruta.$_FILES['imagen']['name'];

        if (is_uploaded_file($uploadfile_temporal))
        {
            
        }
        else
        {
          $errores = 'error <br/>';
        }



        if(empty($errores)){
          $query = "insert into {$table} values (0,'{$nombre}','{$uploadfile_nombre}','{$almacen}','{$via}','{$tipo}');";
          $agregar = crear_registro($conexion,$query);
          move_uploaded_file($uploadfile_temporal,$uploadfile_nombre);
          if($agregar){
            redirect('medicamento.php');
          } else {
            echo $query;
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

<title>Agregar Medicamento</title>

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
        <small>Nuevo medicamento.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
<div class="row" >
        <div class="col-xs-6">
          <div class="box" >
            <div class="box-header">
              <h3 class="box-title">Agregar Medicamento</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form" enctype="multipart/form-data">

                <div class="form-group">
                  <label for="">Nombre</label>
                  <input type="text" class="form-control" name="nombre" placeholder="Nombre Medicamento" required>
                </div>
                <div class="form-group">
                  <label for="">Imagen</label>
                  <input type="file" name="imagen" required>
                </div>
                 <div class="form-group">
                  <label for="">Almacen</label>
                  <input type="number" class="form-control" name="almacen" placeholder="Ingrese una capacidad." required>
                </div>
                <div class="form-group">
                  <label for="">Vía de administracion</label>
                  <select name="via" class="form-control" >
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
                    <option value="capsulas">capsulas</option>
                    <option value="jarabes">jarabes</option>
                    <option value="jeringas">jeringas</option>
                    <option value="capsulas">capsulas</option>
                    <option value="pastillas">pastillas</option>
                  </select>
                </div>




                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" style="float: right;" name="submit">Agregar</button>
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
