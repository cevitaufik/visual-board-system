@extends('layouts.simple')
@section('main')

@if (($errorMsg) ?? false)

<div class="container my-5">
  <h1 class="text-center">{{ $errorMsg }}</h1>
</div>

@else

<div class="container mb-5">

  <form action="/productions" method="post" class="row justify-content-center">
    @csrf

    <input type="hidden" name="shop_order" value="{{ $shop_order }}">
    <input type="hidden" name="processed_by" value="{{ auth()->user()->username }}">

    <div class="col-md-6 my-bg-element p-5 rounded mt-5">

      <h1 class="text-center pb-4">{{ $shop_order }}</h1>

      @if (($finishMsg) ?? false)
        <h3 class="text-center pb-4 text-success">{{ $finishMsg }}</h3>
      @endif

      <div id="content-container">
        <div class="row">

          <div class="col-md-4 mx-0 px-0">
            <label for="qty" class="form-lable ps-2">QUANTITY</label>
            <input type="number" name="qty" id="qty" class="form-control" value="{{ $qty }}">
          </div>


          <div class="col-md-8 mx-0 px-0 ps-md-1 mt-3 mt-md-0">
            <label for="op_number" class="form-lable ps-2">OP - WORK CENTER</label>
            <select class="form-select" id="op_number" name="op_number">
              @foreach ($processes as $process)
                <option 
                  value="{{ $process['op_number'] }}"
        
                  @if ($process['op_number'] == $currentProcess['op_number']) 
                    selected
                  @endif                  
                  >      
                  {{ $process['op_number'] . ' - ' . $process['work_center']}}      
                </option>        
              @endforeach
            </select>
          </div>

        </div>

        <div class="row mt-3">
          <label for="description" class="form-lable">INSTRUKSI</label>
          <textarea name="description" id="description" rows="5" class="form-control" disabled>{{ $currentProcess['description'] }}</textarea>
        </div>

        <div class="row mt-3">
          <label for="note" class="form-lable">CATATAN</label>
          <textarea name="note" id="note" rows="5" class="form-control"></textarea>
        </div>

        <div class="row mt-4">

          @if ($currentProcess['start'])
            <button type="submit" class="btn btn-success w-100 fs-3" name="end" value="1" 
              @if (isset($finishMsg)) disabled @endif>
              FINISH
            </button>
          @else
            <button type="submit" class="btn btn-success w-100 fs-3" name="start" value="1">START</button>
          @endif

          <button class="btn btn-warning w-100 fs-3 mt-3" id="add-process">TAMBAH PROSES BARU</button>
        </div>
      </div>

    </div>
  </form>

  <div class="d-none" id="description-container">
    @foreach ($processes as $process)
      <p id="description-{{ $process['op_number'] }}">{{ $process['description'] }}</p>
    @endforeach
  </div>

  <div id="content-blue-print" class="d-none">
    <div class="row">

      <div class="col-md-4 mx-0 px-0">
        <label for="qty" class="form-lable ps-2">QUANTITY</label>
        <input type="number" name="qty" id="qty" class="form-control" value="{{ $qty }}">
      </div>

      <div class="col-md-4 mx-0 px-0 ps-md-1 mt-3 mt-md-0">
        <label for="op_number" class="form-lable ps-2">SETELAH OP</label>
        <input type="number" name="op_number" id="op_number" class="form-control">
      </div>

      <div class="col-md-4 mx-0 px-0 ps-md-1 mt-3 mt-md-0">
        <label for="work_center" class="form-lable ps-2">WORK CENTER</label>
        <select class="form-select" id="work_center" name="work_center">
          @foreach ($work_center as $wc)
            <option value="{{ $wc->code }}">{{ $wc->code }}</option>        
          @endforeach
        </select>
      </div>

    </div>

    <div class="row mt-3">
      <label for="description" class="form-lable">DESKRIPSI PROSES</label>
      <textarea name="description" id="description" rows="5" class="form-control"></textarea>
    </div>

    <div class="row mt-3">
      <label for="note" class="form-lable">CATATAN</label>
      <textarea name="note" id="note" rows="5" class="form-control"></textarea>
    </div>

    <div class="row mt-4">
      <button type="submit" class="btn btn-success w-100 fs-3" name="start" value="1">START</button>
      <span class="btn btn-warning w-100 fs-3 mt-3" onclick="undoForm()">KEMBALI</span>
    </div>
  </div>

  <div id="second-blue-print" class="d-none"></div>

</div>

@endif



<script src="/js/productions/jobcard.js"></script>
    
@endsection