function getDescription(op) {
  return document.getElementById(`description-${op}`).textContent
}

document.getElementById('op_number').onchange = function(event) {
  let op = document.getElementById('op_number').value
  let description = getDescription(op)

  document.getElementById('description').innerHTML = description
}