<?php
    require '../basedatos/conexion.php';

    $tipo = $_GET['tipo'];
    $tabla=$_GET['tabla'];



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
    }

?>