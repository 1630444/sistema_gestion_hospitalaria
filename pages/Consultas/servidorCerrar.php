<?php
	$conn = new mysqli('localhost','root','estanque98','Hospital');
  $conexion=mysqli_connect('localhost', 'root','estanque98','Hospital');

  $id_cita=($_GET['id_cita']);

  $query="Update cita set estado=1 Where id_cita = $id_cita";

  mysqli_query($conexion,$query);
?>