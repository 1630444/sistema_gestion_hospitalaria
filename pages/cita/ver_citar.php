<!-- El médico usará esta interfaz -->
<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=2){
    header('Location: ../../index.php');
		exit;
  }
 $ide=-1;
$query="select * from pacientes where usuario_id = ".$_SESSION['ide'];
   $res = selectEspecial($conexion,$query);
foreach($res as $sss){
            $ide=$sss['id_paciente'];
          }


  #$res = selectEspecial($conexion, "SELECT u.id_urgencia idurgencia, u.diagnostico udiagnostico, u.fecha ufecha, p.nombre pnombre, p.apellido papellido,  m.nombre mnombre, m.apellido mapellido FROM urgencias u, pacientes p, medico m WHERE u.id_paciente = p.id_paciente AND u.id_medico = m.id_medico");
$query= "select * from cita where id_paciente= ".$ide." AND estado=0 AND  fecha > (select CAST(DATE_FORMAT(NOW() ,'%Y-%m-01') as DATE)) AND fecha <LAST_DAY(NOW()) order by fecha ASC";
   $res = selectEspecial($conexion,$query);
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
          Citas
          <small>Tabla de citas registradas.</small>
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
              <h3 class="box-title">Citas</h3>
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
                    <a  href="agregar_citar.php">
                      <h5><i class="fa fa-fw fa-gears"></i>Agregar Cita</h5></a>
                    </th>
                </tr>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID
                  </th>
                   <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Hora
                  </th>
                   
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Fecha (Formato 24 hrs)
                  </th>
                   
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Borrar registro
                  </th>
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($res as $urgen) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$urgen["id_cita"]."</td>";
                    echo "<td>". $urgen["fecha"]."</td>";
                    echo "<td>". $urgen["hora"]."</td>";
                 
                    echo "<td>
                    <div class=\"btn-group\"> 
                      <a  href=\"borrar_cita.php?id=".$urgen["id_cita"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
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
