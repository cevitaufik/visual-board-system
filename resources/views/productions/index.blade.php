@extends('layouts.simple')
@section('main')

<script src="/js/scaner.js"></script>

<div class="row justify-content-center">
  <div class="col-md-6 mt-5">
    <h1 class="text-center mb-4">Scan QR</h1>

    <div id="sourceSelectPanel" class="mb-4">
      <label for="sourceSelect" class="d-block">Kamera:</label>
      <select id="sourceSelect" class="form-select">
      </select>
    </div>

    <div id="video-container" class="d-none">
      <video id="video" class="w-100 border"></video>
    </div>

    <div class="d-none btn btn-success w-100 text-center" id="result-container" onclick="processSO()">
      <h2 id="result"></h2>
      <span>Proses</span>
    </div>      

    <div class="my-4">
      <a class="btn btn-primary d-block w-100 p-1" id="startButton" onclick="showVideo()">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-qr-code-scan p-2" viewBox="0 0 16 16">
          <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z"/>
          <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z"/>
          <path d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z"/>
          <path d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z"/>
          <path d="M12 9h2V8h-2v1Z"/>
        </svg>
      </a>
      <a class="btn btn-primary d-block w-100 d-none" id="resetButton" onclick="hideVideo()">Tutup</a>
    </div>

    <audio style="display: none;" id="notification" preload src="/asset/success.mp3">
  </div>
</div>

<script src="/js/productions/main.js"></script>
    
@endsection