<!-- jQuery -->
<script src="<?= base_url() ?>/assets/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>/assets/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?= base_url() ?>/assets/template/dist/js/adminlte.js"></script>
<!-- moment -->
<script src="<?= base_url() ?>/assets/template/plugins/moment/moment.min.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="<?= base_url() ?>/assets/template/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>/assets/template/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url() ?>/assets/template/dist/js/pages/dashboard3.js"></script>
<!-- Datatables -->
<script src="<?= base_url() ?>/assets/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/assets/template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<!-- Daterange -->
<script src="<?= base_url() ?>/assets/template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    //Date picker
    $('#reservationdate').datetimepicker({
      format: 'YYYY-MM-DD'
    });

  });


  $(document).ready(function() {
    var table = $('#member-table').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= site_url('main/memberlist') ?>",
        "type": "POST",
        "data": {"csrf_test_name" :  $('input[name=csrf_test_name]').val()},
        "data": function(data){
          data.csrf_test_name = $('input[name=csrf_test_name]').val()
        },
        'dataSrc' :function(response){
         $('input[name=csrf_test_name]').val(response.csrf_test_name)
         return response.data;
        }
      },
      "columnDefs": [{
        "targets": [],
        "orderable": false,
      }, ],
    });
  });
</script>
</body>

</html>