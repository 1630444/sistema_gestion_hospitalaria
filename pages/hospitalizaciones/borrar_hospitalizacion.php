<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'hospitalizacion');


  $id = $_GET['id_hospitalizacion'];
  $delete_id = borrar_registro($conexion,$id,'hospitalizacion');
  $eliminar = "DELETE FROM hospitalizacion WHERE id_hospitalizacion = ". $id . ";";
  $delete_id = mysqli_query($conexion,$eliminar) or die('Error al ejecutar la consulta');
 
  if($delete_id){
      echo   "Hospitalización eliminada.";
      redirect('hospitalizaciones.php');
  } else {
      echo "Eliminación falló" ;
      redirect('hospitalizaciones.php');
  }
?>
