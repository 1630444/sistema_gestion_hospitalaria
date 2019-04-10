<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');

	//echo json_encode($_GET)
	$nomEstado=$_GET['nomEstado'];
	$query="SELECT nombre,id_medicamento
            FROM medicamento WHERE id_medicamento = '$nomEstado'";


	try{
		$resultados=$conn->query($query);
		$respuesta = array();
		while ($fila = $resultados->fetch_assoc()) {
			$respuesta[]=array(
				'nombre'=>$fila['nombre'],
        'id'=>$fila['id_medicamento']
			);
		}
	}catch(Exception $e){
		$respuesta = array('error'=> $e.getMessage);
	}

	//$respuesta = array('query'=> $query);

	echo json_encode($respuesta);
?>