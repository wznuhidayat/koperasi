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
<script src="<?= base_url() ?>/assets/template/plugins/datatables-checkbox/dataTables.checkboxes.min.js"></script>
<!-- Daterange -->
<script src="<?= base_url() ?>/assets/template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url() ?>/assets/template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>/assets/template/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<!-- <script src="<?= base_url() ?>/assets/template/plugins/toastr/toastr.min.js"></script> -->
<script src="<?= base_url() ?>/assets/js/main.js"></script>
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

  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  $(document).ready(function() {
    var table = $('#member-table').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        "url": "<?= site_url('main/memberlist') ?>",
        "type": "POST",
        "data": {
          "csrf_test_name": $('input[name=csrf_test_name]').val()
        },
        "data": function(data) {
          data.csrf_test_name = $('input[name=csrf_test_name]').val()
        },
        'dataSrc': function(response) {
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
  function rm_member($id) {
      var segment = $("tbody").attr("id");
      Swal.fire({
        title: 'Apakah anda yakin menghapusnya?',
        text: "Data yang terhapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus data!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/main/' + segment + '/delete/' + $id,
            type: 'DELETE',
            error: function() {
              Toast.fire({
                icon: 'error',
                title: "Data gagal di hapus"
              })
            },
            success: function(data) {
              $('#member-table').DataTable().ajax.reload();
              Toast.fire({
                icon: 'success',
                title: 'Data telah dihapus!'
              })
            }
          });
        }
      })
    }
  // });
  //   $(".search-installment").click(function () {
  //   var id = $('#id_member').val();
  //   $.ajax({
  //     url: "listinstallment/" + id,
  //     type: "GET",
  //     dataType: "JSON",
  //     success: function (data) {
  //       $('#listloantable').DataTable({
  //         "paging": true,
  //         "lengthChange": false,
  //         "searching": false,
  //         "ordering": true,
  //         "info": true,
  //         "autoWidth": false,
  //         "responsive": true,
  //         columns: [
  //                         { 'data': 'id_installment' },
  //                         { 'data': 'id_installment' },
  //                         { 'data': 'id_installment' },
  //                         { 'data': 'id_installment' },
  //                         { 'data': 'id_installment' },
  //                         { 'data': 'id_installment' },


  //                     ]
  //       });

  //     }
  //   });
  // });
  var dataTable = $('#listloantable').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      "url": "<?= site_url('main/searchinstallment') ?>",
      "type": "POST",
      "data": {
        "csrf_test_name": $('input[name=csrf_test_name]').val()
      },
      "data": function(data) {
        data.csrf_test_name = $('input[name=csrf_test_name]').val(),
          data.id_member = $('#id_member').val()
      },
      'dataSrc': function(response) {
        $('input[name=csrf_test_name]').val(response.csrf_test_name)
        return response.data;
      }
    },
    "columnDefs": [{
      "targets": 0,
      "orderable": false,
      "checkboxes": {
        "selectRow": true
      }
    }, ],
    "select": {
      "style": "multi"
    },
    "order": [
      [1, "asc"]
    ]
  })

  $(".search-installment").click(function() {
    var id = $('#id_member').val();
    
    $.ajax({
      url: "searchbyid/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        if (data.member != null) {
          $('#name_member').val(data.member.name);
          $('#address').text(data.member.address);
          $('#telp').val(data.member.phone);
          if (data.member.gender == 'male') {
            $(".gender select").val("male").change();
          } else {
            $(".gender select").val("female").change();
          }
          $('#birth').val(data.member.date_of_birth);
          $('#id_member_hidden').val(id);
          $('#text1').text('Saldo saat ini.');
          $('#id_member').removeClass('is-invalid');
          dataTable.draw();
        } else {
          $('#name_member').val(null);
          $(".gender select").val("null").change();
          $('#address').text(null);
          $('#telp').val(null);
          $('#birth').val(null);
          $('#text1').text('tidak ditemukan.');
          $('#id_member').addClass('is-invalid');
          dataTable.draw();
        }
      }
    });
    
  });


  $('#frm-example').on('submit', function(e) {
    var form = this;
    var rows_selected = dataTable.column(0).checkboxes.selected();
    $.each(rows_selected, function(index, rowId) {
      // Create a hidden element
      $(form).append(
        $('<input>')
        .attr('type', 'hidden')
        .attr('name', 'id[]')
        .val(rowId)
      );
    });
    // e.preventDefault();
  });
</script>

</body>

</html>