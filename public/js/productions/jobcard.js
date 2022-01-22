function getDescription(op) {
  return document.getElementById(`description-${op}`).textContent
}

document.getElementById('op_number').onchange = function() {
  let op = document.getElementById('op_number').value
  let description = getDescription(op)
  document.getElementById('description').innerHTML = description
}

let bluePrint = document.getElementById('content-blue-print').innerHTML
let contentContainer = document.getElementById('content-container')
let secondBluePrint = document.getElementById('second-blue-print')

document.getElementById('add-process').onclick = function (event) {
  event.preventDefault()  
  secondBluePrint.innerHTML = contentContainer.innerHTML 
  contentContainer.innerHTML = bluePrint
  contentContainer.classList.remove('d-none')
}

function undoForm() {
  contentContainer.innerHTML = secondBluePrint.innerHTML
  contentContainer.classList.remove('d-none')
}