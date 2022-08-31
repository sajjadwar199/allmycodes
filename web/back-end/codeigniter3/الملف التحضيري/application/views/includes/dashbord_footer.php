<!-- Small boxes (Stat box) -->
<div class="row">

  <!-- /.card -->
  </section>
  <!-- right col -->
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy;  <?php echo  date("Y") ;    ?> <a href="http://adminlte.io">allwebsites</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- jQuery UI 1.11.4 -->

<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 rtl -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>assets/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/jqvmap/maps/jquery.vmap.world.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>dist/js/demo.js"></script>
<!-- DataTables -->
  <script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/datatables/jquery.dataTables.js"></script>
   <script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>

 
<!-- SweetAlert2 -->
<script src=" <?php echo base_url() . 'dashbord_template/'; ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url() . 'dashbord_template/'; ?>plugins/toastr/toastr.min.js"></script>

<script>
  
  $(function() {
   
    //success message
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 3000
    });
    <?php if (isset($_SESSION['success']) and  $_SESSION['success'] != '') { ?>
      toastr.success("<?php echo  $_SESSION['success']; ?>")
    <?php }$_SESSION['success']=''; ?>
    <?php if (isset($_SESSION['error']) and  $_SESSION['error'] != '') { ?>
      toastr.warning("<?php echo  $_SESSION['error']; ?>")
    <?php } $_SESSION['error']=''; ?>
  });
</script>
<script>
function addListeners(){
	var links = document.querySelectorAll('.del-btn');

	for(i = 0; i < links.length; i++){
		var currentLink = links[i];
	  currentLink.addEventListener('click', clickHandler);
	}
}
function clickHandler(e){
	e.preventDefault();
  var elm = e.target;
  var confirmation = confirm('Are you sure you want to delete this row?');
  if(confirmation){
  	elm.parentElement.parentElement.remove();
    return true;
  }else{
  	return false;
  }
}
addListeners();
</script>
</body>

</html>