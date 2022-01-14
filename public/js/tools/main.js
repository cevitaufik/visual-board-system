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
  let cust_code = $('#cust_code').val()
  let drawing = $('#drawing').val()
  let description = $('#description').val()

  if (cust_code && drawing && description) {
    $('#btn-submit').addClass('d-none')
    $('#btn-submit-loading').removeClass('d-none')
  }
}


// merefresh table 
function getTable() {
  $.get(`/tool/table`, {}, function(data) {
    $('#table-data').html(data)
  })
}

// menutup modal saat user mengklik tombol close
function closeThis() {
  $('.modal-detail').modal('hide')
  getTable()
}

// menutup modal saat user mengklik hapus
function closeModal(){
  $('.modal-detail').modal('hide')
  getTable()
  $('#deletedMsg').html(`
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="deleted">
      <p class="m-0 p-0">Data berhasil dihapus</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `)
}

// menampilkan modal tambah data
function add() {
  $('iframe').attr('src', `/tool/create`)
  $('.modal-detail').modal('show')
}

// menampilkan modal
$('#table-data').on('click', 'tr', function() {
  let drawing = $(this).data('id');

  $('iframe').attr('src', `/tool/${drawing}`)
  $('.modal-detail').modal('show')
})