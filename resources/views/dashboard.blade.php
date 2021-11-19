@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<div class="pagetitle">
  <h1>Dashboard</h1>
</div><!-- End Page Title -->

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-9">
      <div class="row">

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales my-bg-element">

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

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
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
                      <th scope="col">Nomor drawing</th>
                    </tr>
                  </thead>
                  <tbody id="table-data">
                    @foreach ($orders as $order)
                    <tr class="my-cursor row-data" data-id="{{ $order->shop_order }}">
                      <td scope="row">{{ $loop->iteration }}</td>
                      <td>{{ $order->cust_code }}</td>
                      <td>{{ $order->shop_order }}</td>
                      <td>{{ $order->jobType->code }}</td>

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
                      <td>{{ $order->dwg_number }}</td>
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

    <!-- Right side columns -->
    <div class="col-lg-3">

      <!-- Recent Activity -->
      <div class="card">
        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <li class="dropdown-header text-start">
              <h6>Filter</h6>
            </li>

            <li><a class="dropdown-item" href="#">Today</a></li>
            <li><a class="dropdown-item" href="#">This Month</a></li>
            <li><a class="dropdown-item" href="#">This Year</a></li>
          </ul>
        </div>

        <div class="card-body">
          <h5 class="card-title">Recent Activity <span>| Today</span></h5>

          <div class="activity">

            <div class="activity-item d-flex">
              <div class="activite-label">32 min</div>
              <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
              <div class="activity-content">
                Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
              </div>
            </div><!-- End activity item-->

            <div class="activity-item d-flex">
              <div class="activite-label">56 min</div>
              <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
              <div class="activity-content">
                Voluptatem blanditiis blanditiis eveniet
              </div>
            </div><!-- End activity item-->

            <div class="activity-item d-flex">
              <div class="activite-label">2 hrs</div>
              <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
              <div class="activity-content">
                Voluptates corrupti molestias voluptatem
              </div>
            </div><!-- End activity item-->

            <div class="activity-item d-flex">
              <div class="activite-label">1 day</div>
              <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
              <div class="activity-content">
                Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
              </div>
            </div><!-- End activity item-->

            <div class="activity-item d-flex">
              <div class="activite-label">2 days</div>
              <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
              <div class="activity-content">
                Est sit eum reiciendis exercitationem
              </div>
            </div><!-- End activity item-->

            <div class="activity-item d-flex">
              <div class="activite-label">4 weeks</div>
              <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
              <div class="activity-content">
                Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
              </div>
            </div><!-- End activity item-->

          </div>

        </div>
      </div><!-- End Recent Activity -->

    </div><!-- End Right side columns -->

  </div>
  <script>
    function getTable() {
      $.get(`/{{ auth()->user()->position }}/table`, {}, function(data) {
        $('#table-data').html(data)
      })
    }

    $('#close').on('click', function() {
      $('.order-detail').modal('hide')
      getTable()
    })

    $('#table-data').on('click', 'tr', function() {
      let id = $(this).data('id');

      $('iframe').attr('src', `/order/${id}`)
      $('.order-detail').modal('show')
    })

    $('#update3').on('click', function() {
      let id = $('#order-detail').find('#shop_order').val()
      let formData = $('#order-detail').serialize()

      $.ajax({
        url: `/order/${id}`,
        method: 'PUT',
        data: formData,
        success: function(data){
          $('.order-detail').modal('hide');
          getTable();
        },
        error: function(error){
          alert('error ' + error.responseText);
          console.log(error);
        }        
      })
    })

    const height = $(window).height() * 0.92;
    $('iframe').css('height', height +'px');
  </script>
</section>

@endsection