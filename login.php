<?php
require 'pages/basedatos/conexion.php';
$valido=false;
if (isset($_POST['aceptar'])) {
  $usuario=$_POST['usuario'];
  $contrasena=$_POST['contrasena'];
  $resultado=valida_usuario_bd($conexion,$usuario,$contrasena);
  if(!$resultado){
    $valido=false;
  }else{
    $valido=true;
    session_start();
    foreach ($resultado as $r) {
      $_SESSION['usuario']=$usuario;
      $_SESSION['contrasena']=$contrasena;
      $_SESSION['nombre']=$r["nombre"];
      $_SESSION['apellido']=$r["apellido"];
      $_SESSION['tipo']=$r["id_tipo"];
      $_SESSION['ide']=$r["id_usuario"];
      if($r["id_tipo"]==3){
        $especialidad=selectEspecial($conexion,'SELECT id_especialidad FROM medico WHERE usuario_id='.$r["id_usuario"].';');
        foreach ($especialidad as $es) {
          $_SESSION['especialidad']=$es["id_especialidad"];
        }
      }
    }
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
    <h1>Sistema de gestión hospitalaria</h1>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesion para entrar al sistema</p>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="nombre de ususario" name="usuario">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="contraseña" name="contrasena">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <?php
				if(!$valido && isset($_POST['aceptar'])) {
					echo '<p>Usuario y/o contraseña no valido</p>';
				}
			  ?>

        <!-- /.col -->
        <div class="col-xs-4" style="float: right"> 
          <input type="submit"  class="btn btn-primary btn-block btn-flat"  name="aceptar" value="Ingresar">
        </div>
        <!-- /.col -->
      </div>
    </form>


    <!-- /.social-auth-links -->



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
