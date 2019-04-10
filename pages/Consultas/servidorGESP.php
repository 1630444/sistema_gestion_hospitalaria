<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');
  $conexion=mysqli_connect('localhost', 'root','estanque98','Hospital');

	//echo json_encode($_GET)
	$id_cita=$_GET['id_cita'];
  $fecha=$_GET['fecha'];
  $hora=$_GET['hora'];
  $tipo=$_GET['tipo'];
  
  $query="Select id_paciente From cita Where id_cita = '$id_cita'";
  $id_paciente;
  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $id_paciente=$fila['id_paciente'];
  }

  $query="Select MAX(id_medico) id_medico From medico Where id_especialidad = $tipo";
  $id_medico;
  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $id_medico=$fila['id_medico'];
  }

  $query="Insert Into cita (id_paciente,id_medico,fecha,hora,H)
          values ($id_paciente,$id_medico,'$fecha','$hora',0)";

  mysqli_query($conexion,$query);
?>