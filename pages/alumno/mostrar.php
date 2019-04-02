<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'alumnos');



  //$consulta_todo = "SELECT 'alumnos.matricula', 'personas.nombre', 'personas.paterno', 'personas.materno', 'carreras.nombre' as carrera, 'alumnos.promedio_ingreso', 'alumnos.puntos_ceneval' as nombre_carrera FROM alumnos INNER JOIN personas on 'personas.id' = 'alumnos.id_persona' INNER JOIN carreras on 'carreras.id' = 'alumnos.id_carrera'";

  $consulta_todo = "SELECT alumnos"."."."id, alumnos". ".".  "matricula, personas". ".". "nombre, personas". ".". "paterno, personas". ".". "materno, carreras". ".". "nombre as carrera, alumnos". ".". "promedio_ingreso, alumnos". ".". "puntos_ceneval, alumnos"."."."escuela_procedencia FROM alumnos INNER JOIN personas on personas". ".". "id = alumnos". ".". "id_persona INNER JOIN carreras on carreras". ".". "id = alumnos". ".". "id_carrera";



 // echo $consulta_todo;


//SELECT alumnos.matricula, personas.nombre, personas.paterno, personas.materno, carreras.nombre as carrera, alumnos.promedio_ingreso, alumnos.puntos_ceneval as nombre_carrera FROM alumnos INNER JOIN personas on personas.id = alumnos.id_persona INNER JOIN carreras on carreras.id = alumnos.id_carrera
  $resultado = mysqli_query($conexion, $consulta_todo) or die('Error BD');




 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<title>Alumnos</title>

<?php require '../menus/head.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>


  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Alumnos
        <small>Tabla de alumnos.</small>
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
              <h3 class="box-title">Buscar alumnos</h3>
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
                   <a  href="agregar.php">
                     <h5><i class="fa fa-fw fa-gears"></i>Agregar un Nuevo Alumno</h5></a>
                   </th>
               </tr>
               <tr role="row">
                 <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" >ID

                 </th>
                 <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" >Matricula

                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Nombre
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Apellido paterno
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Apellido materno
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Carrera
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Escuela procedencia
                 </th>
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Promedio ingreso
                 </th>
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Puntos ceneval
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Herramientas
                 </th>
               </tr>
                </thead>
                <tbody>

                  <?php
                  //Aqui res son los rowes que extrae y el row es mostrar los rowes
                    while($row=$resultado->fetch_assoc()) {
                      echo "<tr role=\"row\" class=\"odd\">";
                      echo "<td class=\"sorting_2\">".$row["id"]."</td>";
                      echo "<td>".$row["matricula"]."</td>";
                      echo "<td>".$row["nombre"]."</td>";
                      echo "<td>".$row["paterno"]."</td>";
                      echo "<td>".$row["materno"]."</td>";
                      echo "<td>".$row["carrera"]."</td>";
                      echo "<td>".$row["escuela_procedencia"]."</td>";
                      echo "<td>".$row["promedio_ingreso"]."</td>";
                      echo "<td>".$row["puntos_ceneval"]."</td>";
                      //Impoirtante aqui se usa el metodo get para mandarle el row por parametro
                      echo "<td>
                      <div class=\"btn-group\">
                        <a  href=\"modificar.php?id=".$row["id"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                        <a  href=\"borrar.php?id=".$row["id"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
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
