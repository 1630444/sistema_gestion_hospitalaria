<?php
if(!defined('RAIZ')){
    define('RAIZ','/Web/siiupv/');
}
 ?>
<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right
  <div class="pull-right hidden-xs">
    Anything you want
  </div>
  -->
  <!-- Default to the left -->
  <div class="" align="center">
    <h1>Todo Derechocopia UPV SaCv</h1>
  </div>
</footer>

<!-- jQuery 3 -->
<script src="<?php echo RAIZ . 'bower_components/jquery/dist/jquery.min.js' ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo RAIZ . 'bower_components/bootstrap/dist/js/bootstrap.min.js' ?> "></script>
<!-- AdminLTE App -->
<script src="<?php echo RAIZ . 'dist/js/adminlte.min.js' ?> "></script>


<!-- DataTables -->
<script src="<?php echo RAIZ .'bower_components/datatables.net/js/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo RAIZ . 'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js' ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo RAIZ . 'bower_components/jquery-slimscroll/jquery.slimscroll.min.js' ?>"></script>
<!-- FastClick -->
<script src="<?php echo RAIZ . 'bower_components/fastclick/lib/fastclick.js' ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
