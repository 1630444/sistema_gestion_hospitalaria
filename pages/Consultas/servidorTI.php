<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');

	//echo json_encode($_GET)
	//$nomEstado=$_GET['nomEstado'];
	$query="SELECT tipo,id_estudio FROM estudio";

  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $respuesta[]=array(
      'tipo'=>utf8_encode($fila['tipo']),
      'id'=>utf8_encode($fila['id_estudio'])
    );
  }

	//$respuesta = array('query'=> $query);

	echo json_encode($respuesta);
?>