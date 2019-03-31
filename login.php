<?php
$valido=false;
session_start();
if (isset($_POST['aceptar'])) {
  $usuario=$_POST['usuario'];
  $contrasena=$_POST['contrasena'];

  /*
  Algun dia con la base de datos
  if(!valida_usuario_bd($usuario,$contrasena, $conexion)){
    $valido=false;
  }else{

    $valido=true;
    $_SESSION['usuario']=$usuario;
    $_SESSION['contrasena']=$contrasena;
    header('Location:index.php');
  }*/
  console.log($usuario,$contrasena);
  if($usuario == "admin" && $contrasena == "admin" ){
    $valido=true;
    $_SESSION['usuario']=$usuario;
    $_SESSION['contrasena']=$contrasena;
    header('Location:index.php');
  }
}
?>
<!DOCTYPE html>
<html>
<?php require 'pages/menus/head.php' ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h1>Login Proyecto</h1>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesion para entrar al sistema (admin/admin)</p>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="password" name="contrasena">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input type="submit"  class="btn btn-primary btn-block btn-flat" name="aceptar" value="Ingresar">
        </div>
        <!-- /.col -->
      </div>
    </form>


    <!-- /.social-auth-links -->

    <a href="#">I forgot my password</a><br>
    <a href="#" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

</body>
</html>
