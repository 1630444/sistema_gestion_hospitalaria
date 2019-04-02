<?php
  require '../basedatos/conexion.php';

  $id = $_GET['id'];
  $query = "select * from medicamento where id_medicamento = '{$id}';";
  $medicamento = selectEspecial($conexion,$query);
  $nombre = '';
  if($medicamento){
    foreach ($medicamento as $dato) {
      $nombre = $dato["imagen"];
    }
  }
  echo $nombre;
  $query = "delete from medicamento where id_medicamento = '{$id}';";
  $delete_id = crear_registro($conexion,$query);
  if($delete_id){
      echo   "Cliente eliminado.";
      unlink($nombre);
      redirect('medicamento.php');
  } else {
      echo "Eliminación falló" ;
      redirect('medicamento.php');
  }
?>
