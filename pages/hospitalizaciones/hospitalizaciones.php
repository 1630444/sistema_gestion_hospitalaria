<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=3){
    header('Location: ../../index.php');
		exit;
  }

  $res= select($conexion,'hospitalizacion');
  
  $hosp_paciente = "select hosp.id_hospitalizacion as id_hospitalizacion, hosp.id_urgencia, hosp.id_cama as cama, hosp.fecha_ingreso as fecha_ingreso, 
  hosp.fecha_egreso as fecha_egreso, hosp.corta_estancia as corta_estancia, urg.id_urgencia as id_urgencia, urg.id_paciente as id_paciente, 
  urg.diagnostico as diagnostico, us.nombre as nombre_paciente, us.apellido as apellido_paciente

    from 
    hospitalizacion hosp
    inner join urgencias urg
      on hosp.id_urgencia = urg.id_urgencia
    inner join pacientes pac 
      on urg.id_paciente = pac.id_paciente
    inner join usuarios us
      on pac.usuario_id = us.id_usuario";


  
  $hosp_medico = "select hosp.id_hospitalizacion as id_hospitalizacion, hosp.id_urgencia, hosp.id_cama as cama, hosp.fecha_ingreso as fecha_ingreso, 
  hosp.fecha_egreso as fecha_egreso, hosp.corta_estancia as corta_estancia, urg.id_urgencia as id_urgencia, urg.id_medico as id_medico, 
  urg.diagnostico as diagnostico, us.nombre as nombre_medico, us.apellido as apellido_medico

    from 
    hospitalizacion hosp
    inner join urgencias urg
      on hosp.id_urgencia = urg.id_urgencia
    inner join medico med 
      on urg.id_medico = med.id_medico
    inner join usuarios us
      on med.usuario_id = us.id_usuario";
  
  $pacientes = mysqli_query($conexion,$hosp_paciente) or die('Error al ejecutar la consulta');
  $medicos = mysqli_query($conexion,$hosp_medico) or die('Error al ejecutar la consulta');
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Hospitalización</title>

<?php require '../menus/head.php' ?>


<body class="hold-transition skin-purple sidebar-mini">
  <div class="wrapper">

    <?php require '../menus/header.php' ?>
    <?php require '../menus/sidebar.php' ?>

    <div class="content-wrapper">

      <!--Titulo dentro del contened-->
      <section class="content-header">
        <h1>
          Hospitalización
          <small>Tabla de hospitalizaciones.</small>
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
                <h3 class="box-title">Buscar hospitalización</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  <div class="row"><div class="col-sm-6"></div>
                  <div class="col-sm-6"></div></div>

                  <div class="row"><div class="col-sm-12">

                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">

                <thead>
                   <tr>
                  <th rowspan="1" colspan="5">
                    <a  href="agregar_hospitalizacion.php">
                      <h5><i class="fa fa-fw fa-gears"></i>Agregar Hospitalización</h5></a>
                    </th>
                </tr>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID Hospitalización
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Paciente
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Médico
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Diagnóstico</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Fecha de Ingreso</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Fecha de Egreso</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Cama</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Estancia corta</th>
                  <th tabindex="0" aria-controls="example2" rowspan="1" colspan="1"></th>                 
                  
                </tr>
                </thead>
                <tbody>

                    <?php
                        while(($med = mysqli_fetch_array($medicos))!=NULL and ($pac = mysqli_fetch_array($pacientes))!=NULL) {
                          echo "<tr role=\"row\" class=\"odd\">";
                            echo "<td class=\"sorting_2\">".$pac["id_hospitalizacion"]."</td>";
                            echo "<td>".$pac['apellido_paciente']. " ".$pac['nombre_paciente'] ."</td>";
                            echo "<td>".$med['apellido_medico'] . " ".$med['nombre_medico']  ."</td>";
                            echo "<td>".$pac['diagnostico']."</td>";
                            echo "<td>".$pac['fecha_ingreso']."</td>";
                            echo "<td>".$pac['fecha_egreso']."</td>";
                            echo "<td>".$pac['cama']."</td>";
                            if($pac['corta_estancia']==1){
                              echo "<td>Sí</td>"; 
                            }else{
                              echo "<td>No</td>";
                            }
                          
                            //<div class=\"btn-group\">
                            //  <a  href=\"modificar_hospitalizacion.php?id_hospitalizacion=".$pac["id_hospitalizacion"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i></a>
                            //  <a  href=\"borrar_hospitalizacion.php?id_hospitalizacion=".$pac["id_hospitalizacion"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i></a>
                            //</div>
                            echo "<td>                                    
                                    <section class=\"\">
                                    <ul data-widget=\"tree\" style=\"list-style:none\">            
                                    <li class=\"treeview\" ><a href=\"#\"> <i class=\"fa fa-plus\"></i> <span>Herramientas</span> <span class=\"pull-right-container\"> </span></a>
                                      <ul class = \"treeview-menu\">
                                        <li><a href=\"modificar_hospitalizacion.php?id_hospitalizacion=".$pac["id_hospitalizacion"]."\" type=\"button\" class=\"btn btn-info\"><i class=\"fa fa-fw fa-pencil\"></i> </a></li>
                                        
                                        <li><a id=\"\" href=\"../nota_evolucion/nota_evolucion.php?id={$pac["id_hospitalizacion"]}\" class=\"btn btn-warning btn-block\"><i class=\"fa fa-sticky-note\"></i> </a></li>
                                        
                                        
                                        <li><a href=\"borrar_hospitalizacion.php?id_hospitalizacion=".$pac["id_hospitalizacion"]."\" type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-fw fa-trash\"></i> </a></li>                                    
                                       </ul>
                                    </ul
                                    </section>
                              
                            </td>";
                            echo "</tr>"; 
                        }
                                // <li><a id=\"\" href=\"../nota_referencia/nota_referencia.php?id={$pac["id_hospitalizacion"]}\" class=\"btn btn-warning btn-block\"><i class=\"fa fa-sticky-note\"></i> </a></li>
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
          
  
          <div class="modal fade" id="ventana1">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <!-- Header de la ventana. -->
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modla-title">Encabezado ventana 1</h4>
               </div>

               <!-- Contenido de la ventana. -->
               <div class="modal-body">
                 <p>Contenidos de la ventana.</p>

                 <div class="row">      
                 <div class="col-xs-12">
                 <div class="box">
                 <div class="box-header">
                 <h3 class="box-title">Cargar materias</h3>
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body">
                 <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                 <div class="row"><div class="col-sm-6"></div>
                 <div class="col-sm-6"></div></div>

                 <div class="row"><div class="col-sm-12"></div>
                 </div>
                 </div>
                 </div>
                 </div>
                 </div>
                 </div>
                 <!-- Footer de la ventana. -->
                 <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
                 </div>
               </div>                  
             </div>
            </div>
          </div>          
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
