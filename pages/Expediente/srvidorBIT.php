<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');
  $conexion=mysqli_connect('localhost', 'root','estanque98','Hospital');

	//echo json_encode($_GET)
	$id_cita=$_GET['id_cita'];

  $id_paciente;
	$query="SELECT id_paciente FROM cita WHERE id_cita = '$id_cita'";
  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
      $id_paciente = $fila['id_paciente'];
  }

  $numi;
  $query="Select count(id_paciente) nnma From expediente Where id_paciente='$id_paciente' and id_cita='$id_cita'";
	$resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
      $numi = $fila['nnma'];
  }
  if($numi==0){
    $date = getdate();
    $fecha = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"];
    $hora = $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"];
    $query="Insert Into expediente (fecha_registro,hora_registro,id_cita,id_paciente,bitacora,motivo_atencion,signos_vitales)
            values ('$fecha','$hora','$id_cita','$id_paciente','->','->','->')";

    mysqli_query($conexion,$query);
  }
?>