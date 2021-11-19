@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<div class="pagetitle">
  <h1>Registrasi pekerjaan</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <p class="m-0 p-0">{{ session('success') }}</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row justify-content-center">
  <div class="my-bg-element p-4 rounded">

    <form action="/order" method="POST">
      @csrf

      <div class="row mb-3">
        <div class="">
          <div class="row px-2">
            <div class="col-md-3 p-1">
              <label for="cust_code" class="d-block">Kode customer</label>
              <input type="text" name="cust_code" id="cust_code"
                class="form-control @error('cust_code') is-invalid @enderror" value="{{ old('cust_code') }}">
              @error('cust_code')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-md-3 p-1">
              <label for="quantity" class="d-block">Quantity</label>
              <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                value="{{ old('quantity') }}">
              @error('quantity')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col md-3 p-1">
              <label for="job_type">Tipe pekerjaan</label>
              <select id="job_type" name="job_type" class="form-select">
                @foreach ($jobTypes as $jobType)
                  @if (old('job_type') == $jobType->code)
                    <option value="{{ $jobType->id }}" selected>{{ $jobType->code . ' - ' . $jobType->description }}</option>
                  @else
                    <option value="{{ $jobType->id }}">{{ $jobType->code . ' - ' . $jobType->description }}</option>
                  @endif
                @endforeach
              </select>
            </div>

            <div class="col md-3 p-1">
              <label for="po_number" class="d-block">Nomor PO</label>
              <input type="text" name="po_number" class="form-control @error('po_number') is-invalid @enderror"
                value="{{ old('po_number') }}">
              @error('po_number')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="row px-2">
            <div class="col-md-3 p-1">
              <label for="due_date" class="d-block">Target kirim</label>
              <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror"
                value="{{ old('due_date') }}">
              @error('due_date')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-md-3 p-1">
              <label for="dwg_number" class="d-block">Nomor drawing</label>
              <input type="text" name="dwg_number" class="form-control @error('dwg_number') is-invalid @enderror"
                value="{{ old('dwg_number') }}">
              @error('dwg_number')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-md-3 p-1">
              <label for="tool_code" class="d-block">Kode tool</label>
              <input type="text" name="tool_code" class="form-control @error('tool_code') is-invalid @enderror"
                value="{{ old('tool_code') }}">
              @error('tool_code')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="col-12 py-2">
            <label for="description" class="d-block">Deskripsi</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
              value="{{ old('description') }}">
            @error('description')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="col-12">
            <label for="note" class="d-block">Catatan</label>
            <textarea name="note" style="height: 100px"
              class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
            @error('note')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

        </div>
      </div>

      <div class="w-100">
        <button type="submit" class="btn btn-primary px-5 ms-auto d-block">Buat</button>
      </div>
    </form>

  </div>
</div>

@endsection