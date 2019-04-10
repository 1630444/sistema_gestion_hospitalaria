<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');

	//echo json_encode($_GET)
	//$nomEstado=$_GET['nomEstado'];
	$query="SELECT id_especialidad,nombre FROM especialidad";

  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $respuesta[]=array(
      'id'=>utf8_encode($fila['id_especialidad']),
      'nombre'=>utf8_encode($fila['nombre'])
    );
  }

	//$respuesta = array('query'=> $query);

	echo json_encode($respuesta);
?>