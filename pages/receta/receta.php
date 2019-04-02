<?php
  require '../basedatos/conexion.php';
  $query = "SELECT r.id_receta as id, p.nss as nss, m.no_cedula as cedula, c.fecha as fecha, r.estado as estado 
  FROM receta r , cita c, pacientes p, medico m 
  where r.id_cita = c.id_cita and c.id_paciente = p.id_paciente and c.id_medico = m.id_medico";
  $res= selectEspecial($conexion,$query);
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Receta</title>

<?php require '../menus/head.php' ?>


<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Recetas
        <small>Tabla de Recetas.</small>
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
              <h3 class="box-title">Buscar Recetas</h3>
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
                  
                </tr>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">ID </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">NSS Paciente </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=""> Cedula Medico </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Fecha</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Estado </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Herramientas </th>
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($res as $receta) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$receta["id"]."</td>";
                    echo "<td>".$receta["nss"]."</td>";
                    echo "<td>".$receta["cedula"]."</td>";
                    echo "<td>".$receta["fecha"]."</td>";
                    echo "<td>".$receta["estado"]."</td>";
                    if($receta["estado"] == 0){
                      echo "<td>
                        <div class=\"btn-group\">
                          <a  href=\"ver_receta.php?id=".$receta["id"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                          <a  href=\"aceptar_receta.php?id=".$receta["id"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-check\"></i></a>
                        </div>
                      </td>";
                    }else{
                      echo "<td>
                        <div class=\"btn-group\">
                          <a  href=\"ver_receta.php?id=".$receta["id"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                        </div>
                      </td>";
                    }
                    
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
