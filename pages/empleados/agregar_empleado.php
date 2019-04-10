<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=1){
    header('Location: ../../index.php');
		exit;
  }

    $errores = '';

    if(isset($_POST['submit'])){

      $username = $_POST['username'];
      $password = $_POST['password'];
      $name = $_POST['name'];
      $lastname = $_POST['lastname'];
      $sexo = $_POST['sexo'];
      $nacimiento = $_POST['nacimiento'];
      $direccion = $_POST['direccion'];
      $cp = $_POST['cp'];
      $municipio = $_POST['municipio'];
      $estado = $_POST['estado'];
      $pais = $_POST['pais'];
      $tipo = $_POST['tipo'];
      $tel = $_POST['tel'];
      $cel = $_POST['cel'];
      $email = $_POST['email'];
      $query = "SELECT nombre_usuario FROM usuarios WHERE nombre_usuario = '{$username}'";
      $ruser = selectEspecial($conexion,$query);
      if($ruser){
         $errores .= 'El nombre de usuario ya está siendo usado por alguien mas.<br/>';
       }
    
      if(!is_numeric($cp))
          $errores .= 'El codigo postal es invalido.<br/>';
      
     

        if(empty($errores)){
          
        if(empty($tel)) $tel = 'null'; else $tel = "'".$tel."'";
        if(empty($cel)) $cel = 'null'; else $cel = "'".$cel."'";
        if(empty($email)) $email = 'null'; else $email = "'".$email."'";
        
          
          
          $query = "INSERT INTO usuarios (`nombre_usuario`, `contrasena`, `id_tipo`, `nombre`, `apellido`, `sexo`, `fecha_nacimiento`, `direccion`, `cp`, `municipio`, `estado`, `id_pais`, `tel`, `cel`, `e-mail`) VALUES ('{$username}','{$password}','{$tipo}','{$name}','{$lastname}','{$sexo}','{$nacimiento}','{$direccion}','{$cp}','{$municipio}','{$estado}',{$pais},{$tel},{$cel},{$email});";
          $agregar = crear_registro($conexion,$query);
          
          $query = "SELECT MAX(id_usuario) as id_usuario FROM usuarios";
          $rmayor = selectEspecial($conexion,$query);
          $usuario_id = '';
          if($rmayor){
            foreach ($rmayor as $dato) {
              $usuario_id = $dato["id_usuario"];
            }
          }
 
          
          if($agregar  ){
            redirect('empleados.php');
          } else {
            $errores .= "Errorororr.<br/>";
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

<title>Agregar empleado</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Empleados
        <small>Nuevo empleado.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
<div class="row" >
        <div class="col-xs-12">
          <div class="box" >
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                
                <h5 style="color: red;">
                  <?php echo $errores; ?>
                </h5>

                <div class="box-body">
                  <div class="col-md-6">
                  
                  <div class="box-header">
                     <h3 class="box-title">Datos de la cuenta</h3>
                  </div>
                  
                    
                  <div class="form-group">
                    <label for="username">* Nombre de usuario</label>
                    <input type="text" class="form-control" name="username" placeholder="Ingrese un nombre de usuario" maxlength="30" 
                           value="<?php if(!empty($errores)){ echo $username;} ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="password">* Contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder="Ingrese una contraseña de usuario" maxlength="20"
                           value="<?php if(!empty($errores)){ echo $password;} ?>" required>
                  </div>
                  
                  <div class="box-header">
                     <h3 class="box-title">Datos del empleado</h3>
                  </div>

                            <div class="form-group">
                      <label for="Tipo">* Tipo</label>
                       <select name="tipo" class="form-control" required>
                         <option disabled selected value> -- Seleccione un tipo -- </option>
                         <?php
                        $r= selectEspecial($conexion,'SELECT * FROM tipo_usuario WHERE id_tipo>3' );
                      //    $r = select($conexion,'tipo_usuario');
                          foreach ($r as $pa) {
                            echo '<option value="'.$pa['id_tipo'].'" ';
                            if(!empty($errores) && $pais == $pa['id_tipo']) echo 'selected';
                            echo '>'.utf8_encode($pa['nombre']).'</option>';
                          }  
                         ?> 
                        </select> 
                    </div>
                    
                    
                  <div class="form-group">
                    <label for="name">* Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre del paciente" maxlength="60"
                           value="<?php if(!empty($errores)){ echo $name;} ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="lastname">* Apellido</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Ingrese el apellido del paciente" maxlength="60"
                           value="<?php if(!empty($errores)){ echo $lastname;} ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="sexo">* Sexo</label><br>
                    <input type="radio" name="sexo" value="H" <?php if(!empty($errores) && $sexo == "H"){ echo 'checked';} ?> required> Hombre &nbsp;&nbsp; 
                    <input type="radio" name="sexo" value="M" <?php if(!empty($errores) && $sexo == "M"){ echo 'checked';} ?>> Mujer &nbsp;&nbsp; 
                    <input type="radio" name="sexo" value="O" <?php if(!empty($errores) && $sexo == "O"){ echo 'checked';} ?>> Otro 
                  </div>
                    
                    <div class="form-group">
                      <label for="necimiento">* Fecha de nacimiento</label>
                      <input type="date" class="form-control" name="nacimiento" placeholder="Ingrese la fecha de nacimiento del paciente"
                             value="<?php if(!empty($errores)){ echo $nacimiento;} ?>" required>
                    </div>
                    
                    </div>
                  
                  <div class="col-md-6">
                    
                    <div class="form-group">
                      <label for="direccion">* Dirección</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Ingrese la dirección del paciente" maxlength="250"
                             value="<?php if(!empty($errores)){ echo $direccion;} ?>"required>
                    </div>
                    
                    <div class="form-group">
                      <label for="cp">* Codigo Postal</label>
                      <input type="text" class="form-control" name="cp" placeholder="Ingrese el codigo postal del paciente" maxlength="10"
                             value="<?php if(!empty($errores)){ echo $cp;} ?>"required>
                    </div>
                    
                  
                    
                    <div class="form-group">
                      <label for="municipio">* Ciudad</label>
                      <input type="text" class="form-control" name="municipio" placeholder="Ingrese la ciudad del paciente" maxlength="60"
                             value="<?php if(!empty($errores)){ echo $municipio;} ?>"required>
                    </div>
                    
                    <div class="form-group">
                      <label for="estado">* Estado</label>
                      <input type="text" class="form-control" name="estado" placeholder="Ingrese el estado del paciente" maxlength="60"
                             value="<?php if(!empty($errores)){ echo $estado;} ?>" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="pais">* País</label>
                       <select name="pais" class="form-control" required>
                         <option disabled selected value> -- Seleccione un país -- </option>
                         <?php
                          $r = select($conexion,'paises');
                          foreach ($r as $pa) {
                            echo '<option value="'.$pa['id'].'" ';
                            if(!empty($errores) && $pais == $pa['id']) echo 'selected';
                            echo '>'.utf8_encode($pa['nombre']).'</option>';
                          }  
                         ?> 
                        </select> 
                    </div>
                    
                    <div class="form-group">
                      <label for="tel">Teléfono</label>
                      <input type="tel" class="form-control" name="tel" placeholder="Ingrese el número de telefono del paciente" maxlength="15"
                             value="<?php if(!empty($errores)){ echo $tel;} ?>" >
                    </div>
                    
                    <div class="form-group">
                      <label for="cel">Célular</label>
                      <input type="tel" class="form-control" name="cel" placeholder="Ingrese el número de celular del paciente" maxlength="15"
                             value="<?php if(!empty($errores)){ echo $cel;} ?>" >
                    </div>
                    
                    <div class="form-group">
                      <label for="email">Correo electrónico</label>
                      <input type="email" class="form-control" name="email" placeholder="Ingrese el correo electronico del paciente" maxlength="80"
                             value="<?php if(!empty($errores)){ echo $email;} ?>">
                    </div>
                    
            
                    
                
                    
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" style="float: right;" name="submit">Agegar empleado</button>
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
