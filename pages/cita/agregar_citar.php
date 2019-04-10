<?php
 


$horas= array('8:00','8:30',
             '9:00','9:30',
              '10:00','10:30',
              '11:00','11:30',
              '12:00','12:30',
              '13:00','13:30',
              '14:00','14:30',
              '15:00','15:30',
              '16:00',
             );

 $fecha=getdate();
        
$dia=$fecha[mday];
$mes=$fecha[mon];
$anio=$fecha[year];

  require '../basedatos/conexion.php';
  require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=2){
    header('Location: ../../index.php');
		exit;
  }

	//if (!isset($_SESSION['usuario'])) {
	//$usuario="2";
  //  echo "khe flojera";
	//}else{
    //$usuario = $_SESSION['usuario'];
  //}

//$usuario = $_SESSION['usuario'];

 //$query1234= "select * from usuarios where nombre_usuario=".$usuario." LIMIT 1";
 //$res1234 = selectEspecial($conexion,$query1234);
//$ide=0;
//foreach($res1234 as $sss){
   //         $ide=$sss['id_usuario'];
  //        }

                                                      //$_SESSION['ide']
$query1234= "select * from pacientes where usuario_id=".$_SESSION['ide']." LIMIT 1";
 $res1234 = selectEspecial($conexion,$query1234);
$ide=0;
foreach($res1234 as $sss){
            $ide=$sss['id_paciente'];
          }
$id_paciente = $ide;//$_SESSION['usuario'];
    $table = 'tabla';
    $errores = '';

 $query= "select * from especialidad";
 $res = selectEspecial($conexion,$query);

