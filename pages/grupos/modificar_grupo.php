<?php
  require '../basedatos/conexion.php';
  $dato = $_GET['id'];
  $res= obtener_resultado_por_id($conexion,$dato,'grupos');


    $query = 'select id,nombre from carreras';
    $carreras = selectEspecial($conexion,$query);

    $query = 'select id,clave from planes_estudio';
    $planes = selectEspecial($conexion,$query);

    $query = 'select id,descripcion from cuatrimestres';
    $cuatrimestres = selectEspecial($conexion,$query);

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
        $query = "update grupos SET clave ='{$clave}' id_plan='{$plan}',id_carrera='{$carrera}',id_cuatrimestre='{$cuatrimestre}' WHERE id={$dato}";
        $actualizar = crear_registro($conexion,$query); 
        if($actualizar){
          redirect('grupo.php');
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
<title>Modificar grupo</title>
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
        <small>Editar grupo.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar Grupo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$dato}" ?>" role="form">
              <?php foreach ($res as $cuatri) {  ?>

              <div class="box-body">
                <div class="form-group">

                  <label for="">Clave</label>
                  <input type="text" class="form-control" name="clave" placeholder="Ingrese la clave" value=" <?php echo $cuatri["clave"]?> " required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Carrera</label>
                   <select class="form-control" name="carrera" id="select2_carrera">
                    <?php 
                      foreach ($carreras as $v) { 
                      if($cuatri['id_carrera'] == $v['id']){ 
                        ?>
                        <option value="<?php echo (int)$v["id"] ?>" selected>
                        <?php echo utf8_encode($v["nombre"]) ?></option>  
                        <?php 
                      }else{ ?> 
                        <option value="<?php echo (int)$v["id"] ?>" >
                        <?php echo utf8_encode($v["nombre"]) ?></option>
                        <?php 
                         } 
                     ?>
                    <?php 
                       }
                    ?>
                                            
                    </select>
                  </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">Plan de estudio</label>
                    <select class="form-control" name="plan" id="select2_plan">
                      <?php 
                      foreach ($planes as $v) { 
                      if($cuatri['id_plan'] == $v['id']){ 
                        ?>
                        <option value="<?php echo (int)$v["id"] ?>" selected>
                        <?php echo ($v["clave"]) ?></option>  
                        <?php 
                      }else{ ?> 
                        <option value="<?php echo (int)$v["id"] ?>" >
                        <?php echo ($v["clave"]) ?></option>
                        <?php 
                         } 
                     ?>
                    <?php 
                       }
                    ?>
                         
                                            
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Cuatrimestre</label>
                    <select class="form-control" name="cuatrimestre" id="select2_cuatri">
                      <?php 
                      foreach ($cuatrimestres as $v) { 
                      if($cuatri['id_cuatrimestre'] == $v['id']){ 
                        ?>
                        <option value="<?php echo (int)$v["id"] ?>" selected>
                        <?php echo utf8_encode($v["descripcion"]) ?></option>  
                        <?php 
                      }else{ ?> 
                        <option value="<?php echo (int)$v["id"] ?>" >
                        <?php echo utf8_encode($v["descripcion"]) ?></option>
                        <?php 
                         } 
                     ?>
                    <?php 
                       }
                    ?>                   
                    </select>
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

<?php require 'select2.php' ?>

<script type="text/javascript">
  $(document).ready(function(){
    $('#select2_plan').select2();
    $('#select2_cuatri').select2();
    $('#select2_carrera').select2();

  });
</script>