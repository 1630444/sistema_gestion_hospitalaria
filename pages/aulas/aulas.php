
<?php
require '../basedatos/conexion.php';
$query = "select * from aulas;";
$res = selectEspecial($conexion,$query);

$query = "select MAX(id) as max_id from aulas";
$res2 = selectEspecial($conexion,$query);
$row = mysqli_fetch_array($res2);


 ?>
<html>
<!--


  INSERT INTO `personas`(`id`, `curp`, `nombre`, `paterno`, `materno`, `nss`, `correo`, `telefono_movil`, `telefono_casa`, `fecha_nac`) VALUES (0,'RALE980909HTSMCL09','ELUIS','RAMOS','LUCIO','65234623','1630261@UPV.EDU.MX','8341231212','3124345','09-09-1998')
  INSERT INTO `maestros`(`id`, `numero_empleado`, `grado_academico`, `tipo_contrato`, `id_persona`, `id_carrera`) VALUES (0,'100','BACHILLERATO','PA',1,1)
-->


<title>Aulas</title>
  <?php require '../menus/head.php' ?>

  <body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php require '../menus/header.php' ?>
    <?php require '../menus/sidebar.php' ?>


    <div class="content-wrapper">

    <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Aulas
        <small>Tabla de aulas.</small>
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
                <h3 class="box-title">Buscar aulas</h3>
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
                          <a  href="agregar_aulas.php">
                            <h5><i class="fa fa-fw fa-gears"></i>Agregar una Nueva Aula</h5></a>
                          </th>
                      </tr>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending">ID </th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" >Nombre</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Edificio</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Tipo</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Capacidad</th>
                        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Herramientas</th>
                      </tr>
                      </thead>
                      <tbody>

                  <?php
                    foreach ($res as $aula) {
                      echo "<tr role=\"row\" class=\"odd\">";
                      echo "<td class=\"sorting_2\">".$aula["id"]."</td>";
                      echo "<td>".$aula["nombre"]."</td>";
                      echo "<td>".$aula["edificio"]."</td>";
                      echo "<td>".$aula["tipo"]."</td>";
                      echo "<td>".$aula["capacidad"]."</td>";
                      echo "<td>
                      <div class=\"btn-group\">
                        <a  href=\"modificar_aulas.php?id=".$aula["id"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                        <a  href=\"borrar_aulas.php?id=".$aula["id"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
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
