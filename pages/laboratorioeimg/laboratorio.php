<?php
  require '../basedatos/conexion.php';
   /*$query = "SELECT ce.id_cita_estudio as id, 
                    usu.nombre_usuario as Paciente, 
                    est.tipo as Estudio, 
                    ce.fecha as FechaYHora 
            FROM  cita_estudio ce 
            INNER JOIN estudio est ON ce.id_estudio = est.id_estudio
            INNER JOIN interconsulta inter ON ce.id_interconsulta = inter.id_interconsulta 
            INNER JOIN cita on inter.id_cita = cita.id_cita 
            INNER JOIN pacientes pac ON cita.id_paciente = pac.id_paciente 
            INNER JOIN usuarios usu ON usu.id_usuario = pac.usuario_id
            WHERE cita.fecha = ('2019-09-03');"; //hay que modificar la fecha y hora por las del sistema
  $res= selectEspecial($conexion,$query);*/
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
                    <a  href="#">
                      <h5><i class="fa fa-fw fa-gears"></i>.</h5></a>
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
               
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">1 </td>";
                    echo "<td>2</td>";
                    echo "<td>3</td>";
                    echo "<td>4</td>";
                    echo "<td>
                   <ul class='navbar-nav' style='list-style: none;'>
                   <li class='dropdown notifications-menu'>
            <a href='#' class='dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
              <i class='fa fa-bell-o'></i>
              <span class='label label-warning'>10</span>
            </a>
            <ul class='dropdown-menu'>
              <li class='header'>You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class='menu'>
                  <li>
                    <a href='#'>
                      <i class='fa fa-users text-aqua'></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href='#'>
                      <i class='fa fa-warning text-yellow'></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href='#'>
                      <i class='fa fa-users text-red'></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href='#'>
                      <i class='fa fa-shopping-cart text-green'></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href='#'>
                      <i class='fa fa-user text-red'></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
                    </ul>
                      </td>";
  
                    echo "</tr>";

                  
 
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
