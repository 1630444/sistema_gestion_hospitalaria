<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'cama');
  
  $id = $_GET['id'];
  $delete_id = borrar_registro2($conexion,$id,'cama','id_cama');
  if($delete_id){
      echo   "Cama eliminada.";
      redirect('camas.php');
  } else {
      echo "Eliminación falló" ;
      redirect('camas.php');
  }
?>
