$('.confirmation-logout').on('click', function(e) {
  Swal.fire({
    title: 'Anda Yakin?',
    text: "Ingin Logout!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Yakin!'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "../index.php?logout=1";
    }
  })
});

const desc_in = $('.desc-in').data('flashdata')
if (desc_in == "success-in") {
  Swal.fire(
    'Berhasil!',
    'Anda Telah Melakukan Penambahan Barang',
    'success'
  )
} else if (desc_in == "failed-in") {
  Swal.fire(
    'Gagal!',
    'Anda Gagal Melakukan Penambahan Barang',
    'error'
  )
} else if (desc_in == "success-ed") {
  Swal.fire(
    'Berhasil!',
    'Anda Telah Melakukan Perubahan Barang',
    'success'
  )
} else if (desc_in == "failed-ed") {
  Swal.fire(
    'Gagal!',
    'Anda Gagal Melakukan Perubahan Barang',
    'error'
  )
} else if (desc_in == "success-del") {
  Swal.fire(
    'Berhasil!',
    'Anda Telah Melakukan Penghapusan Barang',
    'success'
  )
} else if (desc_in == "failed-del") {
  Swal.fire(
    'Gagal!',
    'Anda Gagal Melakukan Penghapusan Barang',
    'error'
  )
}

$(document).ready(function() {
  $('#search').on('keyup', function() {
    $.ajax({
      type: 'POST',
      url: '../search.php',
      data: {
        search: $(this).val()
      },
      cache: false,
      success: function(data) {
        $('#tampil').html(data);
      }
    });
  });
});