// mengatur tingging iframe
const height = $(window).height() * 0.92;
$('iframe').css('height', height + 'px');

// menutup modal ketika mengklik tombol close
$('#close').on('click', function () {
  $('.modal-detail').modal('hide')
})

//melihat flow proses yang sudah ada
function showFlowProces(id) {
  $('iframe').attr('src', `/flow-process/${id}`)
  $('.modal-detail').modal('show')
}

// menambah flow process
function addFlowProces(data) {
  $('iframe').attr('src', `/flow-process/create-new/${data}`)
  $('.modal-detail').modal('show')
}

// menghapus tool
function deleteTool(noDrawing) {
  $('#btn-delete').addClass('d-none')
  $('#btn-delete-loading').removeClass('d-none')
  $('input[name="_method"]').val('DELETE')
  
  let formData = $('#order-detail').serialize()

  $.ajax({
    url: `/tool/${noDrawing}`,
    method: 'POST',
    data: formData,
    success: function () {
      parent.closeModal();
    },
    error: function (error) {
      console.log(error);
    }
  })
}

// menampilkan loading
function loading() {
  $('#btn-submit').addClass('d-none')
  $('#btn-submit-loading').removeClass('d-none')
}
