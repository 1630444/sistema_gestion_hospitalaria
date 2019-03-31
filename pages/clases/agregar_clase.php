<?php
  require '../basedatos/conexion.php';

  $query = 'select id, clave from grupos';
  $grupos = selectEspecial($conexion,$query);

  $query = 'select id, nombre from carreras';
  $carreras = selectEspecial($conexion,$query);

  $query = 'select id, clave from planes_estudio';
  $planes = selectEspecial($conexion,$query);

  $query = 'select id, nombre from materias';
  $materias = selectEspecial($conexion,$query);

    $table = 'clases';
    $errores = '';

    if(isset($_POST['submit'])){

        //$id = $_POST['id'];
        $clave = $_POST['clave'];
        $capacidad = $_POST['capacidad'];
        $id_grupo = $_POST['grupo'];
        $id_carrera = $_POST['carrera'];
        $id_plan = $_POST['planes_estudio'];
        $id_materia = $_POST['materia'];      

        if(empty($clave)){
          $errores .= 'Ingresa una capacidad de grupo. <br/>';
        }

        if(empty($capacidad)){
          $errores .= 'Ingresa una capacidad. <br/>';
        }

        if(empty($id_grupo)){
          $errores .= 'Seleccione un grupo. <br/>';
        }

        if(empty($id_carrera)){
          $errores .= 'Seleccione una carrera. <br/>';
        }

        if(empty($id_plan)){
          $errores .= 'Seleccione un plan de estudio. <br/>';
        }

        if(empty($id_materia)){
          $errores .= 'Seleccione una materia. <br/>';
        } 

        if(empty($errores)){
          echo 'Clave: ' . $clave . '<br>';
          echo 'Capacidad: ' .  $capacidad . '<br>';
          echo 'Grupo: ' . $id_grupo . '<br>';
          echo 'Carrera: ' . $id_carrera . '<br>';
          echo 'Plan: ' . $id_plan . '<br>';
          echo 'Materia: ' . $id_materia . '<br>';
          $query = "insert into {$table}(clave, capacidad, id_grupo, id_carrera, id_plan, id_materia) values ('{$clave}',{$capacidad},{$id_grupo}, {$id_carrera}, {$id_plan}, {$id_materia});";
          echo $query;
          $agregar = crear_registro($conexion,$query);
          if($agregar){
            redirect('clases.php');
          }
        } else {
          echo $errores;
        }
    }
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<title>Agregar clase</title>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Clases
        <small>Nueva clase.</small>
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
              <h3 class="box-title">Agregar clase</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="box-body">
                  <!--<div class="form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="text" class="form-control" name="id" placeholder="Ingrese el ID" required>
                  </div>-->
                  <div class="form-group">
                    <label for="exampleInputPassword1">Clave</label>
                    <input type="text" class="form-control" name="clave" placeholder="Ingrese una clave. Ej. ITI 07834." required>
                  </div>
                   <div class="form-group">
                    <label for="exampleInputPassword1">Capacidad</label>
                    <input type="text" class="form-control" name="capacidad" placeholder="Ingrese una capacidad." required>
                  </div>


                  <div class="form-group">
                    <label for="exampleInputPassword1">Carrera</label>
                    <select class="form-control" name="carrera" id="select2_carrera">
                    <?php 
                      foreach ($carreras as $v) { ?>
                        <option value="<?php echo (int)$v['id'] ?>">
                        <?php echo utf8_encode(($v["nombre"])) ?></option>   
                    <?php  }
                    ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Grupo</label>
                    <select class="form-control" name="grupo" id="select2_grupo">

                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Plan de estudios</label>
                    <select class="form-control" name="planes_estudio" id="select2_plan">
                                  
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Materia</label>
                    <select class="form-control" name="materia" id="select2_materia">
                                            
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

</body>
</html>

<?php require 'select2.php' ?>

<script type="text/javascript" src="script.js"></script>
