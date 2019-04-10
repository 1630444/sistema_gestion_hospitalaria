<?php
//medicos  - imagenologo y laboratorista
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=3){
      header('Location: ../../index.php');
		exit;
  }
if(!($_SESSION["especialidad"]==9 || $_SESSION["especialidad"]==10)){
      header('Location: ../../index.php');
		exit;
  }

    $tableimg = 'imageneologia';
    $tablelab = 'laboratorio';
    $errores = '';

   $query = "SELECT ce.id_cita_estudio as id, usu.nombre as Paciente, CONCAT(est.tipo,'/   ', est.especificado) as Estudio, ce.folio as folio 
              FROM cita_estudio ce  
              INNER JOIN estudio est ON ce.id_estudio = est.id_estudio 
              INNER JOIN interconsulta inter ON ce.id_interconsulta = inter.id_interconsulta 
              INNER JOIN cita on inter.id_cita = cita.id_cita 
              INNER JOIN pacientes pac ON cita.id_paciente = pac.id_paciente 
              INNER JOIN usuarios usu ON usu.id_usuario = pac.usuario_id
              WHERE ce.img = 0 AND ce.id_estudio < 4;";
  $resLab= selectEspecial($conexion,$query);
  
  $query = "SELECT ce.id_cita_estudio as id, usu.nombre as Paciente, CONCAT(est.tipo,'/   ', est.especificado) as Estudio, ce.folio as folio 
              FROM cita_estudio ce  
              INNER JOIN estudio est ON ce.id_estudio = est.id_estudio 
              INNER JOIN interconsulta inter ON ce.id_interconsulta = inter.id_interconsulta 
              INNER JOIN cita on inter.id_cita = cita.id_cita 
              INNER JOIN pacientes pac ON cita.id_paciente = pac.id_paciente 
              INNER JOIN usuarios usu ON usu.id_usuario = pac.usuario_id
              WHERE ce.img = 0 AND ce.id_estudio > 3;";
  $resImg= selectEspecial($conexion,$query);

  if(isset($_POST['enviolab']) && !empty($_FILES['archivo']['name'])){

     
    //redirect('resultados.php');
        

        $ruta="archivos/";//ruta carpeta donde queremos copiar las imágenes
       
        $extension = end(explode(".", $_FILES['archivo']['name']));
    
        $query = "select folio from cita_estudio where id_cita_estudio = ".$_POST['enviolab'];
        $result = selectEspecial($conexion,$query);
        foreach($result  as $v ){
          $nombre = $v['folio'];
        }
        $uploadfile_temporal=$_FILES['archivo']['tmp_name'];
        $uploadfile_nombre=$ruta.$nombre.'.'.$extension;
        if (is_uploaded_file($uploadfile_temporal))
        {
            //echo "subido";
        }
        else
        {
          $errores = 'error <br/>';
        }



        if(empty($errores)){
          
          $query = "insert into {$tablelab} (id_cita_estudio,resultados,observaciones) values ('{$_POST['enviolab']}','{$uploadfile_nombre}',' id : {$_POST['enviolab']}');";
          $agregar = crear_registro($conexion,$query);

          if(move_uploaded_file($uploadfile_temporal,$uploadfile_nombre)){
            
            
          }else{
          
          }
          
          if($agregar){
            
           $query1 = "update cita_estudio set img = 1 WHERE id_cita_estudio = ('{$_POST['enviolab']}');";
            $update = crear_registro($conexion,$query1);
            if($update){            
              redirect('resultados.php');
            }
          } else {
            echo $query1;
            echo $query;
          }
            
        }
         // echo $query1;
          //echo $query;
    }
  if(isset($_POST['envioimagen']) && !empty($_FILES['img']['name'])){

     
    //redirect('resultados.php');
        

        $ruta="radioimg/";//ruta carpeta donde queremos copiar las imágenes
        $extension = end(explode(".", $_FILES['img']['name']));
    
        $query = "select folio from cita_estudio where id_cita_estudio = ".$_POST['envioimagen'];
        $result = selectEspecial($conexion,$query);
        foreach($result  as $v ){
          $nombre = $v['folio'];
        }
        $uploadfile_temporal=$_FILES['img']['tmp_name'];
        $uploadfile_nombre=$ruta.$nombre.'.'.$extension;
        if (is_uploaded_file($uploadfile_temporal))
        {
           // echo "subido";
        }
        else
        {
          $errores = 'error <br/>';
        }



        if(empty($errores)){
          
          $query = "insert into {$tableimg} (id_cita_estudio,imagen) values ('{$_POST['envioimagen']}','{$uploadfile_nombre}');";
          $agregar = crear_registro($conexion,$query);

          if(move_uploaded_file($uploadfile_temporal,$uploadfile_nombre)){
            
            
          }else{
           
          }
        
          if($agregar){
            
           $query1 = "update cita_estudio set img = 1 WHERE id_cita_estudio = ('{$_POST['envioimagen']}');";
            $update = crear_registro($conexion,$query1);
            if($update){            
              redirect('resultados.php');
            }
          } else {
            echo $query1;
            echo $query;
          }
            
        }
         // echo $query1;
          //echo $query;
    }
