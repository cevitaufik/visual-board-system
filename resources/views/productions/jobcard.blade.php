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
        <textarea name="description" id="description" rows="3" class="form-control" disabled>{{ $currentProcess['description'] }}</textarea>
      </div>

      <div class="row mt-3">
        <label for="note" class="form-lable">CATATAN</label>
        <textarea name="note" id="note" rows="3" class="form-control"></textarea>
      </div>

      <div class="row mt-4">

        @if ($currentProcess['start'])
          <button type="submit" class="btn btn-success w-100 fs-3" name="end" value="1">FINISH</button>
        @else
          <button type="submit" class="btn btn-success w-100 fs-3" name="start" value="1">START</button>
        @endif        
      </div>

    </div>
  </form>

</div>

@endif



<script src="/js/productions/main.js"></script>
    
@endsection