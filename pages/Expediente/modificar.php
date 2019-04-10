<?php
  require '../basedatos/conexion.php';
  require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=4){
    header('Location: ../../index.php');
		exit;
  }

  $med= select($conexion,'medicamento');

  $dato = $_GET['id'];

  $query = "SELECT nss, tipo_sangre, alergias, 
           (SELECT nombre FROM usuarios WHERE id_usuario = usuario_id) nombre, 
           (SELECT apellido FROM usuarios WHERE id_usuario = usuario_id) apellido,
           (SELECT sexo FROM usuarios WHERE id_usuario = usuario_id) sexo,
           (SELECT fecha_nacimiento FROM usuarios WHERE id_usuario = usuario_id) fecha
            FROM pacientes WHERE id_paciente = (Select id_paciente From cita Where id_cita = '$dato')";
  $iper= selectEspecial($conexion,$query);

  $query = "SELECT id_expediente,motivo_atencion, fecha_registro 
            FROM expediente WHERE id_paciente = (Select id_paciente From cita Where id_cita = '$dato')";
  $lbit= selectEspecial($conexion,$query);

  $query = "SELECT C.id_cita_estudio, (SELECT especificado FROM estudio WHERE id_estudio = C.id_estudio) estudio, C.fecha, C.folio
  FROM cita_estudio C, interconsulta I 
  WHERE C.id_interconsulta = I.id_interconsulta and I.id_paciente = (Select id_paciente From cita Where id_cita = $dato)";

  $anal= selectEspecial($conexion,$query);

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