if(isset($_POST['submit2'])){
  //$query= "select * from cita where fecha > (select CAST(DATE_FORMAT(NOW() ,'%Y-%m-01') as DATE)) AND fecha <LAST_DAY(NOW()) order by fecha ASC";
   $fechaz = $_POST['disponibles1'];
   $query= "select * from cita where fecha='$fechaz'";
   
  $res2 = selectEspecial($conexion,$query);
}


    if(isset($_POST['submit'])){
      //$id_paciente=1;
      $mensajeerror="";
      $fe= $_POST['date'];
        $id = $_POST['id'];
      $hora1=$_POST['disponibles1'];
        $hora2=$hora1+1;
      $query2="SELECT * FROM medico WHERE id_especialidad = 4 ORDER BY RAND() LIMIT 1";
      $agregar2 = selectEspecial($conexion,$query2);
      //validacion de horas repetidas
      $dedd=0;
      $queryX="SELECT * FROM cita WHERE fecha = \" ".$fe." \" AND hora = \" ".$horas[$hora1]."\"";
     
      $errorX = selectEspecial($conexion,$queryX);
       foreach($errorX as $elemento){
         $dedd=$elemento['id_cita'];
       }
      if($dedd!=0){
        $mensajeerror=" Este dia con esa hora ya hay una cita reservada, intente con otra fecha y hora.";
      }
      
      $dedd=0;
      $queryX="SELECT * FROM cita WHERE fecha = \" ".$fe." \" ";
     
      $errorX = selectEspecial($conexion,$queryX);
       foreach($errorX as $elemento){
         $dedd=$elemento['id_cita'];
       }
      if($dedd!=0){
        $mensajeerror=" Este dia con esa hora ya tiene una cita reservada, solo puede reservar 1 ves por día.";
      }
      
       $restX = substr($fe, -2, 2);//Dia del mes ejemplo dia 18
       $mesX = substr($fe, -5, 2);//Dia del mes ejemplo dia 18
       $anioX = substr($fe, 0, 4);//Dia del mes ejemplo dia 18
      if((int)$dia>(int)$restX|| (int) $mes>(int)$mesX ||(int)$anio>(int)$anioX){
         $mensajeerror="No puede reservar una fecha pasada, ingrese otra fecha.";
      }
      
      
        if(empty($mensajeerror)){
          
           
          foreach($agregar2 as $horario){
            $med=$horario['id_medico'];
            $query = "insert into cita (id_cita,id_paciente,fecha,hora,H,id_medico) values (0,{$id_paciente},'$fe','$horas[$hora1]',$hora2,$med)";
          
         // $agregar = crear_registro($conexion,$query);
         
          }
          
          if($agregar){
            //redirect('agregar_citar.php');
             
          }
        }
    }
 ?>
 <!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php require '../menus/head.php' ?>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <?php require '../menus/header.php' ?>
  <?php require '../menus/sidebar.php' ?>

  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content container-fluid">


        <div class="row" >
           
          <div class="col-xs-9">
            <?php
   if(isset($_POST['submit'])){
            if(empty($mensajeerror)){
            //redirect('agregar_citar.php');
            echo "<div class=\"alert alert-success alert-dismissible\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                <h4><i class=\"icon fa fa-check\"></i>Cita Guardada Correctamente!</h4>
                Su cita ha sido reservada correctamente. Presione el simbolo \"x\" de esta ventana para cerrar esta ventana.
             ".$mensajeerror." </div>";
              
              
          }else{
              echo "<div class=\"alert alert-warning alert-dismissible\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                <h4><i class=\"icon fa fa-warning\"></i> No se ha guardado la cita!</h4>
              ".  $mensajeerror." Presione el simbolo \"x\" de esta ventana para cerrar esta ventana.
              </div>";
            } }
            ?>
          <div class="box" >
            <div class="box-header">
              <h2 class="box-title">Disponibilidad</h2>
              <div class="form-group">
                <br>
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                    <label for="EXC">Buscar disponibilidad por dia:</label>
                    <div class="form-group">
                    
                     <input type="date" class="form-control"name="EXC" id="EXC" placeholder="Ingrese el ID"  required>
                     
                  </div>
                    <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="submit2">Buscar</button>
                </div>
                    </form>
                  </div>
                
            </div>
           
           
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <table id="example6" class="table table-bordered table-striped">
                <thead>
                   <tr>
                 
                </tr>
                <tr role="row">
                 <!---- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">No.</th>--->
                  <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Hora</th>
                   
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Lunes</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Martes</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Miercoles</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Jueves</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Viernes</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Sabado</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Domingo</th>
                  
                </tr>
                </thead>
                <tbody  id="repampanos" name="repampanos" >
                   
               <?php
                  if(isset($_POST['submit2'])){
                    $diaC=0;
                    $cont = 8;
                    $cont1 =3;
                    $cont2 = 0;
                   $pid=0;
                    for ($i=0; $i < 16; $i++) {
                      $pid=$pid+1;
                     // echo "<tr> <th>$i </th>";
                      // code...
                      echo " <th> {$horas[$i]}- {$horas[$i+1]} </th>";
                       
                      for ($j=1; $j < 8; $j++) {
                        $diaC=$diaC+1;
                        // code...
                        foreach ($res2 as $horario) {
                          //print($horario["fecha"]);
                          $timestamp = strtotime($horario["fecha"]);
                          $day = date('D', $timestamp);
                          $dayN = date('w', $timestamp);
                          //var_dump($day);
                         // var_dump($dayN);
                          $rest = substr($horario["fecha"], -2, 2);//Dia del mes ejemplo dia 18
                        //  $mes = substr($horario["fecha"], -5, 2);//Dia del mes ejemplo dia 18
                         // $anio = substr($horario["fecha"], 0, 4);//Dia del mes ejemplo dia 18
                           //var_dump($rest);
                          //print($rest."<br>");
                         // print($diaC."<br>");
                        
                          if($diaC==$rest){
                             
                          }
                          if( $pid==$horario["H"]){
                          //   print($horario["H"]);
                            
                          }
                          
                           if( $day=="Mon"  &&  $dayN==$j    &&  $pid==$horario["H"] ) {
                              echo "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                              $cont2 = 1; 
                              break;
                          }
                          
                           if( $day=="Thu"  &&  $dayN==$j    &&  $pid==$horario["H"] ) {
                              echo "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                              $cont2 = 1; 
                              break;
                          }
                          
                           if( $day=="Wed"  &&  $dayN==$j    &&  $pid==$horario["H"] ) {
                              echo "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                              $cont2 = 1; 
                              break;
                          }
                          
                           if( $day=="Thu"  &&  $dayN==$j    &&  $pid==$horario["H"] ) {
                              echo "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                              $cont2 = 1; 
                              break;
                          }
                           
                        
                          if( $day=="Fri"  &&  $dayN==$j    &&  $pid==$horario["H"] ) {
                              echo "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                             
                              $cont2 = 1; 
                              break;
                          }
                        }
                        if($cont2 == 0){
                          echo "<td></td>";
                        }else{
                          $cont2 = 0;
                        }

                      }
                      echo "</tr>";
                    }
                  }
                 ?>

 
              </tbody>
                <tfoot>
                <!--<tr><th rowspan="1" colspan="1">Rendering engine</th><th rowspan="1" colspan="1">Browser</th><th rowspan="1" colspan="1">Platform(s)</th><th rowspan="1" colspan="1">Engine version</th><th rowspan="1" colspan="1">CSS grade</th></tr>-->
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col -->
      </div>
        <div class="col-xs-3">
          <div class="box" >
            <div class="box-header">
              <h2 class="box-title">Reservas de Cita</h2>
              
              <?php
              //echo $query;
              ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body" align="">
              <!-- form start -->
              <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
                <div class="box-body">
                  
                  
                  <div class="form-group">
                    <label for="date">Fecha</label>
                     <input type="date" class="form-control" id="date"  name="date" placeholder="Ingrese el ID" required>
                     
                  </div>
                  <div class="form-group">
                    <label for="disponibles1">Hora</label>
                    <select type="text" class="form-control" name="disponibles1" id="disponibles1" placeholder="Ingrese el ID" required>
                    <!--  <option value="0">Seleccionar</option>-->
                       <?php
                        for ($i=0; $i < 16; $i++){
                          echo "<option value=\"$i\">{$horas[$i]}- {$horas[$i+1]}</option> ";
                         
                        }
                      ?>
                    </select>
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Guardar</button>
                </div>
              </form>
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
