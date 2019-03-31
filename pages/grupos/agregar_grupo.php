<?php
  require '../basedatos/conexion.php';

    $table = 'grupos';
    $errores = '';

    //Querys para llenar los campos requeridos.

    $query = 'select id,nombre from carreras';
    $carreras = selectEspecial($conexion,$query);

    $query = 'select id,clave from planes_estudio';
    $planes = selectEspecial($conexion,$query);

    $query = 'select id,descripcion from cuatrimestres';
    $cuatrimestres = selectEspecial($conexion,$query);

    $quer = 'select MAX(id)+1 as max from grupos';
    $maximo = selectEspecial($conexion,$quer);
    
    foreach ($maximo as $m) {
      # code...
      $maxi = $m["max"];
      }

    if(isset($_POST['submit'])){

        $clave = strtoupper($_POST['clave']);
        $carrera = $_POST['carrera'];
        $plan = $_POST['plan'];
        $cuatrimestre = $_POST['cuatrimestre'];


        if(empty($clave)){
          $errores = 'Dame tu clave <br/>';
        }

        if(empty($carrera)){
          $errores .= 'Dame tu carrera <br/>';
        }

        if(empty($plan)){
          $errores .= 'Dame tu plan <br/>';
        }

        if(empty($cuatrimestre)){
          $errores .= 'Dame tu cuatrimestre <br/>';
        }

        if(empty($errores)){
          $query = "insert into {$table}(`id`, `clave`, `id_carrera`, `id_plan`, `id_cuatrimestre`)  values ('{$maxi}','{$clave}','{$carrera}','{$plan}','{$cuatrimestre}');";
          $agregar = crear_registro($conexion,$query);
          echo $query;
          if($agregar){
            redirect('grupo.php');
          }
        }
        echo $errores;
    }
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<title>Agregar grupo</title>
<?php require '../menus/head.php' ?>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Grupos
        <small>Nuevo grupo.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
<div class="row" >
        <div class="col-xs-6">
          <div class="box box-primary" >
            <div class="box-header">
              <h3 class="box-title">Agregar Grupo</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Clave</label>
                    <input type="text" class="form-control" name="clave" placeholder="Ingrese el ID ej. ITI 8-1" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Carrera</label>
                     <select class="form-control" name="carrera" id="select2_carrera">
                      <?php 
                        foreach ($carreras as $v) { ?>
                          <option value="<?php echo (int)$v["id"] ?>">
                          <?php echo utf8_encode($v["nombre"]) ?></option>   
                      <?php  }
                      ?>
                                            
                    </select>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Plan de estudio</label>
                    <select class="form-control" name="plan" id="select2_plan">
                     <!-- <?php 
                        foreach ($planes as $v) { ?>
                          <option value="<?php echo (int)$v["id"] ?>">
                          <?php echo $v["clave"] ?></option>   
                      <?php  }
                      ?>
                            -->                
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Cuatrimestre</label>
                    <select class="form-control" name="cuatrimestre" id="select2_cuatri">
                      <?php 
                        foreach ($cuatrimestres as $v) { ?>
                          <option value="<?php echo (int)$v["id"] ?>">
                          <?php echo $v["descripcion"] ?></option>   
                      <?php  }
                      ?>
                                            
                    </select>
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Agregar</button>
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

<script type="text/javascript" src="script.js"></script> 

 

</body>
</html>