<body class="hold-transition skin-purple sidebar-mini" >
<input type="hidden" id="dato" value="<?php echo $dato ?>">
  
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">
     
       <div class="col-xs-12">
         <div id="msg">
  
          </div>
          <!-- general form elements -->
          <div class="box">
            
              <h3>Informacion del Paciente</h3><!-- ----------------------------------------------INFORMACION PERSONAL -->
              <?php foreach ($iper as $valor) {
                echo '<table class="inff">';
                echo '<tr>';
                echo '<th>Nombre</th>' . '<td>' . utf8_encode($valor["nombre"]) . " " . utf8_encode($valor["apellido"]) . "</td>";
                echo '</tr>';
                echo '<tr>';
                echo '<th>Sexo</th>' . '<td>' . $valor["sexo"] . "</td>";
                echo '</tr>';
                echo '<tr>';
                echo "<th>Nacimiento</th>" . '<td>' . $valor["fecha"] . "</td>";
                echo '</tr>';
                echo '<tr>';
                echo "<th>Tipo de sangre&emsp;&emsp;</th>" . '<td>' . $valor["tipo_sangre"] . "</td>";
                echo '</tr>';
                echo '<tr>';
                if(empty($valor["alergias"]) || $valor["alergias"]=="null"){
                  echo "<th>Alergias</th>" . '<td>' . "Sin alergias" . "</td>";
                }
                else{
                  echo "<th>Alergias</th>" . '<td>' . utf8_encode($valor["alergias"]) . "</td>"; 
                }
                echo '<tr>';
                echo '<th>NSS</th>' . '<td>' . $valor["nss"] . "</td>";
                echo '</tr>';
                echo '</tr>';
                echo '</table>';
              } ?>
              
            
           
            <!-- Tab links -->
            <br>
            <div class="tab">
              <button class="tablinks" onclick="openCity(event, 'analisis')">Analisis</button>
              <button class="tablinks" onclick="openCity(event, 'historial')">Historial</button>
        
            </div>
            
            <!-- Tab content -->
            

            <form id="lab" action="#">
            <div id="analisis" class="tabcontent">
              <br><br>
              <h3>Laboratorio Clínico e Imagenología</h3><!-- ---------------------------------LABORATORIO -->
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                   <!--<tr>
                    <th rowspan="1" colspan="5">
                    <a  href="agregar_nota_evolucion.php">
                      <h5><i class="fa fa-fw fa-gears"></i>Agregar un Nuevo Registro</h5></a>
                    </th>
                  </tr>-->
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Estudio
                  </th> 
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Fecha
                  </th> 
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Folio
                  </th> 
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Herramientas
                  </th>               
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($anal as $nota) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$nota["id_cita_estudio"]."</td>";
                    echo "<td>".utf8_encode($nota["estudio"])."</td>";
                    echo "<td>".$nota["fecha"]."</td>";
                    echo "<td>".$nota["folio"]."</td>";
                    echo '<td><button type="submit" class="btn btn-primary" style="float: right;" name="submit" value="'.$nota["id_cita_estudio"].'">Ver</button></td>';
                    echo "</tr>";

                  }
                ?>


                   <!--   -->
              </tbody>
                <tfoot>
                <!--<tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>-->
                </tfoot>
              </table>
            </div>
            </form>
            
            <form id="form1" action="#">
            <div id="historial" class="tabcontent">
              <br><br>
              <h3>Historial Clínico</h3><!-- -----------------------------------------------------HISTORIAL CLINICO -->
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                   <!--<tr>
                    <th rowspan="1" colspan="5">
                    <a  href="agregar_nota_evolucion.php">
                      <h5><i class="fa fa-fw fa-gears"></i>Agregar un Nuevo Registro</h5></a>
                    </th>
                  </tr>-->
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Fecha
                  </th> 
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Motivo de atención
                  </th>               
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Herramientas
                  </th>               
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($lbit as $nota) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$nota["id_expediente"]."</td>";
                    echo "<td>".$nota["fecha_registro"]."</td>";
                    echo "<td>".$nota["motivo_atencion"]."</td>";
                    echo '<td><button type="submit" class="btn btn-primary" style="float: right;" name="submit" value="'.$nota["id_expediente"].'">Ver</button></td>';
                    echo "</tr>";

                  }
                ?>


                   <!--   -->
              </tbody>
                <tfoot>
                <!--<tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>-->
                </tfoot>
              </table>
            </div>
            </form>
  
            <form id="lista" action="#">
            <div id="receta" class="tabcontent"><!-- --------------------------------------------------------------GENERAR RECETA -->
                <br><br><h3>
              Generar receta médica
              </h3>
                <div id="listota">
                  <br>
                  Agrege medicamentos para generar receta
                  <br>
                  <hr>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" style="float: right;" name="submit" value="bandera">Agregar</button>
                <br>
                *Para borrar un registro, establezca la cantidad en 0 y presione guardar.
                <br>
                <br>
                <hr>
              
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">ID</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Nombre</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Imagen</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Via administracion</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Tipo</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Herramientas </th>
                </tr>
                </thead>
                <tbody>


                <?php
                  foreach ($med as $medicamento) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$medicamento["id_medicamento"]."</td>";
                    echo "<td>".$medicamento["nombre"]."</td>";
                    echo "<td>"."<img src=\"../medicamento/{$medicamento["imagen"]}\" class=\"img-circle\" alt=\"User Image\" width=\"50\" height=\"50\" align=\"center\">"."</td>";
                    echo "<td>".$medicamento["via_administracion"]."</td>";
                    echo "<td>".$medicamento["tipo"]."</td>";
                    echo '<td><button type="submit" class="btn btn-primary" style="float: right;" name="submit" value="'.$medicamento["id_medicamento"].'">Agregar</button></td>';
                    echo "</tr>";

                  }
                ?>


                   <!--   -->
              </tbody>
                <tfoot>
                <!--<tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>-->
                </tfoot>
              </table>
            </div>
            </form>
            
            <form id="horarios" action="#">
            <div id="inter" class="tabcontent">
              <br><br>
              <h3>Agendar Interconsulta</h3>
              <div class="col-xs-12">
                <div class="col-xs-6">
                  <b>Seleccione un mes: </b><input type="number" min="1" max="12" id="mes" value="1">
                  <div id="tablaC">

                  </div>
                </div>
                <div class="col-xs-6">
                  <b>Seleccione el tipo de cita: </b>
                  <select id="tipo">
                    <option>-</option>
                    <option value="especialidad">Especialidad</option>
                    <option value="interconsulta">Interconsulta</option>
                  </select>
                  <hr>
                  <div id="tiposs">
                    
                  </div>
                  <div id="fechass">
                    
                  </div>
                </div>
              </div>
              --
            </div>
            </form>
         </div>
      </div>
      
        
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Expediente Clinico</h3>
            </div>
            <!-- /.box-header -->
            <form id="guardar_B" action="#">
            <div class="box-body" id="bitacora">
              Seleccione un Historial medico
            </div>
            </form>
            <!-- /.box-body -->
            <div id="msg2">
  
          </div>
          </div>
          <!-- /.box -->
        <!-- /.col -->
      </div>
      
      <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Resultados de estudios</h3>
            </div>
            <!-- /.box-header -->
            <form id="guardar_B" action="#">
            <div class="box-body" id="labor">
              Seleccione un estudio
            </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col -->
      </div>

    </section>
    <!-- /.content -->
  </div>
    <script type="text/javascript" src="scripy.js"></script>
  <?php require  '../menus/footer.php' ?>
  </div>
</body>
</html>
