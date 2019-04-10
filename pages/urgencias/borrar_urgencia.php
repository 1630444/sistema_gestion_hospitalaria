<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'urgencias');
  
  $id = $_GET['id'];
  $delete_id = crear_registro($conexion,"DELETE FROM urgencias WHERE id_urgencia = {$id}");
  if($delete_id){
      echo   "Urgencia eliminada.";
      redirect('urgencias.php');
  } else {
      echo "Eliminación falló" ;
      redirect('urgencias.php');
  }
?>
