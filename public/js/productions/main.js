function showVideo() {
  $('#video-container').removeClass('d-none')
  $('#resetButton').removeClass('d-none')
  $('#startButton').addClass('d-none')
}

function hideVideo() {
  $('#video-container').addClass('d-none')
  $('#startButton').removeClass('d-none')
  $('#resetButton').addClass('d-none')
}

function processSO() {
  let shopOrder = $('#result').text()
  location.href = `/productions/process/${shopOrder}`
}

window.addEventListener('load', function () {
  let selectedDeviceId;
  const codeReader = new ZXing.BrowserMultiFormatReader()
  codeReader.listVideoInputDevices()
    .then((videoInputDevices) => {
      const sourceSelect = document.getElementById('sourceSelect')
      selectedDeviceId = videoInputDevices[0].deviceId
      if (videoInputDevices.length >= 1) {
        videoInputDevices.forEach((element) => {
          const sourceOption = document.createElement('option')
          sourceOption.text = element.label
          sourceOption.value = element.deviceId
          sourceSelect.appendChild(sourceOption)
        })

        sourceSelect.onchange = () => {
          selectedDeviceId = sourceSelect.value;
        };

        const sourceSelectPanel = document.getElementById('sourceSelectPanel')
        sourceSelectPanel.style.display = 'block'
      }

      document.getElementById('startButton').addEventListener('click', () => {
        codeReader.decodeFromVideoDevice(selectedDeviceId, 'video', (result, err) => {
          if (result) {
            console.log(result.text)
            document.getElementById('result').textContent = result.text

            $('#result-container').removeClass('d-none')
            document.getElementById('notification').play()

            codeReader.reset()

            hideVideo()
            processSO()
          }
          if (err && !(err instanceof ZXing.NotFoundException)) {
            console.error(err)
            document.getElementById('result').textContent = err
          }
        })
      })

      document.getElementById('resetButton').addEventListener('click', () => {
        codeReader.reset()
        document.getElementById('result').textContent = '';
        console.log('Reset.')
      })

    })
    .catch((err) => {
      console.error(err)
    })
})