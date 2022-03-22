@php
  
  $SOHasFlowProcess = '';

  if($orders) {
    foreach ($orders as $order) {
      if ($order->flow_process) {
        $SOHasFlowProcess .= $order->shop_order . ',';
      }
    }
  }

@endphp

@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<div class="pagetitle">
  <h1>Dashboard</h1>
  <input type="hidden" id="user-position" value="{{ auth()->user()->position }}">
</div><!-- End Page Title -->

<div class="row">
  <div class="col">
    <form action="/flow-process/bulk-print-wo" method="post">
      @csrf
      <input type="hidden" name="shop_orders" value="{{ $SOHasFlowProcess }}">
      <button type="submit" class="btn btn-primary my-3" formtarget="_blank">
        Bulk print WO
      </button>
    </form>
  </div>
  <div class="col">
    <form action="/order/bulk-print-label" method="post">
      @csrf
      <input type="hidden" name="shop_orders" value="{{ $SOHasFlowProcess }}">
      <button type="submit" class="btn btn-primary my-3" formtarget="_blank">
        Bulk print label
      </button>
    </form>
  </div>
</div>

<section class="section dashboard">
  <div class="row">

    <div class="col">
      <div class="row">

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales my-bg-element overflow-visible">

            <div class="filter my-text-white">
              <a class="icon" href="#" data-bs-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                  height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                  <path
                    d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                </svg></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow my-bg-element border">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>
                <li class="dropdown-item" onclick="filterReset()">Reset</li>

                @foreach ($jobTypes as $jobType)
                  <li class="dropdown-item" onclick="filterJob('{{ $jobType->code }}')">{{ $jobType->code }}</li>
                @endforeach
              </ul>
            </div>

            <div class="card-body">
              <h5 class="card-title">Daftar pekerjaan</h5>

              @if (!count($orders))
              <h3>Belum ada pekerjaan</h3>
              @else
              <div class="overflow-auto">
                <table class="table datatable my-text-white">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Cust.</th>
                      <th scope="col">Nomor SO</th>
                      <th scope="col">Tipe pekerjaan</th>
                      <th scope="col">Deskripsi</th>
                      <th scope="col">Kode tool</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Posisi</th>
                      <th scope="col">Status dwg.</th>
                      <th scope="col">Nomor drawing</th>
                      <th scope="col">Flow process</th>
                    </tr>
                  </thead>
                  <tbody id="table-data">
                    @foreach ($orders as $order)
                    <tr class="my-cursor row-data" data-id="{{ $order->shop_order }}" data-jobtype="{{ $order->jobType->code }}">
                      <td scope="row">{{ $loop->iteration }}</td>
                      <td>{{ $order->cust_code }}</td>
                      <td>{{ $order->shop_order }}</td>
                      <td class="job-type">{{ $order->jobType->code }}</td>

                      <td>
                        @if (strlen($order->description) > 20)
                        {{ substr($order->description, 0, 20) . '...'; }}
                        @else
                        {{ $order->description; }}
                        @endif
                      </td>

                      <td>{{ $order->tool_code }}</td>
                      <td>{{ $order->quantity }}</td>
                      <td>{{ $order->current_process }}</td>
                      <td>
                        @if (isset($order->tool->status))                        
                          {{ $order->tool->status }}
                        @else
                          {{ '' }}
                        @endif
                      </td>
                      <td>{{ $order->no_drawing }}</td>
                      <td>
                        @if ($order->flow_process)
                          <span class="text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                              <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
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
              <div class="modal fade order-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen position-relative">
                  <div class="modal-content my-bg-element p-1">
                    <div class="modal-body p-3 m-0">
                      <iframe src="/{{ auth()->user()->position }}" title="Detail order" class="w-100 d-inline-block"></iframe>
                    </div>
                    <div class="position-absolute top-0 end-0 mt-2 me-3">
                      <button type="button" class="btn btn-danger btn-sm" id="close" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tutup">
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
        </div><!-- End Recent Sales -->

      </div>
    </div><!-- End Left side columns -->
    
  </div>
  <script src="/js/dashboard/main.js"></script>

</section>

@endsection