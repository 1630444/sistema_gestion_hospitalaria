<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');

	//echo json_encode($_GET)
	$hrs=$_GET['hrs'];
  $fecha=$_GET['fecha'];
	$query="SELECT COUNT(id_cita_estudio) nss FROM cita_estudio WHERE DATE_FORMAT(fecha,'%H:%i') = '$hrs' and DATE_FORMAT(fecha,'%Y-%c-%e') = '$fecha'";

  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $respuesta[]=array(
      'nin'=>utf8_encode($fila['nss'])
    );
  }

	//$respuesta = array('query'=> $query);

	echo json_encode($respuesta);
?>