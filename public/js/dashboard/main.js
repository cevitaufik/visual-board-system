function getTable() {
  let userPosition = $('#user-position').val()
  $.get(`/${userPosition}/table`, {}, function(data) {
    $('#table-data').html(data)
  })
}

$('#close').on('click', function() {
  $('.order-detail').modal('hide')
  getTable()
})

$('#table-data').on('click', 'tr', function() {
  let id = $(this).data('id');

  $('iframe').attr('src', `/order/${id}`)
  $('.order-detail').modal('show')
})

$('#update3').on('click', function() {
  let id = $('#order-detail').find('#shop_order').val()
  let formData = $('#order-detail').serialize()

  $.ajax({
    url: `/order/${id}`,
    method: 'PUT',
    data: formData,
    success: function(data){
      $('.order-detail').modal('hide');
      getTable();
    },
    error: function(error){
      alert('error ' + error.responseText);
      console.log(error);
    }        
  })
})

function filterReset() {
  $('.row-data').each(function() {
    $(this).show()
  })
}

function filterJob(keyword) {
  filterReset()

  $('.row-data').each(function() {
    if ($(this).data('jobtype') != keyword) {
      $(this).hide()
    }
    console.log($(this).data('jobtype'));
  })
}

const height = $(window).height() * 0.92;
$('iframe').css('height', height +'px');