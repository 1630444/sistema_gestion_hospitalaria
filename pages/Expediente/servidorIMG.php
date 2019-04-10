<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');

	//echo json_encode($_GET)
	$nomEstado=$_GET['nomEstado'];
	$query="SELECT imagen FROM imageneologia WHERE id_cita_estudio = '$nomEstado'";

	try{
		$resultados=$conn->query($query);
		$respuesta = array();
		while ($fila = $resultados->fetch_assoc()) {
			$respuesta[]=array(
				'imagen'=>utf8_encode($fila['imagen'])
			);
		}
	}catch(Exception $e){
		$respuesta = array('error'=> $e.getMessage);
	}

	//$respuesta = array('query'=> $query);

	echo json_encode($respuesta);
?>