<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'urgencias');
  
  $id = $_GET['id'];
  $delete_id = borrar_registro($conexion,$id,'urgencias','id_urgencia');
  if($delete_id){
      echo   "Urgencia eliminada.";
      redirect('urgencias.php');
  } else {
      echo "Eliminación falló" ;
      redirect('urgencias.php');
  }
?>
