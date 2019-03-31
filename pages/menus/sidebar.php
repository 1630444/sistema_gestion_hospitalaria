<?php
if(!defined('RAIZ')){
    define('RAIZ','/Web/siiupv/');
}

 ?>
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo RAIZ . 'dist/img/user2-160x160.jpg' ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Programacion web</p>
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
      <li><a href="<?php echo RAIZ. 'pages/alumno/mostrar.php'?>"><i class="fa fa-link"></i> <span>Alumnos</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/aulas/aulas.php'?>"><i class="fa fa-link"></i> <span>Aulas</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/carreras/carreras.php'?>"><i class="fa fa-link"></i> <span>Carreras</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/clases/clases.php'?>"><i class="fa fa-link"></i> <span>Clases</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/cuatrimestres/cuatrimestres.php'?>"><i class="fa fa-link"></i> <span>Cuatrimestres</span></a></li>
	    <li><a href="<?php echo RAIZ . 'pages/grupos/grupo.php' ?>"><i class="fa fa-group"></i> <span>Grupos</span></a></li>
      <li><a href="<?php echo RAIZ . 'pages/maestros/maestros.php' ?>"><i class="fa fa-link"></i> <span>Maestros</span></a></li>
      <li><a href="<?php echo RAIZ. 'pages/materias/materias.php'?>"><i class="fa fa-link"></i> <span>Materias</span></a></li>


        <!--
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
