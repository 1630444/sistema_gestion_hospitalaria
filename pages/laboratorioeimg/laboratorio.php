<?php
//medicos  - imagenologo y laboratorista
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=3){
      header('Location: ../../index.php');
		exit;
  }
if(!($_SESSION["especialidad"]==9 || $_SESSION["especialidad"]==10)){
      header('Location: ../../index.php');
		exit;
  }

   $query = "SELECT ce.id_cita_estudio as id, usu.nombre as Paciente, est.tipo as Estudio, ce.fecha as FechaYHora, folio
              FROM cita_estudio ce 
              INNER JOIN estudio est ON ce.id_estudio = est.id_estudio 
              INNER JOIN interconsulta inter ON ce.id_interconsulta = inter.id_interconsulta 
              INNER JOIN cita on inter.id_cita = cita.id_cita 
              INNER JOIN pacientes pac ON cita.id_paciente = pac.id_paciente 
              INNER JOIN usuarios usu ON usu.id_usuario = pac.usuario_id 
              WHERE DATE(ce.fecha) =('".date("Y-m-d")."')  and ce.id_estudio<4 and ce.img = 0"; //date obtiene la fecha del sistema
  $res= selectEspecial($conexion,$query);
  //$res= select($conexion,'cita_estudio');
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Laboratorio.</title>

<?php require '../menus/head.php' ?>


<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Laboratorio.
        <small>Citas de laboratorio.</small>
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
              <h3 class="box-title">Buscar citas de laboratorio.</h3>
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
                    
                    </th>
                </tr>
                <tr role="row">
                  <!--<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID
                  </th>-->
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ID
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Paciente
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Estudio</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Fecha y hora</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Herramientas
                  </th>
                </tr>
                </thead>
                <tbody>

                <?php
                  /*foreach ($res as $uregencia) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$uregencia["id"]." </td>";
                    echo "<td>".$uregencia["Paciente"]."</td>";
                    echo "<td>".$uregencia["Estudio"]."</td>";
                    echo "<td>".$uregencia["FechaYHora"]."</td>";
                    echo "<td>
                    <div class=\"btn-group\">
                      <a  href=\"modificar_grupo.php?id=".$uregencia["id"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                      <a  href=\"borrar_grupo.php?id=".$uregencia["id"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
                    </div>
                  </td>";
                    echo "</tr>";

                  }*/
               /*
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">1 </td>";
                    echo "<td>Genaro Juan</td>";
                    echo "<td>Sangre</td>";
                    echo "<td>2019-04-02 14:25</td>";
                    echo "<td>
                   <ul class='navbar-nav' style='list-style: none;'>
                   <li class='dropdown notifications-menu'>
            <a href='#' class='dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
              <i class='fa fa-bell-o'></i>
              <span class='label label-success'>1</span>
            </a>
            <ul class='dropdown-menu'>
              <li class='header'>Folio de estudio.</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class='menu'>
                  <li>
                  <a >
                      <i class='fa fa-users text-red'></i> Sangre: <b>2019-04-011</b>
                   </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
                    </ul>
                      </td>";
  
                    echo "</tr>";
*/
  
                 foreach ($res as $uregencia) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$uregencia["id"]." </td>";
                    echo "<td>".$uregencia["Paciente"]."</td>";
                    echo "<td>".$uregencia["Estudio"]."</td>";
                    echo "<td>".$uregencia["FechaYHora"]."</td>";
                    echo "<td>
                    
                    <ul class='navbar-nav' style='list-style: none;'>
                       <li class='dropdown notifications-menu'>
                         <a href='#' class='dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                            <i class='fa fa-bell-o'></i>
                            <span class='label label-success'>1</span>
                          </a>
                          <ul class='dropdown-menu'>
                            <li class='header'>Folio de estudio.</li>
                            <li>
                              <!-- inner menu: contains the actual data -->
                              <ul class='menu'>
                                <li>
                                <a >
                                    <i class='fa fa-users text-red'></i> {$uregencia["folio"]}</b>
                                 </a>
                                </li>
                              </ul>
                            </li>
                          </ul>
                        </li>
                    </ul>
                   
                    
                    
                  </td>";
                    echo "</tr>";

                  }
               
                  
 
                ?>


                 
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
