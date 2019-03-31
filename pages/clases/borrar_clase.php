<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'clases');
  
  $id = $_GET['id'];
  $delete_id = borrar_registro($conexion,$id,'clases');
  if($delete_id){
      
      redirect('clases.php');
  } else {
      echo "Eliminación falló" ;
      redirect('clases.php');
  }
?>
