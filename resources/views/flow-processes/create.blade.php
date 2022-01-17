@extends('layouts.iframe')
@section('main')
  
  <main class="container-fluid p-3">

    <div class="container-fluid" id="table">

      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <p class="m-0 p-0">{{ session('success') }}</p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <form action="/flow-process" method="POST">
        @csrf

        <div class="row align-items-center">
          <div class="col-2 p-1 mb-3">
            <label for="no_drawing" class="d-block">Nomor drawing</label>
            <input name="flow[no_drawing]" type="text" class="form-control" id="dwg-number" @if (isset($no_drawing))
                value="{{ $no_drawing }}"
            @endif>          
          </div>
  
          <div class="col text-end">
            <span id="add-subprocess" class="btn btn-primary" onclick="addSubprocess()">Tambah subprocess</span>
            <button type="submit" class="btn btn-primary ms-3">Simpan</button>
          </div>
        </div>

        <div class="row bg-success fw-bold py-2">
          <div class="col-1 border-end text-center">SP</div>
          <div class="col-1 border-end text-center">OP</div>
          <div class="col-2 border-end text-center">Work center</div>
          <div class="col border-end text-center">Deskripsi</div>
          <div class="col-2 border-end text-center">Estimasi (menit)</div>
          <div class="col-2 text-center">Aksi</div>
        </div>

        <div class="processes-container">
          <div data-sp="0" id="subprocess-0" class="subprocess border-bottom">
            <div class="row py-2 op-number-row" data-op="10" id="row-10">
              <div class="col-1 align-self-center text-center p-1">
                <span class="number-subprocess">0</span>
              </div>
    
              <div class="col-1 align-self-center text-center p-1">
                <input type="hidden" id="op_number" name="flow[0][10][op_number]" value="10">
                <span class="number-row">10</span>
              </div>
    
              <div class="col-2 align-self-center p-1">
                <select id="work_center" name="flow[0][10][work_center]" class="form-select">
                  @foreach ($workCenters as $workCenter)
                    @if (old('flow[0][10][work_center]') == $workCenter->code)
                      <option value="{{ $workCenter->code }}" selected>{{ $workCenter->code . ' - ' . $workCenter->description }}</option>
                    @else
                      <option value="{{ $workCenter->code }}">{{ $workCenter->code . ' - ' . $workCenter->description }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
    
              <div class="col align-self-center p-1">
                <input type="text" class="form-control" id="description" name="flow[0][10][description]">
              </div>
    
              <div class="col-2 align-self-center p-1">
                <input type="number" class="form-control" id="estimation" name="flow[0][10][estimation]" required>
              </div>
    
              <div class="col-2 align-self-center text-center p-1">
                <span class="badge bg-success add-btn" onclick="addRow(0, 10)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                    <path
                      d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                    <path
                      d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                  </svg>
                </span>
                <span class="badge bg-warning insert-btn" onclick="insertRowBefore(0, 10)">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-up-square my-hover" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                  </svg>
                </span>
                <span class="badge bg-danger delete-btn" onclick="deleteRow(10)">
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
          </div>
        </div>

      </form>

    </div>

    <div class="d-none" id="select-blueprint">
      @foreach ($workCenters as $workCenter)
        @if (old('flow[0][10][work_center]') == $workCenter->code)
          <option value="{{ $workCenter->code }}" selected>{{ $workCenter->code . ' - ' . $workCenter->description }}</option>
        @else
          <option value="{{ $workCenter->code }}">{{ $workCenter->code . ' - ' . $workCenter->description }}</option>
        @endif
      @endforeach

    </div>

  </main>

  <script src="/js/flow-processes/main.js"></script>

@endsection