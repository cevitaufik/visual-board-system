// general 
// mengatur tinggi iframe
const height = $(window).height() * 0.92;
$('iframe').css('height', height +'px');

// ====================================================================================

// halaman index
// merefresh table 
function getTable() {
  $.get(`/flow[${subprocess}]-process/table`, {}, function(data) {
    $('#table-data').html(data)
  })
}

// menutup modal ketika mengklik tombol close
$('#close').on('click', function() {
  $('.modal-detail').modal('hide')
  getTable()
})

// menutup modal setelah menghapus data
function closeModal(){  
  $('.modal-detail').modal('hide')
  getTable()
  $('#deletedMsg').append(`
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="deleted">
      <p class="m-0 p-0">Data berhasil dihapus</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `)  
}

// menampilkan modal tambah data
function add() {
  $('iframe').attr('src', `/flow-process/create`)
  $('.modal-detail').modal('show')
}

// menampilkan modal
$('#table-data').on('click', 'tr', function() {
  let id = $(this).data('id');

  $('iframe').attr('src', `/flow-process/${id}`)
  $('.modal-detail').modal('show')
})

// ====================================================================================

// halaman detail
// menambah baris

function newElement(numberRow, subprocess) {
  let option = $('#select-blueprint').html()
  return `
    <div class="row py-2 op-number-row" data-op="${numberRow}" id="row-${numberRow}">
      <div class="col-1 align-self-center text-center p-1">
        <span class="number-subprocess">${subprocess}</span>
      </div>

      <div class="col-1 align-self-center text-center p-1">
        <input type="hidden" id="id" name="flow[${subprocess}][${numberRow}][id]" value="new">
        <input type="hidden" id="op_number" name="flow[${subprocess}][${numberRow}][op_number]" value="${numberRow}">
        <span class="number-row">${numberRow}</span>
      </div>

      <div class="col-2 align-self-center p-1">
        <select id="work_center" name="flow[${subprocess}][${numberRow}][work_center]" class="form-select">
         ${option}
        </select>
      </div>

      <div class="col align-self-center p-1">
        <input type="text" class="form-control" id="description" name="flow[${subprocess}][${numberRow}][description]">
      </div>

      <div class="col-2 align-self-center p-1">
        <input type="number" class="form-control" id="estimation" name="flow[${subprocess}][${numberRow}][estimation]" required>
      </div>

      <div class="col-2 align-self-center text-center p-1">
        <span class="badge bg-success add-btn" onclick="addRow(${subprocess}, ${numberRow})">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
            <path
              d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
            <path
              d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
          </svg>
        </span>
        <span class="badge bg-warning insert-btn" onclick="insertRowBefore(${subprocess}, ${numberRow})">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-arrow-up-square my-hover" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
              d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
          </svg>
        </span>
        <span class="badge bg-danger delete-btn" onclick="deleteRow(${subprocess}, ${numberRow})">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-x-square my-hover" viewBox="0 0 16 16">
            <path
              d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
            <path
              d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
          </svg>
        </span>
      </div>
    </div>
  `
}

function addRow(subprocess, row) {
  let numberRow = row + 10

  $('#subprocess-' + subprocess).find('#row-' + row).after(newElement(numberRow, subprocess))
  refreshRow(subprocess)
}

//menambah baris sebelumnya
function insertRowBefore(subprocess, row) {
  let numberRow = row

  $('#subprocess-' + subprocess).find('#row-' + row).before(newElement(numberRow, subprocess))
  refreshRow(subprocess)
}

function getDwgNumber() {
  return $('#dwg-number').val()
}

function refreshRow(subprocess) {
  let dwg = getDwgNumber();

  $('#subprocess-' + subprocess).find('.op-number-row').each(function(i) {
    let index = i * 10 + 10

    $(this).attr('data-op', index)
    $(this).attr('id', `row-${index}`)
    $(this).find('.number-row').text(index)

    $(this).find('#id').attr('name', `flow[${subprocess}][${index}][id]`)
    $(this).find('#op_number').attr('name', `flow[${subprocess}][${index}][op_number]`)
    $(this).find('#work_center').attr('name', `flow[${subprocess}][${index}][work_center]`)
    $(this).find('#description').attr('name', `flow[${subprocess}][${index}][description]`)
    $(this).find('#estimation').attr('name', `flow[${subprocess}][${index}][estimation]`)

    $(this).find(`input[name="flow[${subprocess}][${index}][no_drawing]"]`).val(dwg)
    $(this).find(`input[name="flow[${subprocess}][${index}][op_number]"]`).val(index)
    $(this).find('.add-btn').attr('onclick', `addRow(${subprocess}, ${index})`)
    $(this).find('.insert-btn').attr('onclick', `insertRowBefore(${subprocess}, ${index})`)
    $(this).find('.delete-btn').attr('onclick', `deleteRow(${subprocess}, ${index})`)

    if(index != 10) {
      $(this).find('.number-subprocess').text('')
    } else {
      $(this).find('.number-subprocess').text(subprocess)
    }
  })
}

// menghapus baris
function deleteRow(subprocess, row) {
  // perlu diperbaiki. pada halaman detail flow process
  let id = $('#row-' + row).find('#id').val()
  $('#deleted').append(`<input type="hidden" name="deleted[]" value="${id}">`)

  //sudah oke
  $('#subprocess-' + subprocess).find('.op-number-row').remove('#row-' + row)

  refreshRow(subprocess)
}

function onSubmit() {
  let row = $('.op-number-row')
  if (!row.length) {
    parent.closeModal()
  }
}

// ====================================================================================

// halaman create
// merefresh nomor drawing
$('#dwg-number').on('change', function() {
  let dwg = $('#dwg-number').val()
  $('.op-number-row').find(`input[name="flow[${subprocess}][1][no_drawing]"]`).val(dwg)
})

// ====================================================================================

// menambah subprocess
function addSubprocess() {
  let numberOfSubprocess = $('.subprocess').length + 1
  
  $('.processes-container').append(
    `<div data-sp="${numberOfSubprocess}" id="subprocess-${numberOfSubprocess}" class="subprocess border-bottom"></div>`
  )

  $('#subprocess-' + numberOfSubprocess).append(newElement(10, numberOfSubprocess))
}