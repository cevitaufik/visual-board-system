@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<div class="pagetitle">
  <h1>Produk</h1>
</div>

<a onclick="add()" class="btn btn-primary mb-3">Tambah produk baru</a>

<div id="deletedMsg"></div>

<section class="section dashboard">
  <div class="row">

    <div class="col-12">
      <div class="card recent-sales my-bg-element">

        <div class="card-body pt-2">

          @if (!count($tools))
          <h3>Belum ada produk</h3>
          @else
          <div class="overflow-auto">
            <table class="table datatable my-text-white">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Cust.</th>
                  <th scope="col">Kode</th>
                  <th scope="col">Deskripsi</th>
                  <th scope="col">Drawing</th>
                  <th scope="col">Status</th>
                  <th scope="col">Flow process</th>
                  <th scope="col">Dwg. customer</th>
                  <th scope="col">Dwg. produksi</th>
                </tr>
              </thead>
              <tbody id="table-data">
                @foreach ($tools as $tool)
                <tr class="my-cursor row-data" data-id="{{ $tool->drawing }}">
                  <td scope="row">{{ $loop->iteration }}</td>
                  <td>{{ $tool->cust_code }}</td>
                  <td>{{ $tool->code }}</td>

                  <td>
                    @if (strlen($tool->description) > 20)
                    {{ substr($tool->description, 0, 20) . '...'; }}
                    @else
                    {{ $tool->description; }}
                    @endif
                  </td>

                  <td>{{ $tool->drawing }}</td>
                  <td>{{ $tool->status }}</td>
                  <td class="text-center">
                    @if ($tool->flowProcess)
                      <span class="text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg>
                      </span>
                    @else
                      <span class="text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                      </span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($tool->dwg_customer)
                      <span class="text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg>
                      </span>
                    @else
                      <span class="text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                      </span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if ($tool->dwg_production)
                      <span class="text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg>
                      </span>
                    @else
                      <span class="text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                      </span>
                    @endif
                  </td>
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
                  <button type="button" class="btn btn-danger btn-sm" onclick="closeThis()" title="Tutup">
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
  <script src="/js/tools/main.js"></script>  
</section>

@endsection