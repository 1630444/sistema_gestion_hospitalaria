<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');
  $conexion=mysqli_connect('localhost', 'root','estanque98','Hospital');

	//echo json_encode($_GET)
	$nomEstado=$_GET['nomEstado'];
  $info=($_GET['info']);
  $vit=($_GET['vit']);
  $motT=($_GET['motT']);

  $info=$_GET['info'];
	$query="Update expediente
          Set bitacora='$info', signos_vitales='$vit', motivo_atencion='$motT'
          WHERE id_expediente = '$nomEstado'";

	mysqli_query($conexion,$query);

	//$respuesta = array('query'=> $query);
?>