<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=1){
    header('Location: ../../index.php');
		exit;
  }


  $id = $_GET['id'];
  $query = "SELECT * FROM usuarios INNER JOIN pacientes ON usuarios.id_usuario = pacientes.usuario_id WHERE usuario_id = {$id}";
  $rusuario = selectEspecial($conexion,$query);
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
      $tel = $_POST['tel'];
      $cel = $_POST['cel'];
      $email = $_POST['email'];
      $nss = $_POST['nss'];
      $tipo_sangre = $_POST['tipo_sangre'];
      $alergias = $_POST['alergias'];
      
      if(!is_numeric($cp))
          $errores .= 'El codigo postal es invalido.<br/>';
      
      if(!is_numeric($nss))
          $errores .= 'El número de seguro social es invalido.<br/>';

      

        if(empty($errores)){
          
        if(empty($tel)) $tel = 'null'; else $tel = "'".$tel."'";
        if(empty($cel)) $cel = 'null'; else $cel = "'".$cel."'";
        if(empty($email)) $email = 'null'; else $email = "'".$email."'";
        if(empty($alergias)) $alergias = 'null'; else $alergias = "'".$alergias."'";
         
          $query = "UPDATE usuarios SET nombre_usuario='{$username}',contrasena='{$password}',nombre='{$name}',apellido='{$lastname}',sexo='{$sexo}',fecha_nacimiento='{$nacimiento}',direccion='{$direccion}',cp='{$cp}',municipio='{$municipio}',estado='{$estado}',id_pais={$pais},tel={$tel},cel={$cel},`e-mail`={$email} WHERE id_usuario={$id};";
          $modif = crear_registro($conexion,$query);
          
          $query = "UPDATE pacientes SET nss='{$nss}',tipo_sangre='{$tipo_sangre}',alergias={$alergias} WHERE usuario_id={$id};";
          $modif2 = crear_registro($conexion,$query);
         
          if($modif && $modif2){
            redirect('pacientes.php');
          } else {
            if(!$modif)
              $errores .= "Errorororr.<br/>";
            if(!$modif2)
              $errores .= "Errorororr2.<br/>";
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

<title>Modificar paciente</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Pacientes
        <small>Editar paciente.</small>
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
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$id}" ?>" role="form">
                
                <h5 style="color: red;">
                  <?php echo $errores; ?>
                </h5>
                

                <div class="box-body">
                  
                  <?php foreach ($rusuario as $ruser) {   ?>
                  
                  <div class="col-md-6">
                  
                  <div class="box-header">
                     <h3 class="box-title">Datos de la cuenta</h3>
                  </div>
                    
                  <div class="form-group">
                    <label for="username">* Nombre de usuario</label>
                    <input type="text" class="form-control" name="username" placeholder="Ingrese un nombre de usuario" maxlength="30" 
                           value="<?php if(!empty($errores)){ echo $username;} else {echo $ruser['nombre_usuario'];} ?>"  required>
                  </div>
                  
                  <div class="form-group">
                    <label for="password">* Contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder="Ingrese una contraseña de usuario" maxlength="20"
                           value="<?php if(!empty($errores)){ echo $password;} else {echo $ruser['contrasena'];} ?>" required>
                  </div>
                  
                  <div class="box-header">
                     <h3 class="box-title">Datos del paciente</h3>
                  </div>
                    
                  <div class="form-group">
                    <label for="name">* Nombre</label>
                    <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre del paciente" maxlength="60"
                           value="<?php if(!empty($errores)){ echo $name;} else {echo $ruser['nombre'];} ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="lastname">* Apellido</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Ingrese el apellido del paciente" maxlength="60"
                           value="<?php if(!empty($errores)){ echo $lastname;} else {echo $ruser['apellido'];} ?>" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="sexo">* Sexo</label><br>
                    <input type="radio" name="sexo" value="H" <?php if(!empty($errores) && $sexo == "H") echo 'checked';
                           else if($ruser['sexo']=="H") echo 'checked'; ?> required> Hombre &nbsp;&nbsp; 
                    <input type="radio" name="sexo" value="M" <?php if(!empty($errores) && $sexo == "M") echo 'checked';
                           else if($ruser['sexo']=="M") echo 'checked'; ?>> Mujer &nbsp;&nbsp; 
                    <input type="radio" name="sexo" value="O" <?php if(!empty($errores) && $sexo == "O") echo 'checked'; 
                           else if($ruser['sexo']=="O") echo 'checked';?>> Otro 
                  </div>
                    
                    <div class="form-group">
                      <label for="necimiento">* Fecha de nacimiento</label>
                      <input type="date" class="form-control" name="nacimiento" placeholder="Ingrese la fecha de nacimiento del paciente"
                             value="<?php if(!empty($errores)){ echo $nacimiento;} else {echo $ruser['fecha_nacimiento'];} ?>" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="direccion">* Dirección</label>
                      <input type="text" class="form-control" name="direccion" placeholder="Ingrese la dirección del paciente" maxlength="250"
                             value="<?php if(!empty($errores)){ echo $direccion;} else {echo $ruser['direccion'];} ?>"required>
                    </div>
                    
                    <div class="form-group">
                      <label for="cp">* Codigo Postal</label>
                      <input type="text" class="form-control" name="cp" placeholder="Ingrese el codigo postal del paciente" maxlength="10"
                             value="<?php if(!empty($errores)){ echo $cp;} else {echo $ruser['cp'];} ?>"required>
                    </div>
                    
                  </div>
                  
                  <div class="col-md-6">
                    
                    <div class="form-group">
                      <label for="municipio">* Ciudad</label>
                      <input type="text" class="form-control" name="municipio" placeholder="Ingrese la ciudad del paciente" maxlength="60"
                             value="<?php if(!empty($errores)){ echo $municipio;} else {echo $ruser['municipio'];} ?>"required>
                    </div>
                    
                    <div class="form-group">
                      <label for="estado">* Estado</label>
                      <input type="text" class="form-control" name="estado" placeholder="Ingrese el estado del paciente" maxlength="60"
                             value="<?php if(!empty($errores)){ echo $estado;} else {echo $ruser['estado'];} ?>" required>
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
                            else if($ruser['id_pais']==$pa['id']) echo 'selected';
                            echo '>'.utf8_encode($pa['nombre']).'</option>';
                          }  
                         ?> 
                        </select> 
                    </div>
                    
                    <div class="form-group">
                      <label for="tel">Teléfono</label>
                      <input type="tel" class="form-control" name="tel" placeholder="Ingrese el número de telefono del paciente" maxlength="15"
                             value="<?php if(!empty($errores)){ echo $tel;} else {echo $ruser['tel'];} ?>" >
                    </div>
                    
                    <div class="form-group">
                      <label for="cel">Célular</label>
                      <input type="tel" class="form-control" name="cel" placeholder="Ingrese el número de celular del paciente" maxlength="15"
                             value="<?php if(!empty($errores)){ echo $cel;} else {echo $ruser['cel'];} ?>" >
                    </div>
                    
                    <div class="form-group">
                      <label for="email">Correo electrónico</label>
                      <input type="email" class="form-control" name="email" placeholder="Ingrese el correo electronico del paciente" maxlength="80"
                             value="<?php if(!empty($errores)){ echo $email;} else {echo $ruser['e-mail'];} ?>">
                    </div>
                    
                    <div class="box-header">
                     <h3 class="box-title">Datos médicos</h3>
                    </div>
                    
                    <div class="form-group">
                      <label for="nss">* NSS</label>
                      <input type="text" class="form-control" name="nss" placeholder="Ingrese el número de seguro social del paciente" maxlength="11"
                             value="<?php if(!empty($errores)){ echo $nss;} else {echo $ruser['nss'];} ?>" required>
                    </div>
                    
                    <div class="form-group">
                      <label for="tipo_sangre">* Tipo de sangre</label>
                       <select name="tipo_sangre" class="form-control" required>
                         <option disabled selected value> -- Seleccione un tipo de sangre -- </option>
                          <option value="A+" <?php if(!empty($errores) && $tipo_sangre == "A+") echo 'selected';
                                  else if($ruser['tipo_sangre']=="A+") echo 'selected'; ?> >A+</option>
                         <option value="A-" <?php if(!empty($errores) && $tipo_sangre == "A-") echo 'selected';
                                 else if($ruser['tipo_sangre']=="A-") echo 'selected';?> >A-</option>
                         <option value="B+" <?php if(!empty($errores) && $tipo_sangre == "B+") echo 'selected'; 
                                 else if($ruser['tipo_sangre']=="B+") echo 'selected';?> >B+</option>
                         <option value="B-" <?php if(!empty($errores) && $tipo_sangre == "B-") echo 'selected';
                                 else if($ruser['tipo_sangre']=="B-") echo 'selected';?> >B-</option>
                         <option value="AB+" <?php if(!empty($errores) && $tipo_sangre == "AB+") echo 'selected';
                                 else if($ruser['tipo_sangre']=="AB+") echo 'selected';?> >AB+</option>
                         <option value="AB-" <?php if(!empty($errores) && $tipo_sangre == "AB-") echo 'selected';
                                 else if($ruser['tipo_sangre']=="AB-") echo 'selected';?> >AB-</option>
                         <option value="O+" <?php if(!empty($errores) && $tipo_sangre == "O+") echo 'selected';
                                 else if($ruser['tipo_sangre']=="O+") echo 'selected';?> >O+</option>
                         <option value="O-" <?php if(!empty($errores) && $tipo_sangre == "O-") echo 'selected';
                                 else if($ruser['tipo_sangre']=="O-") echo 'selected';?> >O-</option>
                        </select> 
                    </div>
                    
                    <div class="form-group">
                      <label for="alergias">Alergias</label>
                      <input type="text" class="form-control" name="alergias" placeholder="Ingrese las alergias del paciente" maxlength="450"
                             value="<?php if(!empty($errores)){ echo $alergias;} else {echo $ruser['alergias'];} ?>">
                    </div>
                  </div>
                  
                  
                  <?php } ?>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" style="float: right;" name="submit">Modificar paciente</button>
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
