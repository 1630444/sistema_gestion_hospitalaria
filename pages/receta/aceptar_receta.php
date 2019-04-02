<?php
  require '../basedatos/conexion.php';
  $id = $_GET['id'];
  $query =  "SELECT rl.id_receta_lista as id, rl.cantidad as cantidad, m.almacen as almacen, m.id_medicamento as id_med    
  FROM receta_lista rl, medicamento m 
  WHERE rl.id_medicamento = m.id_medicamento and rl.id_receta = {$id}";
  echo $query;
  $res = selectEspecial($conexion,$query);
  $entrar = 1;
   foreach ($res as $receta) {
      if(($receta["almacen"] - $receta["cantidad"] ) <  0){
        $entrar = 0;
        break;
      }
  }

if($entrar == 1){
  foreach ($res as $receta) {
      $query = "update medicamento set almacen = almacen - {$receta["cantidad"]} where id_medicamento = {$receta["id_med"]}";
      echo $query;
      $agregar = crear_registro($conexion,$query);
  }
  $query = "update receta set estado = 1 where id_receta = {$id}";
  $agregar = crear_registro($conexion,$query);
}
  
redirect('receta.php');
  
?>
