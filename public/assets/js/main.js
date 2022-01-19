


$('.btn-delete').on('click', function (e) {
  e.preventDefault();
  const href = $(this).attr('href');
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
      document.location.href = href;
    }
  })
});


$(".search-member").click(function () {
  var id = $('#id_member').val();
  $.ajax({
    url: "searchbyid/" + id,
    type: "GET",
    dataType: "JSON",
    success: function (data) {
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
      } else {
        $('#name_member').val(null);
        $(".gender select").val("null").change();
        $('#address').text(null);
        $('#telp').val(null);
        $('#birth').val(null);
        $('#text1').text('tidak ditemukan.');
        $('#id_member').addClass('is-invalid');
      }
    }
  });
});

$(".search-wd").click(function () {
  var id = $('#id_member').val();
  $.ajax({
    url: "searchbyid/" + id,
    type: "GET",
    dataType: "JSON",
    success: function (data) {
      if (data.member != null) {
        $('#name_member').val(data.member.name);
        $('#address').text(data.member.address);
        $('#telp').val(data.member.phone);
        if (data.member.gender == 'male') {
          $(".gender select").val("male").change();
        } else {
          $(".gender select").val("female").change();
        }
        if (data.saldo != null) {
          $('#saldo').text(data.saldo);
        } else {
          $('#saldo').text(0);
        }
        $('#birth').val(data.member.date_of_birth);
        $('#id_member_hidden').val(id);
        $('#text1').text('Saldo saat ini.');
        $('#id_member').removeClass('is-invalid');
      } else {
        $('#name_member').val(null);
        $(".gender select").val("null").change();
        $('#address').text(null);
        $('#birth').val(null);
        $('#telp').val(null);
        $('#saldo').text('0');
        $('#text1').text('tidak ditemukan.');
        $('#id_member').addClass('is-invalid');
      }
    }
  });
});

// $(".search-installment").click(function () {
//   var id = $('#id_member').val();
//   $.ajax({
//     url: "listinstallment/" + id,
//     type: "GET",
//     dataType: "JSON",
//     success: function (response) {
//       $('#listloantable').DataTable({
//         "paging": true,
//         "lengthChange": false,
//         "searching": false,
//         "ordering": true,
//         "info": true,
//         "autoWidth": false,
//         "responsive": true,
//         "columns": [
//           {"data" : response['installment'][0].id_installment},
//           {"data" : response['installment'][0].id_installment},
//           {"data" : response['installment'][0].id_installment},
//           {"data" : response['installment'][0].id_installment},
//           {"data" : response['installment'][0].id_installment},
//           {"data" : response['installment'][0].id_installment},

//         ]
//       });
//       // var len = 0;
//       // $('#listloantable tbody').empty(); // Empty <tbody>
//       // if(response['installment'] != null){
//       //    len = response['installment'].length;
//       // }
//       // if (len != null) {
//       //   $('#name_member').val(len);
//       //   for (var i = 0; i < len; i++) {
//       //     var id = response['installment'][i].id_installment;
//       //     var id_loan = response['installment'][i].id_loan;
//       //     var period = response['installment'][i].period;
//       //     var amount = response['installment'][i].amount;
//       //     var status = response['installment'][i].status;
//       //     if (status = 'unpaid'){
//       //       status = '<span class="badge badge-danger">Unpaid</span>'
//       //     }else{
//       //       status = '<span class="badge badge-success">Success</span>'
//       //     }
//       //     var tr_str = "<tr>" +
//       //       "<td align='center'><input class='form-check-input' type='checkbox'></td>" +
//       //       "<td align='center'>" + id + "</td>" +
//       //       "<td align='center'>" + id_loan + "</td>" +
//       //       "<td align='center'>" + period + "</td>" +
//       //       "<td align='center'>" + amount + "</td>" +
//       //       "<td align='center'>" + status + "</td>" +
//       //       "</tr>";

//       //     $("#listloantable tbody").append(tr_str);
//       //   }
//       // } else {
//       //   var tr_str = "<tr>" +
//       //     "<td align='center' colspan='4'>No record found.</td>" +
//       //     "</tr>";

//       //   $("#listloantable tbody").append(tr_str);
//       // }
//     }
//   });
// });
$("#checkall").click(function () {
  $('input:checkbox').not(this).prop('checked', this.checked);
});
var Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

const flashDataSuccess = $('.flash-data-success').data('flashdata');
const flashDataAmountError = $('.flash-data-amount-error').data('flashdata');
if (flashDataSuccess) {
  Toast.fire({
    icon: 'success',
    title: flashDataSuccess
  })
}
if (flashDataAmountError) {
  Toast.fire({
    icon: 'error',
    title: flashDataAmountError
  })
}

function previewImg() {
  const imageItem = document.querySelector('#image');
  const imageItemLabel = document.querySelector('.custom-file-label');
  const imgPreview = document.querySelector('.img-preview');

  // imageItemLabel.textContent = imageItem.files[0].name;

  const fileImage = new FileReader();
  fileImage.readAsDataURL(imageItem.files[0]);

  fileImage.onload = function (e) {
    imgPreview.src = e.target.result;
  }
}





  //input form

