<?php
  require '../basedatos/conexion.php';
  
  $id = $_GET['id'];
  $query = "DELETE FROM usuarios WHERE id_usuario = '{$id}';";
  $delete_id = crear_registro($conexion,$query);
  if($delete_id){
      echo   "Cliente eliminado.";
      unlink($nombre);
      redirect('empleados.php');
  } else {
      echo "Eliminación falló" ;
      redirect('empleados.php');
  }
?>
