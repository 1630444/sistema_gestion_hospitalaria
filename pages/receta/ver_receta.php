<?php
  require '../basedatos/conexion.php';
  $dato = $_GET['id'];
  $query = "SELECT rl.id_receta_lista as id, rl.cantidad as cantidad, rl.dosis as dosis, rl.dias as dias, rl.horas as horas, m.nombre as nombre,m.imagen as imagen
  FROM receta_lista rl, medicamento m
  WHERE rl.id_medicamento = m.id_medicamento and id_receta = {$dato}";
  $res= selectEspecial($conexion,$query);

 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Ver receta</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

    <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Receta
        <small>Ver Receta.</small>
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
                  <th rowspan="1" colspan="5">
                    <a  href="receta.php">
                      <h5><i class="fa fa-fw fa-gears"></i>Volver</h5></a>
                    </th>
                </tr>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="">ID </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Medicamento </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label=""> Imagen </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Cantidad</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Dosis </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Dias </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Horas </th>
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($res as $receta) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$receta["id"]."</td>";
                    echo "<td>".$receta["nombre"]."</td>";
                    echo "<td>"."<img src=\"../medicamento/{$receta["imagen"]}\" class=\"img-circle\" alt=\"User Image\" width=\"50\" height=\"50\" align=\"center\">"."</td>";
                    echo "<td>".$receta["cantidad"]."</td>";
                    echo "<td>".$receta["dosis"]."</td>";
                    echo "<td>".$receta["dias"]."</td>";
                    echo "<td>".$receta["horas"]."</td>";
                                        
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
    <!-- /.content -->
  <?php require  '../menus/footer.php' ?>
</body>
</html>
