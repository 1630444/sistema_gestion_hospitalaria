<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');
  $conexion=mysqli_connect('localhost', 'root','estanque98','Hospital');

	//echo json_encode($_GET)
	$id_cita=$_GET['id_cita'];
  $fecha=$_GET['fecha'];
  $tipo=$_GET['tipo'];
  
  $query="Select id_paciente From cita Where id_cita = '$id_cita'";
  $id_paciente;
  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $id_paciente=$fila['id_paciente'];
  }

  $query="Select COUNT(id_paciente)nsn From interconsulta Where id_cita = '$id_cita' and id_paciente='$id_paciente'";
  $cont;
  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $cont=$fila['nsn'];
  }

  if($cont==0){
    $query="Insert Into interconsulta (id_cita,id_paciente)
          values($id_cita,$id_paciente)";

	  mysqli_query($conexion,$query);
  }

  $query = "Insert Into cita_estudio (id_interconsulta,id_estudio,fecha,img,folio)
            values ((Select MAX(id_interconsulta) from interconsulta),$tipo,'$fecha',0,0)";

  mysqli_query($conexion,$query);
  
  $query="Select Max(id_cita_estudio) ice From cita_estudio";
  $id_c_e;
  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $id_c_e=$fila['ice'];
  }

  $query="Select DATE_FORMAT(fecha,'%Y-%m-%d') fecha From cita_estudio Where id_cita_estudio = (Select MAX(id_cita_estudio) From cita_estudio)";
  $pife;
  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $pife=$fila['fecha'];
  }
  
  $folio = $pife . $tipo . $id_c_e;
  $query = "Update cita_estudio Set folio='$folio' Where id_cita_estudio = '$id_c_e'";

  mysqli_query($conexion,$query);
  //echo json_encode($query);

	//$respuesta = array('query'=> $query);
?>