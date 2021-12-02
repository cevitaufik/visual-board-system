@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<h1 class="fw-bold mb-4 mt-3">Daftar tipe pekerjaan</h1>

@if (session()->has('success'))    
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="m-0 p-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal">
  Tambah tipe pekerjaan baru
</button>

<div class="my-bg-element rounded-3 overflow-auto">
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Kode</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($jobTypes as $jobType)
        <tr>
          <td scope="row">{{ $loop->iteration }}</td>
          <td id="{{ 'code' . $jobType->id }}" class="text-capitalize job-type-code">{{ $jobType->code }}</td>
          <td id="{{ 'desc' . $jobType->id }}">{{ $jobType->description }}</td>
          <td>
            <div>
              <span class="badge bg-warning my-hover">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16" onclick="detailJobType({{ $jobType->id }})">
                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
              </span>
              
              <form action="{{ route('job-type.destroy', $jobType->id) }}" method="post" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="badge bg-danger border-0 my-hover d-inline-block" value="delete" onclick="return confirm('Apakah anda yakin?')">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                  </svg>
                </button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="modal" id="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content my-bg-element">

        <form method="post" id="new-job-type" action="/job-type">

          <div class="modal-header">
            <h5 class="modal-title">Tambah tipe pekerjaan</h5>
          </div>

          <div class="modal-body">            
            @csrf
            <div class="row g-3">
              <div class="col">
                <label for="description" class="mb-1">Deskripsi</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}">
                @error('description')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="col">
                <label for="code" class="mb-1">Kode</label>
                <input type="text" id="code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}">
                @error('code')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            </div>            
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" id="btn">Tambah</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function detailJobType(id) {
    $('#description').val($('#desc' + id).text())
    $('#code').val($('#code' + id).text())
    $('.modal-title').text('Perbarui tipe pekerjaan')
    $('#btn').text('Perbarui')
    $('#new-job-type').attr('action', `/job-type/${id}`)
    $('form').append('@method("PUT")')
    $('.modal').modal('show')
  }

  let err = '{{ session()->has('errors') }}'

  $( document ).ready(function() {
    function openModal() {
      $('.modal').modal('show')      
    }

    if (err) {
      openModal()
    }
  });

  // mengambil semua kode pekerjaan pada element
  $('#description').on('change', function() {
    const input = $('#description').val()
                  .toUpperCase()
                  .slice(0, 3);
  
    $('#code').val(input)
  })

  // menyimpan data
  $('#add').on('click', function(){

    const data = $('#new-job-type').serialize();

    $.ajax({
      url: '/job-type',
      method: 'POST',
      data: data,
      success: function() {
        window.location.href = '/job-type'
      },
      error: function(error) {
        alert(error.responseText)
      }
    })
  })
</script>

@endsection