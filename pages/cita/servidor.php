<?php
    require '../basedatos/conexion.php';

    $tipo = $_GET['tipo'];
    $tabla=$_GET['tabla'];


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



if(tipo=='999'){
  $respuesta="";
    	$fecha = $_GET['id_carrera'];//fecha
       
   $query= "select * from cita where fecha='$fecha '";
   
  $res2 = selectEspecial($conexion,$query);
    $diaC=0;
                    $cont = 8;
                    $cont1 =3;
                    $cont2 = 0;
                   $pid=0;
                    for ($i=0; $i < 16; $i++) {
                      $pid=$pid+1;
                     // echo "<tr> <th>$i </th>";
                      // code...
                      $respuesta+= " <th> {$horas[$i]}- {$horas[$i+1]} </th>";
                       
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
                              $respuesta+= "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                              $cont2 = 1; 
                              break;
                          }
                          
                           if( $day=="Thu"  &&  $dayN==$j    &&  $pid==$horario["H"] ) {
                              $respuesta+= "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                              $cont2 = 1; 
                              break;
                          }
                          
                           if( $day=="Wed"  &&  $dayN==$j    &&  $pid==$horario["H"] ) {
                              $respuesta+= "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                              $cont2 = 1; 
                              break;
                          }
                          
                           if( $day=="Thu"  &&  $dayN==$j    &&  $pid==$horario["H"] ) {
                              $respuesta+= "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                              $cont2 = 1; 
                              break;
                          }
                           
                        
                          if( $day=="Fri"  &&  $dayN==$j    &&  $pid==$horario["H"] ) {
                              $respuesta+= "<td class=\"callout callout-danger\"> OCUPADO {$horario["fecha"]}</td>";
                             
                              $cont2 = 1; 
                              break;
                          }
                        }
                        if($cont2 == 0){
                          $respuesta+= "<td></td>";
                        }else{
                          $cont2 = 0;
                        }

                      }
                      $respuesta+= "</tr>";
                    }
  
     

	    echo json_encode($respuesta);
}






    if ($tipo == '1') {

    	$id_carrera=$_GET['id_carrera'];    	 

    	$query = "select id, clave from {$tabla} where id_carrera = '$id_carrera'";    	    
	    $resultados = selectEspecial($conexion,$query);
	    $respuesta=array();
	    while($fila = $resultados->fetch_assoc()){
	        $respuesta[]=array(
	            'id'=>$fila['id'],
	            'clave'=>$fila['clave']
	        );
	    }    

	    echo json_encode($respuesta);
    } else if($tipo == '2') {
    	$id_plan = $_GET['id_plan'];
    	$id_carrera = $_GET['id_carrera'];

    	$query = "select m.id, m.nombre from materias m inner join planes_con_materias p on m.id = p.id_materia where id_plan = '$id_plan' and id_carrera = '$id_carrera'";  
	    $resultados = selectEspecial($conexion,$query);
	    $respuesta=array();
	    while($fila = $resultados->fetch_assoc()){
	        $respuesta[]=array(
	            'id'=>$fila['id'],
	            'nombre'=>$fila['nombre']
	        );
	    }    

	    echo json_encode($respuesta);

    } else if($tipo == '3') {
    	$id_plan = $_GET['id_plan'];
    	$id_carrera = $_GET['id_carrera'];
    	$query = "select * from maestros where id_carrera= $id_carrera";
    	$resultados = selectEspecial($conexion,$query);
    	$respuesta2="";
    	echo "$respuesta2";
    	  
        foreach ($resultados as $fila) {
	        $respuesta2=$fila['numero_empleado'];
	    }
    	$query = "select id,nombre from vwmaestros where numero_empleado = $respuesta2  ";  
	    $resultados = selectEspecial($conexion,$query);
	    $respuesta=array();
	    while($fila = $resultados->fetch_assoc()){
	        $respuesta[]=array(
	            'id'=>$fila['id'],
	            'nombre'=>$fila['nombre']
	        );
	    }    

	    echo json_encode($respuesta);
    } else if($tipo == '4') {
    	
    	$id_carrera=$_GET['id_carrera'];    	 

    	$query = "select id, clave from {$tabla} where id_grupo = '$id_carrera'";    	    
	    $resultados = selectEspecial($conexion,$query);
	    $respuesta=array();
	    while($fila = $resultados->fetch_assoc()){
	        $respuesta[]=array(
	            'id'=>$fila['id'],
	            'clave'=>$fila['clave']
	        );
	    }    

	    echo json_encode($respuesta);
    }else if($tipo == '9') {
      $id_carrera=$_GET['id_carrera'];  //IDE AULA   
      

    	$query = "select c.clave as clave ,m.nombre as materia , h.dia as dia ,h.hora_inicio as inicio ,h.hora_fin as fin   from horarios h,clases c , materias m where h.id_clase=c.id AND c.id_materia=m.id AND h.id_aula  = ".$id_carrera;    	  
       
      
      
       //$query = "select c.clave as clave ,m.nombre as materia ,a.nombre as aula ,h.dia as dia ,h.hora_inicio as inicio ,h.hora_fin as fin  from clases c , horarios h ,materias m, aulas a  where h.id_clase = c.id and c.id_materia = m.id and h.id_aula ={$id_carrera}  ";
      
	    $res = selectEspecial($conexion,$query);
	    $respuesta="";
	     
                    $cont = 7;
                    $cont1 = 8;
                    $cont2 = 0;
                    for ($i=0; $i < 14; $i++) {
                      // code...
                      $respuesta=$respuesta. "<tr> <th> {$cont}:00 - {$cont1}: 00 </th>";
                      $cont +=1;
                      $cont1 +=1;
                      for ($j=0; $j < 5; $j++) {
                        
                        // code...
                        if($res){
                          foreach ($res as $horario) {
                            if(($horario["dia"]-1) == $j && ($horario["inicio"]) == $i+7){
                                $respuesta=$respuesta. "<td>  {$horario["materia"]}  </td>";
                                $cont2 = 1;
                                break;
                            }
                          }
                        }

                        if($cont2 == 0){
                          $respuesta =$respuesta. "<td> </td>";
                        }else{
                          $cont2 = 0;
                        }

                      }
                      $respuesta =$respuesta. "</tr>";
                    } 
	    echo json_encode($respuesta);
      
    }else if($tipo == '5') {
    	
    	$id_carrera=$_GET['id_carrera'];    	 
    	//$query = "select c.clave as clave ,m.nombre as materia ,a.nombre as aula ,h.dia as dia ,h.hora_inicio as inicio ,h.hora_fin as fin from clases c , horarios h ,materias m, aulas a   where h.id_clase = c.id and c.id_materia = m.id and h.id_aula = $id_carrera ";

    	$query = "select * from horarios where id_aula = '$id_carrera'";    	    
	    $res = selectEspecial($conexion,$query);
	    $respuesta="";
	    $cont = 7;
                    $cont1 = 8;
                    $cont2 = 0;
                    for ($i=0; $i < 14; $i++) {
                      // code...
                      $respuesta+= "<tr> <th> {$cont}:00 - {$cont1}: 00 </th>";
                      $cont +=1;
                      $cont1 +=1;
                      for ($j=0; $j < 5; $j++) {
                        // code...
                        foreach ($res as $horario) {
                          if(($horario["dia"]-1) == $j && ($horario["hora_inicio"]) == $i+7){
                             // $respuesta+= "<td> {$horario["materia"]} {$horario["aula"]}</td>";
                          	$respuesta+= "<td>OCUPADO</td>";
                              $cont2 = 1;
                              break;
                          }
                        }
                        if($cont2 == 0){
                          $respuesta+= "<td> </td>";
                        }else{
                          $cont2 = 0;
                        }

                      }
                      $respuesta+= "</tr>";
                    } 

	    echo json_encode($respuesta);
    }

?>