<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'cama');
  
  $id = $_GET['id'];

  

  $delete_id = crear_registro($conexion,"DELETE FROM cama WHERE id_cama = {$id} and estado = 0");
  if($delete_id){
      echo   "Cama eliminada.";
      redirect('camas.php');
  } else {
      echo "Eliminación falló" ;
      redirect('camas.php');
  }
?>
