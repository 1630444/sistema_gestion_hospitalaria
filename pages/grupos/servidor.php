<?php
    require 'bd.php';

    //echo json_encode($_POST);
    $nomEstado=$_GET['id_carrera'];
   // $query="SELECT m.id, m.nombre 
    //        FROM prestamos e inner join alumnos m on e.alumno_id=m.id 
    //        WHERE UPPER(m.nombre) = UPPER('$nomEstado')";
    $query="SELECT pl.id,pl.clave FROM planes_estudio pl WHERE pl.id_carrera = ('$nomEstado')";


    try{
        $resultados=$conn->query($query);
        $respuesta=array();
        while($fila = $resultados->fetch_assoc()){
            $respuesta[]=array(
                'id'=>$fila['id'],
                'nombre'=>$fila['clave'],
                'query' =>$query
            );
        }
    }catch(Exception $e){
        $respuesta = array('error' => $e.getMessage);
    }

    echo json_encode($respuesta);
?>