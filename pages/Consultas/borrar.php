<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'tutabla');

  $id = $_GET['id'];
  $delete_id = borrar_registro($conexion,$id,'tutabla');
  if($delete_id){
      echo   "eliminado.";
      redirect('mostrar.php');
  } else {
      echo "Eliminación falló" ;
      redirect('mostrar.php');
  }
?>
