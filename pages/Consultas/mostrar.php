<?php
  require '../basedatos/conexion.php';
  require '../sesion/abre_sesion.php';

  if($_SESSION['tipo']!=3){
    header('Location: ../../index.php');
		exit;
  }

  /*$query = "SELECT id_cita, (SELECT nombre FROM usuarios WHERE id_usuario = P.usuario_id) nombre, hora 
  FROM pacientes P, cita C 
  WHERE P.id_paciente = C.id_paciente";*/
  $usera = $_SESSION['usuario'];

  $query="SELECT id_cita, (SELECT nombre FROM usuarios WHERE id_usuario = P.usuario_id) nombre, hora 
  FROM pacientes P, cita C 
  WHERE P.id_paciente = C.id_paciente and C.id_medico = 
  (SELECT id_medico FROM medico WHERE usuario_id = (SELECT id_usuario FROM usuarios WHERE nombre_usuario = '$usera')) and C.estado = 0";
  $res= selectEspecial($conexion,$query);
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Consultas.</title>
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

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Consultas
        <small>Generales y Especialidades</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Consultas del día</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row"><div class="col-sm-6"></div>
                <div class="col-sm-6"></div></div>

                <div class="row"><div class="col-sm-12">

                  <table id="example1" class="table table-bordered table-striped">
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
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Hora
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Nombre de Paciente
                  </th>                
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($res as $nota) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$nota["id_cita"]."</td>";
                    echo "<td>".$nota["hora"]."</td>";
                    echo "<td>".$nota["nombre"]."</td>";
                    echo "<td>
                    <div class=\"btn-group\">
                      <a  onclick=\"cargar(" . $nota["id_cita"] . ");\" href=\"modificar.php?id=".$nota["id_cita"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-heartbeat\"></i></a>
                    </div>
                  </td>";
                    echo "</tr>";
                  }
                ?>


                   <!--   -->
              </tbody>
                <tfoot>
                <!--<tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>-->
                </tfoot>
              </table></div></div>
              </div>
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
