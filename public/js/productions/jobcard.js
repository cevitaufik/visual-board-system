function getDescription(op) {
  return document.getElementById(`description-${op}`).textContent
}

function getBtnByOP(op) {
  return document.getElementById(`btn-op-${op}`).outerHTML
}

document.getElementById('op_number').onchange = function() {
  let op = document.getElementById('op_number').value
  let description = getDescription(op)
  let btn = getBtnByOP(op)

  document.getElementById('description').innerHTML = description
  document.getElementById('btn-container').innerHTML = btn
}

let bluePrint = document.getElementById('content-blue-print').innerHTML
let contentContainer = document.getElementById('content-container')
let secondBluePrint = document.getElementById('second-blue-print')

// tambah proses baru
function addProcess() {
  secondBluePrint.innerHTML = contentContainer.innerHTML 
  contentContainer.innerHTML = bluePrint
  contentContainer.classList.remove('d-none')
}

// kembali ke form sebelumnya
function undoForm() {
  // contentContainer.innerHTML = secondBluePrint.innerHTML
  // contentContainer.classList.remove('d-none')
  location.reload()
}