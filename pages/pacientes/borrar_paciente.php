<?php
  require '../basedatos/conexion.php';
  
  $id = $_GET['id'];
  $delete_id = borrar_registro($conexion,$id,'usuarios');
  if($delete_id){
      echo   "Eliminado.";
      redirect('pacientes.php');
  } else {
      echo "Eliminación falló" ;
      redirect('pacientes.php');
  }
?>
