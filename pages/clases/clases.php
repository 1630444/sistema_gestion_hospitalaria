<?php
  require '../basedatos/conexion.php';

  $query = 'select class.id, 
              class.clave as clave_clase, 
              class.capacidad, 
              g.clave as clave_grupo, 
              carr.nombre as nombre_carrera, 
              pl.clave as clave_plan_estudio, 
              ma.nombre as nombre_materia
              from clases class
                    inner join grupos g
                      on class.id_grupo = g.id
                    inner join carreras carr
                      on g.id_carrera = carr.id
                    inner join planes_estudio pl
                      on g.id_plan = pl.id
                    inner join materias ma
                      on class.id_materia = ma.id';
  //echo $query;                    
  $res= selectEspecial($conexion,$query);

 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<title>Clases</title>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Clases
        <small>Tabla de clases.</small>
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
              <h3 class="box-title">Buscar clases</h3>
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
                    <th rowspan="1" colspan="6">
                      <a  href="agregar_clase.php">
                        <h5><i class="fa fa-fw fa-gears"></i>Agregar un Nuevo Registro</h5></a>
                      </th>
                  </tr>
                <tr role="row">
                  <!--<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID
                  </th>-->
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Clave de clase
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Capacidad
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Clave de grupo
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Carrera
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Plan
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="">Materia
                  </th>
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($res as $clases) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    /*echo "<td class=\"sorting_2\">".$clases["id"]."</td>";*/                    
                    echo "<td>".$clases['clave_clase']."</td>";
                    
                    echo "<td>".$clases["capacidad"]."</td>";
                    
                    echo "<td>".$clases["clave_grupo"]."</td>";
                    
                    echo "<td>".utf8_encode($clases["nombre_carrera"])."</td>";
                    
                    echo "<td>".$clases["clave_plan_estudio"]."</td>";
                    
                    echo "<td>".$clases["nombre_materia"]."</td>";
                    
                    echo "<td>
                    <div class=\"btn-group\">
                      <a  href=\"modificar_clase.php?id=".$clases["id"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                      <a  href=\"borrar_clase.php?id=".$clases["id"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
                    </div>
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
