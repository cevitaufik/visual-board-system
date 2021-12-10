@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<div class="pagetitle">
  <h1>Customers</h1>
</div>

<a onclick="add()" class="btn btn-primary mb-3">Tambah customer baru</a>

<div id="deletedMsg"></div>

@if (session()->has('success'))    
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <p class="m-0 p-0">{{ session('success') }}</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<section class="section dashboard">
  <div class="row">

    <div class="col-12">
      <div class="card recent-sales my-bg-element">

        <div class="card-body">
          <h5 class="card-title">Daftar produk</h5>

          @if (!count($customers))
            <h3>Belum ada customer</h3>
          @else
          <div class="overflow-auto">
            <table class="table datatable my-text-white">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Kode</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                  <th scope="col">Nomor telpon</th>
                  <th scope="col">Alamat</th>
                </tr>
              </thead>
              <tbody id="table-data">
                @foreach ($customers as $customer)
                <tr class="my-cursor row-data" data-id="{{ $customer->code }}">
                  <td scope="row">{{ $loop->iteration }}</td>
                  <td>{{ $customer->code }}</td>
                  <td>{{ $customer->name }}</td>
                  <td>{{ $customer->email }}</td>
                  <td>{{ $customer->phone }}</td>
                  <td>{{ $customer->address }}</td>
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
                  <button type="button" class="btn btn-danger btn-sm" id="close" title="Tutup">
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
  <script>
    // merefresh table 
    function getTable() {
      $.get(`/customer/table`, {}, function(data) {
        $('#table-data').html(data)
      })
    }

    // menutup modal saat user mengklik tombol close
    $('#close').on('click', function() {
      $('.modal-detail').modal('hide')
      getTable()
    })

    // menutup modal saat user mengklik hapus
    function closeModal(){
      $('.modal-detail').modal('hide')
      getTable()
      $('#deletedMsg').html(`
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="deleted">
          <p class="m-0 p-0">Data berhasil dihapus</p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      `)
    }

    // menampilkan modal tambah data
    function add() {
      $('iframe').attr('src', `/customer/create`)
      $('.modal-detail').modal('show')
    }

    // menampilkan modal
    $('#table-data').on('click', 'tr', function() {
      let id = $(this).data('id');

      $('iframe').attr('src', `/customer/${id}`)
      $('.modal-detail').modal('show')
    })

    // mengatur tinggi iframe
    const height = $(window).height() * 0.92;
    $('iframe').css('height', height +'px');
  </script>
</section>

@endsection