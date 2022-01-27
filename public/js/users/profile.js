function createWeek(week) {
  let row = document.createElement('div')
  row.id = `week-${week}`
  row.classList.add('d-flex', 'flex-row', 'mb-1')
  document.getElementById('contributions').append(row)
}

function createDay(data) {
  let color

  if (data == 0) {
    color = 'rgba(230, 232, 230, 0.25)'
  } else {
    color = `rgba(19, 255, 0, ${(data / 10 >= 0.25) ? data / 10 : 0.25 })`
  }

  let cell = document.createElement('div')
  cell.style.width = '10px'
  cell.style.height = '10px'
  cell.style.backgroundColor = color
  cell.classList.add('ms-1')
  cell.setAttribute('data-bs-toggle', 'tooltip')
  cell.setAttribute('data-bs-placement', 'top')
  cell.setAttribute('title', `${data}`)
  return cell

}

function contribution(username) {
  fetch(`/user/contributions/superadmin`)
    .then(response => response.json())
    .then(data => {

      let week = 1
      data.forEach((data, index) => {

        if (index == 0) {
          
          createWeek(week)
          let cell = createDay(data)
          document.getElementById(`week-${week}`).append(cell)

        } else if (index % 7 == 0) {
          
          week += 1
          createWeek(week)
          let cell = createDay(data)
          document.getElementById(`week-${week}`).append(cell)
          
        } else {
          let cell = createDay(data)
          document.getElementById(`week-${week}`).append(cell)
        }

      });
    })

  console.log(username);
}