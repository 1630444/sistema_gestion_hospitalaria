<?php
  require '../basedatos/conexion.php';

  $id_hosp = $_GET['id'];

  $query = "select id_dato, nombre from datos_referencias";
  $hospitales = selectEspecial($conexion, $query);
    
    //$citas = select($conexion, "urgencias");
    
    

    $table = 'referencias_y_translados';
    $errores = '';

    if(isset($_POST['submit'])){

        $errores = '';
        
        $origen = $_POST['origen'];        
        $destino = $_POST['destino'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];
 
        if($origen = 'Seleccione') {
          $errores .= '* Elija un lugar de origen.';
        }
      
        if($destino = 'Seleccione') {
          $errores .= '* Elija un lugar de destino.';
        }
      
        if($origen == $destino) {
          $errores .= 'No es posible transladar a un paciente al mismo hospital.';
        }        


        if(empty($errores)){
          $query = "insert into {$table} (abuso_sustancia, id_cita, pronostico) values ('{$descripcion}',{$id_cita},'{$pronostico}')";
          echo $query;
          $agregar = crear_registro($conexion,$query);          
          if($agregar){
            redirect("nota_evolucion.php?id={$id_hosp}");
          }
        } else {
          //echo $errores;
        }
    }
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Agregar nota de evolución</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Nota de referencia y translado
        <small>Nueva nota de referencia y translado.</small>
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
                    <h3 class="box-title">Agregar nota de referencia y translado</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body" align="">
                    <!-- form start -->
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$id_hosp}" ?>" role="form" enctype="multipart/form-data">

                      <div class="form-group">
                        <label for="">Origen</label>
                        <select name="origen" class="form-control">
                        <?php
                            echo "<option value='-1'>Seleccione</option>";
                          foreach ($hospitales as $dato) {
                            echo "<option value='{$dato['id_dato']}'>{$dato['nombre']}</option>";
                          }
                        ?> 
                        </select>
                      </div> 

                       <div class="form-group">
                        <label for="">Destino</label>
                        <select name="destino" class="form-control">
                        <?php
                          echo "<option value='-1'>Seleccione</option>";
                          foreach ($hospitales as $dato) {
                            echo "<option value='{$dato['id_dato']}'>{$dato['nombre']}</option>";
                          }
                        ?>
                         </select>
                      </div>

                      <div class="form-group">
                        <label for="">Descripción terapéutica</label>
                        <input type="text" class="form-control" name="descripcion" placeholder="Ingrese información terápeutica sobre el paciente." required>
                      </div>
                    
                      <div class="form-group">
                      <label for="">Fecha</label>
                      <input type="date" class="form-control" name="fecha" required>
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
