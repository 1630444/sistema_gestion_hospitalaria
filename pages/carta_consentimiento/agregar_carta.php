<?php
  require '../basedatos/conexion.php';

    
    $citas = select($conexion, "cita");

    $table = 'nota_evolucion';
    $errores = '';

    if(isset($_POST['submit'])){


        //$nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $id_cita = $_POST['cita'];
        $pronostico = $_POST['pronostico'];

        //$ruta="images/";//ruta carpeta donde queremos copiar las imágenes
        //$uploadfile_temporal=$_FILES['imagen']['tmp_name'];
        //$uploadfile_nombre=$ruta.$_FILES['imagen']['name'];

        //if (is_uploaded_file($uploadfile_temporal))
        //{
            
        //}
        //else
        //{
        //  $errores = 'error <br/>';
        //}



        if(empty($errores)){
          $query = "insert into {$table} (abuso_sustancia, id_cita, pronostico) values ('{$descripcion}','{$id_cita}','{$pronostico}')";
          $agregar = crear_registro($conexion,$query);          
          if($agregar){
            redirect('nota_evolucion.php');
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
                  <label for="">Abuso_sustancia</label>
                  <input type="text" class="form-control" name="descripcion" placeholder="Especifique las sustancias consumidas por el paciente." required>
                </div> 
                
                 <div class="form-group">
                  <label for="">Número de cita</label>
                   
                  <select class="form-control" name="cita" required>
                    <?php foreach($citas as $cita) { ?>
                      <option value="<?php echo $cita['id_cita'] ?>">
                      <?php echo ($cita["id_cita"]) ?></option>   
                    <?php } ?>
                   </select>                 
                </div>
                
                <div class="form-group">
                  <label for="">Pronóstico</label>
                  <input type="text" class="form-control" name="pronostico" placeholder="Especifique el pronostico para el paciente." required>
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
