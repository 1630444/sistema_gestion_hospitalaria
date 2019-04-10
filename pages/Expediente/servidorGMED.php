<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');
  $conexion=mysqli_connect('localhost', 'root','estanque98','Hospital');

	//echo json_encode($_GET)
  $id_med=$_GET['id_med'];
  $can=$_GET['can'];
  $dos=$_GET['dos'];
  $dia=$_GET['dia'];
  $hor=$_GET['hor'];

  $id_receta;
  $query="SELECT MAX(id_receta) mxx FROM receta";
  $resultados=$conn->query($query);
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $id_receta = ($fila['mxx']);
  }

  $query="SELECT count(id_receta)nuun FROM receta_lista WHERE id_receta = '$id_receta' and id_medicamento = '$id_med'";
	$resultados=$conn->query($query);
  $ifnum;
  $respuesta = array();
  while ($fila = $resultados->fetch_assoc()) {
    $ifnum = ($fila['nuun']);
  }
  
  if($can==0){
    $query="DELETE FROM receta_lista WHERE id_receta='$id_receta' and id_medicamento='$id_med'";
  
     mysqli_query($conexion,$query);
  }else if($ifnum==0){
    $query="Insert Into receta_lista (id_receta,id_medicamento,cantidad,entregada,dosis,dias,horas)
          Values($id_receta,$id_med,$can,0,$dos,$dia,$hor)";
  
     mysqli_query($conexion,$query);
  }else{
    $query="UPDATE receta_lista SET cantidad='$can', dosis='$dos', dias='$dia', horas='$hor' 
        WHERE id_receta='$id_receta' and id_medicamento='$id_med'";
  
     mysqli_query($conexion,$query);
  }
  

?>