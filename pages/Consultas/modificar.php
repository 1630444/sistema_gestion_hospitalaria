<?php
  require '../basedatos/conexion.php';  
  $dato = $_GET['id'];

  $query = "SELECT nss, tipo_sangre, alergias, 
           (SELECT nombre FROM usuarios WHERE id_usuario = usuario_id) nombre, 
           (SELECT apellido FROM usuarios WHERE id_usuario = usuario_id) apellido 
            FROM pacientes WHERE id_paciente = " . $dato;
  $iper= selectEspecial($conexion,$query);

  if(isset($_POST['submit'])){

      $id = $_POST['id'];
      $desc = $_POST['descripcion'];


      if(empty($id)){
        $errores = 'Dame tu nombre <br/>';
      }

      if(empty($desc)){
        $errores .= 'Dame tu correo <br/>';
      }

      if(empty($errores)){
        $query = "update cuatrimestres SET descripcion='{$desc}' WHERE id={$id}";
        $actualizar = crear_registro($conexion,$query);
        if($actualizar){
          redirect('mostrar.php');
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
<head>
  <LINK REL=StyleSheet HREF="tabs.css" TYPE="text/css" MEDIA=screen>
  <script type="text/javascript" src="./tabs.js"></script>
</head>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">
     
       <div class="col-xs-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Consulta </h3>
            </div>
            <!-- Tab links -->
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'info')">Paciente</button>
              <button class="tablinks" onclick="openCity(event, 'analisis')">Analisis</button>
              <button class="tablinks" onclick="openCity(event, 'receta')">Receta</button>
              <button class="tablinks" onclick="openCity(event, 'inter')">Interconsulta</button>
            </div>

            <!-- Tab content -->
            <div id="info" class="tabcontent">
              <h3>Informacion del Paciente</h3>
              <?php foreach ($iper as $valor) {    
                echo "<b>Nombre: </b>" . $valor["nombre"] . " " . $valor["apellido"] . "<br>";
                echo "<b>NSS: </b>" . $valor["nss"] . "<br>";
                echo "<b>Tipo de sangre: </b>" . $valor["tipo_sangre"] . "<br>";
                if(empty($valor["alergias"])){
                  echo "<b>Alergias: </b>" . "Sin alergias" . "<br>";
                }
                else{
                  echo "<b>Alergias: </b>" . $valor["alergias"] . "<br>"; 
                }
              } ?>
                            
            </div>

            <div id="analisis" class="tabcontent">
              <h3>Laboratorio Clinico e Imagenologia</h3>
              <p>Paris is the capital of France.</p> 
            </div>

            <div id="receta" class="tabcontent">
              <h3>Generar Receta</h3>
              <p>Tokyo is the capital of Japan.</p>
            </div>
            
            <div id="inter" class="tabcontent">
              <h3>Agendar Interconsulta</h3>
              <p>Tokyo is the capital of Japan.</p>
            </div>
            
         </div>
      </div>
     <div class="col-xs-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Consulta </h3>
            </div>
            <!-- /.box-header -->
            <!-- IMPORTANTE NO CAMBIAR ?id= a menos que tu llave no se llame id pero
            es necesario que al hacer el post mandes de nuevo el valor que tienes por parametro-->
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id={$dato}" ?>" role="form">
              HOLA JAJA
             
               <?php foreach ($res as $valor) {    ?>
              <div class="box-body">
                <div class="form-group">

                  <label for="">ID</label>
                  <input type="text" class="form-control" name="id" placeholder="Ingrese el ID" value=" <?php echo $valor["id"]?> " required readonly>
                </div>
                <div class="form-group">
                  <label for="">Descripcion</label>
                  <input type="text" class="form-control" name="descripcion" placeholder="Ingrese una descripcion" value="<?php echo $valor["descripcion"]?>" required>
                </div>
              </div>
              <!-- /.box-body -->
                <?php } ?>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
