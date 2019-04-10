<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');
  $conexion=mysqli_connect('localhost', 'root','estanque98','Hospital');
  
  $id_cita=$_GET['id_cita'];
  
  $query="SELECT count(id_receta) nmm FROM receta WHERE id_cita = '$id_cita'";
	$resultados=$conn->query($query);
  $id_receta;
  $respuesta = array();
		while ($fila = $resultados->fetch_assoc()) {
			$id_receta = ($fila['nmm']);
		}

  if($id_receta==0){
    $query="Insert Into receta (id_cita,estado)
          Values($id_cita,0)";

	  mysqli_query($conexion,$query);
  }else{
    
  }  
?>