?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<title>Resultados.</title>

<?php require '../menus/head.php' ?>


<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

  <!--Titulo dentro del contened-->
  <section class="content-header">
      <h1>
        Adjunto de resultados.
        <small>Entraga/Adjunto de resultados de laboratorio e imagenología.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form" enctype="multipart/form-data">

      <!--------------------------
        | Your Page Content Here |
        -----primer row de imagenes--------------------->
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Resultados Laboratorio: </h3>
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
                     <!-- <button type="submit"  name="envio" id="envio" value = "" class="btn btn-info"><i class="fa fa-fw fa-pencil"></i>Guardar resultados</button>
                    --></th>
                </tr>
                <tr role="row">
                  <!--<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID
                  </th>-->
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">ID
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Paciente
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Estudio</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Folio</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Resultados</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Enviar</th>
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($resLab as $uregencia) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$uregencia["id"]." </td>";
                    echo "<td>".utf8_encode($uregencia["Paciente"])."</td>";
                    echo "<td>".utf8_encode($uregencia["Estudio"])."</td>";
                    echo "<td>".$uregencia["folio"]."</td>";
                    echo "<td>
                      <i class='fa fa-paperclip' style='padding-right: inherit;'></i> 
                       <input type='file' name='archivo' style='display: inherit; width: 301px; '>
                       </td>
                       <td>
                       <div class=\"btn-group\">
                      <button value=\"".$uregencia['id']."\" type=\"submit\" name=\"enviolab\" id=\"enviolab\" class=\"btn btn-info\"><i class=\"fa fa-paper-plane\"></i></button>
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
        <!-- /.row --> 
      </div>
      </form>
      
      <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form" enctype="multipart/form-data">

       <!----Siguiente row de resultados------------------------------------------------------------->
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Resultados Imagenología: </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row"><div class="col-sm-6"></div>
                <div class="col-sm-6"></div></div>

                <div class="row"><div class="col-sm-12">

                  <table id="example2" class="table table-bordered table-striped">
                <thead>
                   <tr>
                  <th rowspan="1" colspan="5">
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
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Folio</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Resultados</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Envio</th>
                </tr>
                </thead>
                <tbody>

                <?php
                  foreach ($resImg as $uregencia) {
                    echo "<tr role=\"row\" class=\"odd\">";
                    echo "<td class=\"sorting_2\">".$uregencia["id"]." </td>";
                    echo "<td>".utf8_encode($uregencia["Paciente"])."</td>";
                    echo "<td>".utf8_encode($uregencia["Estudio"])."</td>";
                    echo "<td>".$uregencia["folio"]."</td>";
                    echo "<td>
                      <i class='fa fa-paperclip' style='padding-right: inherit;'></i> 
                       <input type='file' name='img' style='display: inherit; width: 301px; '>
                       </td>
                       <td>
                       <div class=\"btn-group\">
                      <button value=\"".$uregencia['id']."\" type=\"submit\" name=\"envioimagen\" id=\"envioimagen\" class=\"btn btn-info\"><i class=\"fa fa-paper-plane\"></i></button>
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
        <!-- /.row --> 
      </div>

      </form>



    </section>
    <!-- /.content -->
  </div>
  
    
    <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php require '../menus/footer.php' ?>

</div>

</body>
</html>
