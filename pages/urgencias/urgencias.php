<!-- El médico usará esta interfaz -->
<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=3){
    header('Location: ../../index.php');
		exit;
  }

  #$res = selectEspecial($conexion, "SELECT u.id_urgencia idurgencia, u.diagnostico udiagnostico, u.fecha ufecha, p.nombre pnombre, p.apellido papellido,  m.nombre mnombre, m.apellido mapellido FROM urgencias u, pacientes p, medico m WHERE u.id_paciente = p.id_paciente AND u.id_medico = m.id_medico");

   $res = selectEspecial($conexion, "SELECT u.id_urgencia idurgencia, u.diagnostico udiagnostico, u.fecha ufecha, us.nombre pnombre, us.apellido papellido,  u.id_medico idmedico FROM urgencias u, pacientes p, usuarios us WHERE u.id_paciente = p.id_paciente AND p.usuario_id = us.id_usuario");
 ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">
    
      <!--Titulo dentro del contened-->
      <section class="content-header">
        <h1>
          Urgencias
          <small>Tabla de urgencias registradas.</small>
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
              <h3 class="box-title">Urgencias</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row"><div class="col-sm-6"></div>
                <div class="col-sm-6"></div></div>

                <div class="row"><div class="col-sm-12">


                  <table id="example1" class="table table-bordered table-striped">
                <thead>
                   <tr>
                  <th rowspan="1" colspan="5">
                    <a  href="agregar_urgencia.php">
                      <h5><i class="fa fa-fw fa-gears"></i>Agregar Urgencia</h5></a>
                    </th>
                </tr>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID Urgencia
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Paciente
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">ID Médico
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Diagnóstico</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Fecha</th>

                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Herramientas
                  </th>
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($res as $urgen) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$urgen["idurgencia"]."</td>";
                    echo "<td>".$urgen["pnombre"]."  ".$urgen["papellido"]."</td>";
                    echo "<td>".$urgen["idmedico"]."</td>";
                    echo "<td>".$urgen["udiagnostico"]."</td>";
                    echo "<td>".$urgen["ufecha"]."</td>";
                    echo "<td>
                    <div class=\"btn-group\">
                      <a  href=\"modificar_urgencia.php?id=".$urgen["idurgencia"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                      <a  href=\"borrar_urgencia.php?id=".$urgen["idurgencia"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
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
