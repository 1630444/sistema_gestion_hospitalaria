<?php
  require '../basedatos/conexion.php';
  $res= selectEspecial($conexion,'SELECT `id_usuario`, `nombre`, `apellido`, `sexo`, `fecha_nacimiento`, `estado`, `cel`, `e-mail`, `No_cedula` FROM usuarios INNER JOIN medico ON usuarios.id_usuario = medico.usuario_id');
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Medicos</title>

<?php require '../menus/head.php' ?>


<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Medicos
        <small>Tabla de Medicos.</small>
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
              <h3 class="box-title">Buscar medicos</h3>
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
                    <a  href="agregar_medico.php">
                      <h5><i class="fa fa-fw fa-gears"></i>Agregar un Nuevo Registro</h5></a>
                    </th>
                </tr>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Nombre</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Apellido</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Sexo</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Fecha de Nacimiento</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Estado</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Celular</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">E-Mail</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">No.Cedula</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Herramientas</th>
                  
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($res as $medico) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$medico["id_usuario"]."</td>";
                    echo "<td>".$medico["nombre"]."</td>";
                    echo "<td>".$medico["apellido"]."</td>";
                    echo "<td>".$medico["sexo"]."</td>";
                    echo "<td>".$medico["fecha_nacimiento"]."</td>";
                    echo "<td>".$medico["estado"]."</td>";
                    echo "<td>".$medico["cel"]."</td>";
                    echo "<td>".$medico["e-mail"]."</td>";
                    echo "<td>".$medico["No_cedula"]."</td>";
                    echo "<td>
                    <div class=\"btn-group\">
                      <a  href=\"modificar_paciente.php?id=".$medico["id_usuario"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                      <a  href=\"borrar_paciente.php?id=".$medico["id_usuario"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
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
