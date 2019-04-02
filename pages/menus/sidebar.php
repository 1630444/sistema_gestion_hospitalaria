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
        <img src="<?php echo RAIZ . 'dist/img/yo.jpg' ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Hospital</p>
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
      <!-- Optionally, you can add icons to the links -->
      <li><a href="<?php echo RAIZ. 'pages/pacientes/pacientes.php'?>"><i class="fa fa-link"></i> <span>Pacientes</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/Consultas/mostrar.php'?>"><i class="fa fa-link"></i> <span>Consultas</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/camas/camas.php'?>"><i class="fa fa-link"></i> <span>Camas</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/urgencias/urgencias.php'?>"><i class="fa fa-link"></i> <span>Urgencias</span></a></li>     
      <li><a href="<?php echo RAIZ. 'pages/receta/receta.php'?>"><i class="fa fa-link"></i> <span>Receta</span></a></li>
	    <li class="treeview" ><a href="#"><i class="fa fa-flask"></i> <span>Laboratorio e Imagenología</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i></span></a>
      <ul class = "treeview-menu">
      
	    <li><a href="<?php echo RAIZ. 'pages/laboratorioeimg/laboratorio.php' ?>"><i class="fa fa-flask"></i> <span>Laboratorio clinico</span></a></li>
	    <li><a href="<?php echo RAIZ. 'pages/laboratorioeimg/imagenologia.php' ?>"><i class="fa fa-file-image-o"></i> <span>Imagenología</span></a></li>
	    <li><a href="<?php echo RAIZ. 'pages/laboratorioeimg/resultados.php' ?>"><i class="fa fa-book"></i> <span>Resultados</span></a></li>
      </ul>
      </li>
      <li><a href="<?php echo RAIZ. 'pages/medicamento/medicamento.php'?>"><i class="fa fa-link"></i> <span>Medicamento</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/nota_evolucion/nota_evolucion.php'?>"><i class="fa fa-link"></i> <span>Nota de evolución (temporal)</span></a></li>
      

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
