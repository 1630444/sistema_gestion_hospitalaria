<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');

	//echo json_encode($_GET)
	$nomEstado=$_GET['nomEstado'];
	$query="SELECT observaciones, resultados 
  FROM cita_estudio C, laboratorio L 
  WHERE C.id_cita_estudio = L.id_cita_estudio and C.id_cita_estudio = '$nomEstado'";

	try{
		$resultados=$conn->query($query);
		$respuesta = array();
		while ($fila = $resultados->fetch_assoc()) {
			$respuesta[]=array(
				'observaciones'=>utf8_encode($fila['observaciones']),
				'resultados'=>$fila['resultados']
			);
		}
	}catch(Exception $e){
		$respuesta = array('error'=> $e.getMessage);
	}

	//$respuesta = array('query'=> $query);

	echo json_encode($respuesta);
?>