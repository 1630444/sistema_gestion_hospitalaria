<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'grupos');
  
  $id = $_GET['id'];
  $delete_id = borrar_registro($conexion,$id,'grupos');
  if($delete_id){
      echo   "Grupo eliminado.";
      redirect('grupo.php');
  } else {
      echo "Eliminación falló" ;
      redirect('grupo.php');
  }
?>
