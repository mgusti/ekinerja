const fd = $('.flash-data').data('flashdata');
if(fd){
    Swal.fire(
        'data berhasil ' + fd,
        '',
        'success'
      )
}

const err = $('.eror').data('flashdata');
if(err){
    Swal.fire(
        'kesalahan...!!, ' + err,
        '',
        'error'
      )
}

const erlog = $('.erlog').data('flashdata');
if(erlog){
  Swal.fire({
    title: erlog,
    text: 'Di ingat-Ingat lagi ya passwordnya KK..!!',
    imageUrl: '../ekinerja/assets/img/25.gif',
    imageWidth: 400,
    imageHeight: 250,
    imageAlt: 'Custom image',
  })
}

$('.hapus').on('click', function (e){
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Anda Yakin Untuk Menghapus Data Ini?',
        text: "Data yang telah dihapus tidak dapat dikembalikan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus'
      }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
      })

})

$('.kembali').on('click', function (e){
  e.preventDefault();
  const href = $(this).attr('href');

  Swal.fire({
      title: 'Anda Yakin Untuk kembali',
      text: "data yang terisi tidak disimpan",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Kembali'
    }).then((result) => {
      if (result.value) {
          document.location.href = href;
      }
    })

})

$('.reset').on('click', function (e){
  e.preventDefault();
  const href = $(this).attr('href');

  Swal.fire({
      title: 'Anda Yakin Untuk mereset password ini..?',
      text: "password yang direset tidak bisa dikembalikan",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya, Reset'
    }).then((result) => {
      if (result.value) {
          document.location.href = href;
      }
    })

})

