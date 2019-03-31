<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'materias');
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<title>Materias</title>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>



  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Materias
        <small>Tabla de materias.</small>
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
              <h3 class="box-title">Buscar materias</h3>
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
                   <a  href="agregar_materias.php">
                     <h5><i class="fa fa-fw fa-gears"></i>Agregar una Nueva Materia</h5></a>
                   </th>
               </tr>
               <tr role="row">
                 <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" >ID
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Nombre de la materia
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Nombre corto
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Herramientas
                 </th>
               </tr>
                </thead>
                <tbody>
                  <?php
                  //Aqui res son los valores que extrae y el valor es mostrar los valores
                    foreach ($res as $valor) {
                      echo "<tr role=\"row\" class=\"odd\">";
                      echo "<td class=\"sorting_2\">".$valor["id"]."</td>";
                      echo "<td>".$valor["nombre"]."</td>";
                      echo "<td>".$valor["nombre_corto"]."</td>";
                      //Impoirtante aqui se usa el metodo get para mandarle el valor por parametro
                      echo "<td>
                      <div class=\"btn-group\">
                        <a  href=\"modificar_materias.php?id=".$valor["id"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                        <a  href=\"borrar_materias.php?id=".$valor["id"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
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
