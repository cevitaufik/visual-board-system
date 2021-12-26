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

// mengatur tinggi iframe
const height = $(window).height() * 0.92;
$('iframe').css('height', height +'px');

// menutup modal ketika mengklik tombol close
$('#close').on('click', function() {
  $('.modal-detail').modal('hide')
  location.reload()
})

// mengisi nomor drawing secara otomatis
$('#tool_code').on('change', function() {
  let toolCode = $('#tool_code').val()
  let cust = $('#cust_code').text()

  if (toolCode.trim().length) {
    $.ajax({
      url: `/tool/get-drawing/${toolCode}/${cust}`,
      method: 'GET',
      success: function(data){
        $('#no_drawing').val(data)
        $('#tool_code').val(toolCode.toUpperCase())
      },
      error: function(error){
        alert('error ' + error.responseText);
        console.log(error);
      }        
    })
  }  
})