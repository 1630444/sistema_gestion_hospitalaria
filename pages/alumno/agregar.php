<?php
  require '../basedatos/conexion.php';

	$table = 'alumnos';
	$t_persona = 'personas';
	$errores = '';

	$res = select($conexion,'carreras');
	$id_persona = "";
	$val = 0;

	if(isset($_POST['submit'])){
		$val = 0;
		$nombre = $_POST['nombre'];
		if(empty($nombre)){
		  $erroresP = 'Ingrese el nombre de la persona';
		}  

		$paterno = $_POST['paterno'];
		if(empty($paterno)){
		  $erroresP = 'Ingrese el paterno de la persona';
		}

		$materno = $_POST['materno'];
		if(empty($materno)){
		  $erroresP = 'Ingrese el materno de la persona';
		}

		$curp = $_POST['curp'];
		if(empty($curp)){
		  $erroresP = 'Ingrese el curp de la persona';
		}

		$nss = $_POST['nss'];
		if(empty($nss)){
		  $erroresP = 'Ingrese el nss de la persona';
		}

		$correo = $_POST['correo'];
		if(empty($correo)){
		  $erroresP = 'Ingrese el correo de la persona';
		}

		$tel_movil = $_POST['tel_movil'];
		if(empty($tel_movil)){
		  $erroresP = 'Ingrese el teléfono móvil de la persona';
		}

		$tel_casa = $_POST['tel_casa'];
		if(empty($tel_casa)){
		  $erroresP = 'Ingrese el teléfono de casa de la persona';
		}

		$fecha_nac = $_POST['fecha_nac'];
		if(empty($fecha_nac)){
		  $erroresP = 'Ingrese la fecha de nacimiento de la persona';
		}


		if(empty($erroresP)){
		  $query = "insert into {$t_persona} (curp, nombre, paterno, materno, nss, correo, telefono_movil, telefono_casa, fecha_nac) values ('{$curp}','{$nombre}','{$paterno}','{$materno}','{$nss}','{$correo}','{$tel_movil}', '{$tel_casa}', '{$fecha_nac}'  );";
		  echo $query;
		  $val = 1;
		  $agregar = crear_registro($conexion,$query);
		}
		
		if($val != 0){


		$matricula = $_POST['matricula'];
		if(empty($matricula)){
			$errores = 'Ingrese la matricula del alumno <br/>';
		}
		$carrera = $_POST['carrera'];
		if(empty($carrera)){
			$errores = 'Seleccione una carrera <br/>';
		}
		
		$escuela_proc = $_POST['escuela_proc'];
		if(empty($escuela_proc)){
			$errores = 'Ingrese la escuela de procedencia <br/>';
		}
		
		$promedio = $_POST['promedio'];
		if(empty($promedio)){
			$errores = 'Ingrese el promedio de ingreso <br/>';
		}
		
		$puntos_cen = $_POST['puntos_cen'];
		if(empty($puntos_cen)){
			$errores = 'Ingrese los puntos del exámen Ceneval <br/>';
		}
		echo $puntos_cen;

			$res = select($conexion,'personas');
			foreach ($res as $persona) {
				$id_persona = $persona['id'];
				echo $id_persona;
			}


		if(empty($errores)){
			$query = "insert into {$table} (matricula, id_carrera, escuela_procedencia, promedio_ingreso, puntos_ceneval, id_persona) values ('{$matricula}',{$carrera},'{$escuela_proc}','{$promedio}','{$puntos_cen}',{$id_persona});";
			echo $query;
			$agregar = crear_registro($conexion,$query);

			if($agregar){
				redirect('mostrar.php');
			}else{
				//echo "error";
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

<title>Agregar alumno</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

	<!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Alumnos
        <small>Nuevo alumno.</small>
      </h1>
    </section>

	<!-- Main content -->
	<section class="content container-fluid">

			<!-- SELECT2 EXAMPLE -->
	  <div class="box box-default">
		<div class="box-header with-border">
		  <h3 class="box-title">Agregar alumno</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
		 <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
		  <div class="row">
			<div class="col-md-6">
			  <h4 class="box-title">Datos personales:</h4>

				<div class="form-group">
					<label for="">Nombre</label>
					<input type="text" name="nombre" class="form-control" placeholder="Carlos Alberto">
				</div>

				<div class="form-group">
					<label for="">Apellido paterno</label>
					<input type="text" name="paterno" class="form-control" placeholder="Perez">
				</div>

				<div class="form-group">
					<label for="">Apellido materno</label>
					<input type="text" name="materno" class="form-control" placeholder="Ramos">
				</div>

				<div class="form-group">
					<label for="">CURP</label>
					<input type="text" name="curp" class="form-control" placeholder="ROTL971119MTSDRN01" maxlength=18 minlength=8>
				</div>

				<div class="form-group">
					<label for="">NSS</label>
					<input type="text" name="nss" class="form-control" placeholder="72795608040" maxlength=11 minlength=11>
				</div>

				<div class="form-group">
					<label for="">Correo</label>
					<input type="email" name="correo" class="form-control" placeholder="1630984@upv.edu.mx">
				</div>

				<div class="form-group">
					<label for="">Teléfono móvil</label>
					<input type="text" name="tel_movil" class="form-control" placeholder="8341528614" maxlength=10 minlength=10>
				</div>

				<div class="form-group">
					<label for="">Teléfono casa</label>
					<input type="text" name="tel_casa" class="form-control" placeholder="3139888" maxlength=7 minlength=7>
				</div>

				<div class="form-group">
					<label for="">Fecha de nacimiento</label>
					<input type="date" name="fecha_nac" class="form-control">
				</div>
			  <!-- /.form-group -->
			</div>
			<!-- /.col -->
			<div class="col-md-6">
			  <div class="form-group">
				<div class="form-group">
				<h4 class="box-title">Datos de Alumno:</h4>

					<label for="">Matricula</label>
					<input type="text" class="form-control" name="matricula" placeholder="Ingrese la matricula del alumno" required minlength=7 maxlength=7>
				</div>

				<div class="form-group">
					<label for="">Carrera</label>
					<select name="carrera" class="form-control" required="">
						<?php  
						while ($val = mysqli_fetch_array($res)) {
							echo '<option value="'.$val['id'].'">'.$val['nombre'].'</option>';
						}
						?>
					</select>
				</div>

				<div class="form-group"> 
					<label for="">Escuela procedencia</label>
					<input type="text" class="form-control" name="escuela_proc" placeholder="Escuela de procedencia">
				</div>

				<div class="form-group"> 
					<label for="">Promedio de ingreso</label>
					<input type="number" step="any" class="form-control" name="promedio" placeholder="Promedio de ingreso">
				</div>

				<div class="form-group"> 
					<label for="">Puntos ceneval</label>
					<input type="number" class="form-control" name="puntos_cen" placeholder="Puntos ceneval">
				</div>
			  </div>
			  <!-- /.form-group -->
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</div>
		<!-- /.box-body -->
		<div class="box-footer">
		  <button type="submit" class="btn btn-primary" name="submit">Agregar</button>
		</div>
	  </form>
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
