

<?php
  require '../basedatos/conexion.php';

  $carrera= select($conexion,'carreras');
  $table = 'personas';
  $errores = '';

  if(isset($_POST['submit'])){

      $id = '0';
      $curp = $_POST['curp'];
      $nombre = $_POST['nombre'];
      $paterno = $_POST['paterno'];
      $materno = $_POST['materno'];
      $nss = $_POST['nss'];
      $correo = $_POST['correo'];
      $movil = $_POST['movil'];
      $casa = $_POST['casa'];
      $fecha = $_POST['fecha'];
      $numero = $_POST['numero'];
      $grado = $_POST['grado'];
      $tipo = $_POST['tipo'];
      $carrera = $_POST['carrera'];



      if(empty($errores)){
        $query = "insert into {$table} values ({$id},'{$curp}','{$nombre}','{$paterno}','{$materno}','{$nss}','{$correo}','{$movil}','{$casa}','{$fecha}');";
        $agregar = crear_registro($conexion,$query);
        echo $query;
        if($agregar){
          $query = "select MAX(id) as max_id from personas";
          $res2 = selectEspecial($conexion,$query);
          $row = mysqli_fetch_array($res2);
          $maximo = $row["max_id"];
          $table='maestros';
          $query = "insert into {$table} values ({$id},'{$numero}','{$grado}','{$tipo}','{$maximo}','{$carrera}');";
          echo $query;
          $agregar = crear_registro($conexion,$query);
          if($agregar){
            redirect('maestros.php');
          }
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
<title>Agregar maestro</title>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
<section class="content-header">
      <h1>
        Maestros
        <small>Nuevo maestro.</small>
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
              <h3 class="box-title">Agregar maestro</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="box-body">
                  <div class="form-group">
                    <label for="">CURP</label>
                    <input type="text" class="form-control" id="curp" placeholder="Ingrese una descripcion" name="curp" required>
                  </div>
                  <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese un nombre" name="nombre" required>
                  </div>
                  <div class="form-group">
                   <label for="">Paterno</label>
                   <input type="text" class="form-control" id="paterno" placeholder="Ingrese un apellido paterno" name="paterno" required>
                  </div>
                  <div class="form-group">
                    <label for="">Materno</label>
                    <input type="text" class="form-control" id="materno" placeholder="Ingrese un apellido materno" name="materno" required>
                  </div>
                  <div class="form-group">
                    <label for="">NSS</label>
                    <input type="text" class="form-control" id="nss" placeholder="Ingrese su nss" name="nss" required>
                  </div>
                  <div class="form-group">
                    <label for="">Correo</label>
                    <input type="email" class="form-control" id="correo" placeholder="Ingrese su correo" name="correo" required>
                  </div>
                  <div class="form-group">
                    <label for="">Telefono movil</label>
                    <input type="text" class="form-control" id="telefono_movil" placeholder="Ingrese su telefono movil" name="movil" required>
                  </div>
                  <div class="form-group">
                    <label for="">Telefono Casa</label>
                    <input type="text" class="form-control" id="telefono_casa" placeholder="Ingrese su telefono de casa" name="casa" required>
                  </div>
                  <div class="form-group">
                    <label for="">Fecha Nacimiento</label>
                    <input type="date" class="form-control" id="nacimiento" placeholder="Ingrese su fecha de nacimiento" name="fecha" required>
                  </div>

                  <div class="form-group">
                    <label for="">Numero empleado</label>
                    <input type="number" class="form-control" id="numero_empleado" placeholder="Ingrese su numero de empleado" name="numero" required>
                  </div>

                  <div class="form-group">
                    <label for="">Grado Academico</label>
                    <select name="grado" class="form-control" >
                      <option value="Prepa">Prepa</option>
                      <option value="Lic">Lic</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="">Tipo contraro</label>
                    <select name="tipo" class="form-control">
                      <option value="PA">PA</option>
                      <option value="PTC">PTC</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="">Carrera</label>
                    <select name="carrera" class="form-control">
                      <?php
                      foreach ($carrera as $carrerita) {
                        // code...
                        echo "<option value=\"{$carrerita["id"]}\">{$carrerita["id"]}</option>";
                      }
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

</body>
</html>
