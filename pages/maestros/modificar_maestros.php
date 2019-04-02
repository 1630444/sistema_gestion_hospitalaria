<?php
  require '../basedatos/conexion.php';
  $dato = $_GET['id'];
  $query = "select * from personas p, maestros m where p.id = m.id_persona and m.id_persona = {$dato};";
  $res = selectEspecial($conexion,$query);
  $carrera= select($conexion,'carreras');
  define('RAIZ','../../');


    if(isset($_POST['submit'])){


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
        $table = 'personas';



        $actualizar = crear_registro($conexion,$query);
        if(empty($errores)){
          $query = "update {$table} SET curp='{$curp}',nombre='{$nombre}',paterno='{$paterno}',materno='{$materno}',nss='{$nss}',correo='{$correo}',telefono_movil='{$movil}',telefono_casa='{$casa}',fecha_nac='{$fecha}' where id = {$dato};";
          $actualizar = crear_registro($conexion,$query);
          echo $query;
          if($actualizar){
            $table='maestros';
            $query = "update {$table} SET numero_empleado='{$numero}',grado_academico='{$grado}',tipo_contrato='{$tipo}',id_carrera='{$carrera}' where id_persona='{$dato}';";
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
<title>Modificar maestro</title>
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
        <small>Editar maestro.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modificar maestro</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$dato}" ?>" role="form">
              <?php foreach ($res as $maestro) {    ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="">CURP</label>
                  <input type="text" class="form-control" id="curp" placeholder="Ingrese una descripcion" name="curp" required value=" <?php echo $maestro["curp"]?> ">
                </div>
                <div class="form-group">
                  <label for="">Nombre</label>
                  <input type="text" class="form-control" id="nombre" placeholder="Ingrese un nombre" name="nombre" required value=" <?php echo $maestro["nombre"]?> ">
                </div>
                <div class="form-group">
                 <label for="">Paterno</label>
                 <input type="text" class="form-control" id="paterno" placeholder="Ingrese un apellido paterno" name="paterno" required value=" <?php echo $maestro["paterno"]?> ">
                </div>
                <div class="form-group">
                  <label for="">Materno</label>
                  <input type="text" class="form-control" id="materno" placeholder="Ingrese un apellido materno" name="materno" required value=" <?php echo $maestro["materno"]?> ">
                </div>
                <div class="form-group">
                  <label for="">NSS</label>
                  <input type="text" class="form-control" id="nss" placeholder="Ingrese su nss" name="nss" required value=" <?php echo $maestro["nss"]?> ">
                </div>
                <div class="form-group">
                  <label for="">Correo</label>
                  <input type="email" class="form-control" id="correo" placeholder="Ingrese su correo" name="correo" required value=" <?php echo $maestro["correo"]?> ">
                </div>
                <div class="form-group">
                  <label for="">Telefono movil</label>
                  <input type="text" class="form-control" id="telefono_movil" placeholder="Ingrese su telefono movil" name="movil" required value=" <?php echo $maestro["telefono_movil"]?> ">
                </div>
                <div class="form-group">
                  <label for="">Telefono Casa</label>
                  <input type="text" class="form-control" id="telefono_casa" placeholder="Ingrese su telefono de casa" name="casa" required value=" <?php echo $maestro["telefono_casa"]?> ">
                </div>
                <div class="form-group">
                  <label for="">Fecha Nacimiento</label>
                  <input type="date" class="form-control" name="fecha"  value="<?php echo $maestro["fecha_nac"]?>" required>
                </div>
                <div class="form-group">
                  <label for="">Numero empleado</label>
                  <input type="number" class="form-control" id="numero_empleado" placeholder="Ingrese su numero de empleado" name="numero" required value="<?php echo $maestro["numero_empleado"]?>">
                </div>
                <div class="form-group">
                  <label for="">Grado Academico</label>
                  <select name="grado" class="form-control" >
                    <option value=" <?php echo $maestro["grado_academico"]?> "><?php echo $maestro["grado_academico"]?></option>
                    <option value="Prepa">Prepa</option>
                    <option value="Lic">Lic</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Tipo contrato</label>
                  <select name="tipo" class="form-control">
                    <option value=" <?php echo $maestro["tipo_contrato"]?> "><?php echo $maestro["tipo_contrato"]?></option>
                    <option value="PA">PA</option>
                    <option value="PTC">PTC</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Carrera</label>
                  <select name="carrera" class="form-control">
                    <option value=" <?php echo $maestro["id_carrera"]?> "><?php echo $maestro["id_carrera"]?></option>
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
              <?php } ?>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit">Modificar</button>
              </div>
            </form>

          </div>
          <!-- /.box -->
        </div>







    </section>


    </div>
    <!-- /.content -->
  <?php require  '../menus/footer.php' ?>
</body>
</html>
