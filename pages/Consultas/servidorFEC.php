<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');

	//echo json_encode($_GET)
	$fecha=$_GET['fecha'];
  $tabla=$_GET['tabla'];
	$query="SELECT COUNT(fecha) numm FROM $tabla WHERE DATE_FORMAT(fecha,'%Y-%c-%e') = '$fecha'";

		$resultados=$conn->query($query);
		$respuesta = array();
		while ($fila = $resultados->fetch_assoc()) {
			$respuesta[]=array(
				'nums'=>$fila['numm']
			);
		}

	//$respuesta = array('query'=> $query);

	echo json_encode($respuesta);/**/
  //echo json_encode($query);
?>