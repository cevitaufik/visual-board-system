<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">

  <title>Scaner</title>

  <script src="/js/scaner.js"></script>
</head>

<body>

  <main>

    <section class="container" id="demo-content">
      <h1 class="title">Scan 1D/2D Code</h1>      

      <div>
        <video id="video" class="w-100" style="border: 1px solid gray"></video>
        {{-- <video id="video" width="300" height="200" style="border: 1px solid gray"></video> --}}
      </div>      

      <label>Result:</label>
      <h4 id="result"></h4>
      {{-- <pre><code id="result"></code></pre> --}}

      <div id="sourceSelectPanel">
        <label for="sourceSelect">Change video source:</label>
        <select id="sourceSelect">
        </select>
      </div>

      <div class="mb-3">
        <a class="btn btn-primary" id="startButton">Start</a>
        <a class="btn btn-primary" id="resetButton">Reset</a>
      </div>

      <p>*tulisan barcode akan dicetak dalam huruf kapital</p>
      <audio style="display: none;" id="notification" preload src="/asset/success.mp3">

    </section>

  </main>

  <script type="text/javascript">
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
                document.getElementById('notification').play()
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
  </script>

</body>

</html>