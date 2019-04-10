<?php
  require '../basedatos/conexion.php';
  
  $id = $_GET['id'];
  $query = "DELETE FROM `medico` WHERE id_usuario = '{$id}';";
  $delete_id = crear_registro($conexion,$query);
  $query = "DELETE FROM usuarios WHERE id_usuario = '{$id}';";
  $delete_id2 = crear_registro($conexion,$query);
  if($delete_id && $delete_i2){
      echo   "Medico eliminado.";
      unlink($nombre);
      redirect('medicos.php');
  } else {
      echo "Eliminación falló" ;
      redirect('medicos.php');
  }
?>
