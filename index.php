<?php
  require 'pages/sesion/abre_sesion.php';
  switch($_SESSION["tipo"]){
    case 1:
      header('Location: pages/dashboard/dash_admin.php');
    break;
    case 2:
      header('Location: pages/dashboard/dash_paciente.php');
    break;
    case 3:
      header('Location: pages/dashboard/dash_medico.php');
    break;
    case 4:
      header('Location: pages/dashboard/dash_empleado.php');
    break;
    case 5:
      header('Location: pages/dashboard/dash_empleado.php');
    break;
  }
 ?>
