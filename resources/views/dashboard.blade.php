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
              <table class="table datatable my-text-white">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cust.</th>
                    <th scope="col">Nomor SO</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kode tool</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Posisi</th>
                    <th scope="col">Nomor drawing</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orders as $order)
                    <tr class="my-cursor" data-bs-toggle="modal" data-bs-target="#m{{ $order->shop_order }}">
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $order->cust_code }}</td>
                      <td>{{ $order->shop_order }}</td>

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

                    <!-- Modal -->
                    <div class="modal fade" id="m{{ $order->shop_order }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content my-bg-element">
                          
                          <div class="modal-body">
                            <div class="float-end">
                              <button type="button" class="btn-close float-end fw-bold my-text-white bg-danger lh-lg" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="row">
                              <div class="col-3">
                                <small>Shop order:</small>
                                <h6>{{ $order->shop_order }}</h6>
                                <small>Qty:</small>
                                <h6>{{ $order->quantity }}</h6>
                              </div>
                              <div class="col-3">
                                <small>Tanggal order:</small>
                                <h6>{{ date('d F Y', strtotime($order->created_at)) }}</h6>                                
                                <small>Target kirim:</small>
                                <h6>{{ date('d F Y', strtotime($order->due_date)) }}</h6>
                              </div>
                              <div class="col-3">
                                <small>Tipe pekerjaan:</small>
                                <h6>{{ $order->job_type }}</h6>                                
                                <small>Nomor drawing:</small>
                                <h6>{{ $order->dwg_number }}</h6>
                              </div>
                              <div class="col-3">
                                <small>Cust:</small>
                                <h6>{{ $order->cust_code }}</h6>                                
                                <small>Nomor PO:</small>
                                <h6>{{ $order->po_number }}</h6>
                              </div>
                            </div>

                            <div>
                              <p>Deskripsi : {{ $order->description }}</p>
                              <p>Catatan : {{ $order->order_note }}</p>
                            </div>

                            <div>
                              <p>Dibuat ole: </p>
                              <p>Diedit oleh: </p>
                              <p>Tanggal edit:</p>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </tbody>
              </table>
              @endif

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
</section>

@endsection