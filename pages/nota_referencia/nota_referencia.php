<!-- El médico usará esta interfaz -->
<?php
  require '../basedatos/conexion.php';

  $id_hosp = $_GET['id'];
  
  $query = "select r.id_referencia, 
              (select nombre from datos_referencias where id_dato = r.id_origen) as origen, 
              (select nombre from datos_referencias where id_dato = r.id_destino) as destino, 
              r.id_destino, r.descripcion_terapeutica, r.fecha from referencias_y_translados r                   
                where id_hospitalizacion = {$id_hosp}";
  
  //echo $query;

  $res= selectEspecial($conexion,$query);

 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Urgencias - nota de evolución.</title>

<?php require '../menus/head.php' ?>


<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Nota de referencia y translado.
        <small>Notas de referencia y translado.</small>
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
              <h3 class="box-title">Buscar nota de referencia y translado.</h3>
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
                    <a  href="agregar_nota_referencia.php?id=<?php echo $id_hosp ?>">
                      <h5><i class="fa fa-fw fa-gears"></i>Agregar un Nuevo Registro</h5></a>
                    </th>
                </tr>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Número de nota
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Origen
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Destino
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Descripción terapéutica</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Fecha                    
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Herramientas
                  </th>
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($res as $nota) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$nota["id_referencia"]."</td>";
                    echo "<td>".$nota["origen"]."</td>";
                    echo "<td>".$nota["destino"]."</td>";
                    echo "<td>".$nota["descripcion_terapeutica"]."</td>";
                    echo "<td>".$nota["fecha"]."</td>";
                    echo "<td>
                    <div class=\"btn-group\">
                      <a  href=\"modificar_nota_evolucion.php?id=".$nota["id_nota_evolucion"]."&cita=".$nota["id_cita"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                      <a  href=\"borrar_nota_evolucion.php?id=".$nota["id_nota_evolucion"]."&cita=".$nota["id_cita"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
                    </div>
                  </td>";
                    echo "</tr>";
                  }
                ?>


                   <!--   -->
              </tbody>
                <tfoot>
                <!--<div class="box-footer">-->
                
                <!--</div>-->
                <!--<tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>-->
                </tfoot>
               </table>
                  <a id="" href="../hospitalizaciones/hospitalizaciones.php" class="btn btn-primary"> Hospitalización </a>  
                  </div>
                </div>
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
