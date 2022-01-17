@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<div class="pagetitle">
  <h1>Flow process</h1>
</div>

<a onclick="add()" class="btn btn-primary mb-3">Tambah flow process baru</a>

<div id="deletedMsg"></div>

<section class="section dashboard">
  <div class="row">

    <div class="col-12">
      <div class="card recent-sales my-bg-element">

        <div class="card-body">
          <h5 class="card-title">Daftar flow process</h5>

          @if (!count($processes))
            <h3>Belum ada flow process</h3>
          @else
          <div class="overflow-auto">
            <table class="table datatable my-text-white">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">No. drawing</th>
                  <th scope="col">Kode tool</th>
                  <th scope="col">Deskripsi</th>
                </tr>
              </thead>
              <tbody id="table-data">
                @foreach ($processes as $process)
                <tr class="my-cursor row-data" data-id="{{ $process->id }}">
                  <td scope="row">{{ $loop->iteration }}</td>
                  <td>{{ $process->no_drawing }}</td>
                  <td>{{ ($process->tool->code) ?? '--kosong--' }}</td>
                  <td>{{ ($process->tool->description) ?? '--kosong--' }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @endif

          <!-- Modal -->
          <div class="modal fade modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen position-relative">
              <div class="modal-content my-bg-element p-1">
                <div class="modal-body p-3 m-0">
                  <iframe title="Detail order" class="w-100 d-inline-block" id="iframe"></iframe>
                </div>
                <div class="position-absolute top-0 end-0 mt-2 me-3">
                  <button type="button" class="btn btn-danger btn-sm" id="close" data-bs-toggle="flow-processtip" data-bs-placement="bottom" title="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                  </svg>
                </button>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>

  <script src="/js/flow-processes/main.js"></script>
</section>

@endsection