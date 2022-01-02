

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

$(".search").click(function () {
  var id = $('#id_member').val();
  $.ajax({
    url: "searchbyid/" + id,
    type: "GET",
    dataType: "JSON",
    success: function (data) {
      if(data.member != null){
        $('#name_member').val(data.member.name);
        $('#address').text(data.member.address);
        $('#telp').val(data.member.phone);
        $('#saldo').text(data.saldo);
        $('#id_member_hidden').val(id);
        $('#text1').text('Saldo saat ini.');
        $('#id_member').removeClass('is-invalid');
      }else{
        $('#name_member').val(null);
        $('#address').text(null);
        $('#telp').val(null);
        $('#saldo').text('0');
        $('#text1').text('tidak ditemukan.');
        $('#id_member').addClass('is-invalid');
      }
    }
  });
});
