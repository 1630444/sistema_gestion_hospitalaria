<?php
if(!defined('RAIZ')){
    define('RAIZ','/hospital/');
}

 ?>
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo RAIZ . 'dist/img/profile.ico' ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo utf8_encode($_SESSION["nombre"].' '.$_SESSION["apellido"]); ?></p>
        <!-- Status
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        -->
      </div>
    </div>

    <!-- search form (Optional) -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- Sidebar Menu -->

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu opciones</li>
      
      <?php 
      switch($_SESSION["tipo"]){
        case 1: // Administrador
          echo '<li><a href="'.RAIZ.'pages/pacientes/pacientes.php"><i class="fa fa-heartbeat"></i> <span>Pacientes</span></a></li>';
          echo '<li><a href="'.RAIZ.'pages/medicos/medicos.php"><i class="fa fa-user-md"></i> <span>Medicos</span></a></li>';
          echo '<li><a href="'.RAIZ.'pages/empleados/empleados.php"><i class="fa fa-user"></i> <span>Otros empleados</span></a></li>';
          break;
        case 2: // Paciente
          echo '<li><a href="'.RAIZ.'pages/cita/agregar_citar.php"><i class="fa fa-calendar"></i> <span>Crear Cita General</span></a></li>';
          echo '<li><a href="'.RAIZ.'pages/cita/ver_citar.php"><i class="fa fa-calendar"></i> <span>Ver Citas</span></a></li>';
          break;
        case 3: // Medico
          echo '<li><a href="'.RAIZ.'pages/Consultas/mostrar.php"><i class="fa fa-stethoscope"></i> <span>Consultas</span></a></li>';
          echo '<li><a href="'.RAIZ.'pages/camas/camas.php"><i class="fa fa-bed"></i> <span>Camas</span></a></li>';
          echo '<li><a href="'.RAIZ.'pages/urgencias/urgencias.php"><i class="fa fa-ambulance"></i> <span>Urgencias</span></a></li>';
          echo '<li><a href="'.RAIZ.'pages/hospitalizaciones/hospitalizaciones.php"><i class="fa fa-h-square"></i> <span>Hospitalizaciones</span></a></li>';
          
          if ($_SESSION["especialidad"]==9 || $_SESSION["especialidad"]==10) {
          echo '<li class="treeview" ><a href="#"><i class="fa fa-flask"></i> <span>Laboratorio e Imagenología</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span></a><ul class = "treeview-menu">';
          echo '<li><a href="'.RAIZ.'pages/laboratorioeimg/laboratorio.php"><i class="fa fa-flask"></i> <span>Laboratorio clinico</span></a></li>';
          echo '<li><a href="'.RAIZ.'pages/laboratorioeimg/imagenologia.php"><i class="fa fa-file-image-o"></i> <span>Imagenología</span></a></li>';
          echo '<li><a href="'.RAIZ.'pages/laboratorioeimg/resultados.php"><i class="fa fa-book"></i> <span>Resultados</span></a></li>';
          echo '</ul></li>';
          }
          break;
        case 4: // Expediente
          echo '<li><a href="'.RAIZ.'pages/Expediente/expediente.php"><i class="fa fa-list-alt"></i> <span>Expediente</span></a></li>';
          break;
        case 5: // Farmacologo
          echo '<li><a href="'.RAIZ.'pages/receta/receta.php"><i class="fa fa-list-alt"></i> <span>Receta</span></a></li>';
          echo '<li><a href="'.RAIZ.'pages/medicamento/medicamento.php"><i class="fa fa-medkit"></i> <span>Medicamento</span></a></li>';
          break;
      }
      ?>   
    

        <!--
<li><a href="<?php echo RAIZ. 'pages/alumno/mostrar.php'?>"><i class="fa fa-link"></i> <span>Alumnos</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/aulas/aulas.php'?>"><i class="fa fa-link"></i> <span>Aulas</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/carreras/carreras.php'?>"><i class="fa fa-link"></i> <span>Carreras</span></a></li>
      
      <li><a href="<?php echo RAIZ. 'pages/maestros/maestros.php' ?>"><i class="fa fa-link"></i> <span>Maestros</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/materias/materias.php'?>"><i class="fa fa-link"></i> <span>Materias</span></a></li>
      
	    <li><a href="<?php echo RAIZ. 'pages/laboratorioeimg/laboratorio.php' ?>"><i class="fa fa-flask"></i> <span>Laboratorio e Imagenología</span></a></li>

          <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
        
        <ul class="treeview-menu">
          <li><a href="#">Link in level 2</a></li>
          <li><a href="#">Link in level 2</a></li>
        </ul>
      -->
      </li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
