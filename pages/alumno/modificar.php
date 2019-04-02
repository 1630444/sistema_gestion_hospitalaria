<?php 
  require '../basedatos/conexion.php';

  $dato = $_GET['id'];


  $res= obtener_resultado_por_id($conexion,$dato,'alumnos');
  $carreras_al = select($conexion, 'carreras');

  $id_persona = "";
  foreach ($res as $pers) {
	$id_persona = $pers['id_persona'];
  }
  
  foreach ($res as $carreras) {
	$id_carrera = $carreras['id_carrera']; 
  }
  
  $carrera = obtener_resultado_por_id($conexion, $id_carrera, 'carreras');
  $persona = obtener_resultado_por_id($conexion, $id_persona, 'personas');

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
		  $query = "update personas SET nombre = '{$nombre}', paterno = '{$paterno}', materno = '{$materno}', correo = '{$correo}', telefono_movil = '{$tel_movil}', telefono_casa = '{$tel_casa}', fecha_nac = '{$fecha_nac}' where id = {$id_persona};";
		  echo $query;
		  $val = 1;
		  $agregar = crear_registro($conexion,$query);
		}

		if($val != 0){
			$matricula = $_POST['matricula'];
			if(empty($matricula)){
			  $errores = 'Ingrese la matricula del alumno <br/>';
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
		  

		  if(empty($errores)){
			$query = "update alumnos SET id_carrera={$id_carrera}, escuela_procedencia='{$escuela_proc}', promedio_ingreso='{$promedio}', puntos_ceneval='{$puntos_cen}' WHERE id={$dato}";

			echo $query;

			$actualizar = crear_registro($conexion,$query);
				if($actualizar){
				  redirect('mostrar.php');
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

<title>Modificar alumno</title>

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
        <small>Editar alumno.</small>
      </h1>
    </section>

	<!-- Main content -->
	<section class="content container-fluid">

	  <!-- SELECT2 EXAMPLE -->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Modificar alumno</h3>
		</div>
	<!-- /.box-header -->
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$dato}" ?>" role="form">
			<div class="box-body">
				
				
				<div class="row">
				
				<div class="col-md-6">
					<?php foreach ($persona as $d_persona) { ?>
						
					
					<h4 class="box-title">Datos personales:</h4>

					<div class="form-group">
						<label for="">Nombre</label>
						<input type="text" name="nombre" class="form-control" value="<?php echo $d_persona['nombre']; ?>" readonly>
					</div>

					<div class="form-group">
				 		<label for="">Apellido paterno</label>
				    	<input type="text" name="paterno" class="form-control" value="<?php echo $d_persona['paterno']; ?>" readonly>
					</div>

					<div class="form-group">
						<label for="">Apellido materno</label>
						<input type="text" name="materno" class="form-control" value="<?php echo $d_persona['materno']; ?>" readonly>
					</div>

					<div class="form-group">
				  		<label for="">CURP</label>
						<input type="text" name="curp" class="form-control" value="<?php echo $d_persona['curp']; ?>" minlenght=18 maxlength=18 readonly>
					</div>

					<div class="form-group">
				  		<label for="">NSS</label>
						<input type="text" name="nss" class="form-control" value="<?php echo $d_persona['nss']; ?>" maxlength=11 minlenght=11 readonly>
					</div>

					<div class="form-group">
				  		<label for="">Correo</label>
						<input type="email" name="correo" class="form-control" value="<?php echo $d_persona['correo']; ?>">
					</div>

					<div class="form-group">
				  		<label for="">Teléfono móvil</label>
						<input type="text" name="tel_movil" class="form-control" value="<?php echo $d_persona['telefono_movil']; ?>" minlenght=10 maxlength=10>
					</div>

					<div class="form-group">
				  		<label for="">Teléfono casa</label>
						<input type="text" name="tel_casa" class="form-control" value="<?php echo $d_persona['telefono_casa']; ?>" minlenght=7 maxlength=7>
					</div>

					<div class="form-group">
				  		<label for="">Fecha de nacimiento</label>
						<input type="date" name="fecha_nac" class="form-control" value="<?php echo $d_persona['fecha_nac']; ?>">
					</div>
					<?php } ?>
				
				</div>
		  		
		  	  	<div class="col-md-6">
		  	  		<?php foreach ($res as $d_alumno) { ?>

					<div class="form-group">
						<div class="form-group">
							<h4 class="box-title">Datos de Alumno:</h4>

							<label for="">Matricula</label>
							<input type="text" class="form-control" name="matricula" value="<?php echo $d_alumno['matricula']; ?>" readonly>
							</div>

							<div class="form-group">
							<label for="">Carrera</label>
							<select name="carrera" class="form-control" required="">
								<?php	
									while ($carrera = mysqli_fetch_array($carreras_al)) {
							  			echo '<option value="'.$carrera['id'].'">'.$carrera['nombre'].'</option>';
									}
								?>
						    </select>
							</div>

							<div class="form-group"> 
								<label for="">Escuela procedencia</label>
								<input type="text" class="form-control" name="escuela_proc" value="<?php echo $d_alumno['escuela_procedencia']; ?>">
							</div>

							<div class="form-group"> 
								<label for="">Promedio de ingreso</label>
								<input type="number" step="any" class="form-control" name="promedio" value="<?php echo $d_alumno['promedio_ingreso']; ?>">
							</div>

							<div class="form-group"> 
								<label for="">Puntos ceneval</label>
								<input type="number" class="form-control" name="puntos_cen" value="<?php echo $d_alumno['puntos_ceneval']; ?>">
							</div>

					</div>
				
				</div>
		 		
		 		</div>
		 		<?php } ?>

			</div>
			<!-- /.box-body -->
			<div class="box-footer">
			  <button type="submit" class="btn btn-primary" name="submit">Modificar</button>
			</div>
		</form>
	</div>








	</section>

	<!-- /.content -->
  <?php require  '../menus/footer.php' ?>
</body>
</html>
