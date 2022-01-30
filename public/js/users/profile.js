function createTR(week) {
  let row = document.createElement('tr')
  row.id = `w-${week}`

  // 1 = senin, 2 = selasa, 0 = minggu
  let day = [1, 2, 3, 4, 5, 6, 0]
  day.forEach(d => {
    let td = document.createElement('td')
    td.classList.add(`d-${d}`)
    row.append(td)
  })

  document.getElementById('contributions-table').append(row)
}

function createCell(inputDate, contribution, week) {
  let day = new Date(inputDate)
  day = day.getDay()

  let color

  if (contribution == 0) {
    color = 'rgba(230, 232, 230, 0.25)'
  } else {
    color = `rgba(19, 255, 0, ${(contribution / 10 >= 0.25) ? contribution / 10 : 0.25 })`
  }

  let cell = document.createElement('div')
  cell.style.width = '15px'
  cell.style.height = '15px'
  cell.style.backgroundColor = color
  cell.setAttribute('data-bs-toggle', 'tooltip')
  cell.setAttribute('data-bs-placement', 'top')
  cell.setAttribute('title', `${inputDate}: ${contribution}`)
  document.querySelector(`#w-${week} .d-${day}`).append(cell)
}

function contribution(username) {
  fetch(`/user/contributions/${username}`)
    .then(response => response.json())
    .then(data => {
      
      let contributions = []

      for (let [key, value] of Object.entries(data)) {
        contributions.push([key, value])
      }

      let week = 1
      contributions.forEach((data, index) => {

        let day = new Date(data[0])
        day = day.getDay()

        if (index == 0) {
          
          createTR(week)
          createCell(data[0], data[1], week)

        } else if (day == 0) {

          week += 1
          createTR(week)
          createCell(data[0], data[1], week)

        } else {

          createCell(data[0], data[1], week)

        }

      });

    })

}