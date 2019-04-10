<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');

	//echo json_encode($_GET)
	$nomEstado=$_GET['nomEstado'];
	$query="SELECT bitacora,motivo_atencion, DATE_FORMAT(fecha_registro,'%Y-%c-%e') fecha_registro, signos_vitales 
            FROM expediente WHERE id_expediente = '$nomEstado'";

	try{
		$resultados=$conn->query($query);
		$respuesta = array();
		while ($fila = $resultados->fetch_assoc()) {
			$respuesta[]=array(
				'fecha'=>$fila['fecha_registro'],
				'motivo'=>$fila['motivo_atencion'],
        'bitacora'=>$fila['bitacora'],
        'vital'=>$fila['signos_vitales']
			);
		}
	}catch(Exception $e){
		$respuesta = array('error'=> $e.getMessage);
	}

	//$respuesta = array('query'=> $query);

	echo json_encode($respuesta);
?>