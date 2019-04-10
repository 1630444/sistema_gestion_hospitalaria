<?php
  require '../basedatos/conexion.php';
require '../sesion/abre_sesion.php';
  if($_SESSION['tipo']!=5){
    header('Location: ../../index.php');
		exit;
  }

  $id = $_GET['id'];
  $query =  "SELECT rl.id_receta_lista as id, rl.cantidad as cantidad, m.almacen as almacen, m.id_medicamento as id_med, rl.entregada as entregada    
  FROM receta_lista rl, medicamento m 
  WHERE rl.id_medicamento = m.id_medicamento and rl.id_receta = {$id}";
  //echo $query;
  $res = selectEspecial($conexion,$query);
  $entrar = 1;
  $resta = 0;
   foreach ($res as $receta) {
      if(($receta["almacen"] - $receta["cantidad"] ) <  0){
        $resta = ($receta["almacen"] - $receta["cantidad"]) * -1;
        if($resta == $receta["cantidad"]){
          $entrar = 0;
        }else{
          $entrar = 0;
          $quitar = $receta["cantidad"] - $resta;
          $query = "update medicamento set almacen = almacen - {$quitar} where id_medicamento = {$receta["id_med"]}";
          //echo $query;
          $agregar = crear_registro($conexion,$query);
          $query = "update receta_lista set entregada = {$quitar} where id_receta_lista = {$receta["id"]}";
          //echo $query;
          $agregar = crear_registro($conexion,$query);
        }
      }else{
        $query = "update medicamento set almacen = almacen - {$receta["cantidad"]} where id_medicamento = {$receta["id_med"]}";
        //echo $query;
        $agregar = crear_registro($conexion,$query);
        $query = "update receta_lista set entregada = {$receta["cantidad"]} where id_receta_lista = {$receta["id"]}";
        //echo $query;
        $agregar = crear_registro($conexion,$query);
      }
  }

if($entrar == 1){
  
  $query = "update receta set estado = 1 where id_receta = {$id}";
  $agregar = crear_registro($conexion,$query);
}
  
redirect('receta.php');
  
?>
