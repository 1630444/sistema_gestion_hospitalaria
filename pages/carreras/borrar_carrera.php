<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'carreras');
  
  $id = $_GET['id'];
  $delete_id = borrar_registro($conexion,$id,'carreras');
  if($delete_id){
      echo   "Carrera eliminada.";
      redirect('carreras.php');
  } else {
      echo "Eliminación falló" ;
      redirect('carreras.php');
  }
?>
