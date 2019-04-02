<?php
  require '../basedatos/conexion.php';
  
  $id = $_GET['id'];  
  $query = "delete from nota_evolucion where id_nota_evolucion = '{$id}'";
  echo $query . '<br>'; 
  $delete_id = selectEspecial($conexion,$query);
  if($delete_id){      
      redirect('nota_evolucion.php');
  } else {      
      redirect('nota_evolucion.php');
  }
?>
