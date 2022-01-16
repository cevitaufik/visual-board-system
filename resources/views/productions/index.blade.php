@extends('layouts.simple')
@section('main')

<script src="/js/scaner.js"></script>

<div class="row justify-content-center">
  <div class="col-6 mt-5">
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
      <a class="btn btn-primary d-block w-100" id="startButton" onclick="showVideo()">Start</a>
      <a class="btn btn-primary d-block w-100 d-none" id="resetButton" onclick="hideVideo()">Tutup</a>
    </div>

    <audio style="display: none;" id="notification" preload src="/asset/success.mp3">
  </div>
</div>

<script src="/js/productions/main.js"></script>
    
@endsection