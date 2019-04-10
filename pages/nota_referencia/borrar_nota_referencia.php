<?php
  require '../basedatos/conexion.php';
  
  $id = $_GET['id'];  
  $cita = $_GET['cita'];

  $query = "delete from nota_evolucion where id_nota_evolucion = '{$id}'";
  //echo $query . '<br>'; 
  $delete_id = selectEspecial($conexion,$query);
  
  redirect("nota_evolucion.php?id={$cita}");
  
  
?>
