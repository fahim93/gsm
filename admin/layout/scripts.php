<!-- jQuery 2.1.4 -->
<script src="<?=BASE_URL?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript">
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?=BASE_URL?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?=BASE_URL?>plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?=BASE_URL?>plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?=BASE_URL?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?=BASE_URL?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?=BASE_URL?>plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
<script src="<?=BASE_URL?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?=BASE_URL?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?=BASE_URL?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?=BASE_URL?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src="<?=BASE_URL?>plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?=BASE_URL?>dist/js/app.min.js" type="text/javascript"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=BASE_URL?>dist/js/pages/dashboard.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=BASE_URL?>dist/js/demo.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="<?=BASE_URL?>plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=BASE_URL?>plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>

<!-- page script -->
<script>
	$(function () {
		$("#example1").DataTable();
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
		});
	});
</script>

<!-- Navigation Script -->
<script>
	$(function ($) {
		let url = window.location.href;
		$('.sidebar ul li a').each(function () {
			if (this.href === url) {
				$(this).addClass('active');
				// console.log($(this).attr('class'));
				$(this).parent().parent().parent().addClass('is-expanded');
				// if ($(this).attr('class').hasClass("active")) {
				// console.log("Found!")
				// }
			}
		});
	});
</script>