<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'aulas');
  define('RAIZ','../../');
  $id = $_GET['id'];
  $delete_id = borrar_registro($conexion,$id,'aulas');
  if($delete_id){
      echo   "Aula eliminada.";
      redirect('aulas.php');
  } else {
      echo "Eliminación falló" ;
      redirect('aulas.php');
  }
?>
