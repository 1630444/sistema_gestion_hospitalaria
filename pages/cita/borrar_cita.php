<?php
  require '../basedatos/conexion.php';
  $res= select($conexion,'cita');

  $id = $_GET['id'];


      $query = "update cita SET estado=-1 WHERE id_cita={$id}";
        $actualizar = crear_registro($conexion,$query);
        if($actualizar){
          redirect('ver_citar.php');
        }


 
?>
