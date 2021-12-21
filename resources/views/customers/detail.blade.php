<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- Vendor CSS Files -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/mycss.css">

  <!-- Jquery -->
  <script src="/js/jquery.js"></script>
</head>

<body class="my-bg-element">
  <main class="container-fluid p-3 mb-5">
    <form action="/customer/{{ $customer->code }}" id="customer-detail" method="POST">
      @method('put')
      @csrf

      <div class="row">
        <h3 class="col">{{ $customer->name }}</h3>
      </div>

      @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <p class="m-0 p-0">{{ session('success') }}</p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="row mb-3">
        <div class="col-lg-12">
          <div class="row px-2">
            <div class="col-sm-1 p-1">
              <label for="code" class="d-block">Kode</label>
              <input type="text" name="code" id="code"
                class="form-control @error('code') is-invalid @enderror"
                value="{{ old('code', $customer->code) }}" disabled>
              @error('code')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-5 p-1">
              <label for="name" class="d-block">Nama</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $customer->name) }}">
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-3 p-1">
              <label for="phone" class="d-block">Nomor telpon</label>
              <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone', $customer->phone) }}">
              @error('phone')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-3 p-1">
              <label for="email" class="d-block">Email</label>
              <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $customer->email) }}">
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="col-12">
            <label for="address" class="d-block">Alamat</label>
            <textarea name="address" style="height: 100px"
              class="form-control @error('address') is-invalid @enderror">{{ old('address', $customer->address) }}</textarea>
            @error('address')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="row px-2">

            <div class="col-md-2 p-1">
              <small>Tanggal dibuat</small>
              <h6>{{ date('d F Y', strtotime($customer->created_at)) }}</h6>
            </div>

            <div class="col-md-2 p-1">
              <small>Terakhir diperbarui</small>
              <h6>{{ date('d F Y', strtotime($customer->updated_at)) }}</h6>
            </div>

          </div>
        </div>

        <hr>        

        <div class="row justify-content-center mb-2">
          <h3 class="text-center">Kontak</h3>
          <div class="btn btn-primary w-auto" onclick="addContactModal()">Tambah kontak</div>
        </div>

        @if (count($customer->contacts))
          <div class="row row-cols-1 row-cols-md-3 g-4 mt-0">            
            @foreach ($customer->contacts as $contact)

              <div class="col">
                <div class="card h-100 p-2 border">

                  <div class="card-body">

                    <div class="mb-2 mt-1 border-bottom">
                      <h5 class="mb-0 pb-0">{{ ucwords($contact->name) }}</h5>
                      <small>{{ $contact->position }}</small>
                    </div>

                    <div class="mt-1">
                      @if (strlen($contact->email))
                        <h6>Email</h6>
                        @foreach (explode(',', $contact->email) as $email)
                          <p class="mb-0 pb-0">{{ $email }}</p>
                        @endforeach
                        <hr>                      
                      @endif
                    </div>
                    <div>
                      @if (strlen($contact->phone))
                        <h6>Nomor telpon</h6>
                        @foreach (explode(',', $contact->phone) as $phone)
                          <p class="mb-0 pb-0">                        
                            @php preg_match('/^08/', $phone, $match) @endphp
                            
                            @if (isset($match[0]))
                              <a href="https://wa.me/{{ preg_replace('/^08/', '628' , $phone) }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                  <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                </svg>
                              </a>
                              {{ $phone }}
                            @else
                              {{ $phone }}
                            @endif
                          </p>
                        @endforeach
                      @endif                    
                    </div>                    

                  </div>

                  <div class="card-footer my-bg-element text-end">
                    <a href="/customer/contact/{{ $contact->id }}/delete" class="btn btn-danger" onclick="confirm('Apakah anda yakin?')">Hapus</a>
                    <a class="btn btn-primary" onclick="editContactModal('{{ $contact->id }}')">Ubah</a>
                  </div>

                </div>
              </div>
            @endforeach
          </div>
        @else 
          <h3>Belum ada kontak</h3>
        @endif

      </div>

      <div class="position-fixed bottom-0 end-0 m-3">
        <a class="btn btn-danger me-3" onclick="confirm('Apakah anda yakin ingin menghapus?'), deleteCust('{{ $customer->code }}')" id="delete">Hapus</a>
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin memperbarui?')">Perbarui</button>
      </div>

    </form>

    <!-- Modal -->
    <div class="modal fade" id="modal-add-contact" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog position-relative">
        <div class="modal-content my-bg-element p-1">
          <div class="modal-body p-3 m-0">
            <h3 class="mb-3">Tambah kontak</h3>
            <form id="new-contact">
              @csrf
              @method("POST")
              <input type="hidden" name="cust_code" value="{{ $customer->code }}">
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Nama" name="name">
                </div>
                <div class="col">
                  <input type="text" class="form-control" placeholder="Jabatan" name="position">
                </div>
              </div>

              <div class="row mt-3 row-email" id="row-email-0" data-rowemail="0">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Email" name="email[]">
                </div>
                <div class="col-3">
                  <span class="badge bg-success add-btn mt-2" onclick="addRowEmail()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                      <path
                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                      <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                  </span>

                  <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                      <path
                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                      <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                  </span>
                </div>
              </div>

              <div class="row mt-3 row-phone" id="row-phone-0" data-rowphone="0">
                <div class="col">
                  <input type="text" class="form-control" placeholder="Nomor telpon" name="phone[]">
                </div>
                <div class="col-3">
                  <span class="badge bg-success add-btn mt-2" onclick="addRowPhone()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                      <path
                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                      <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                  </span>

                  <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                      <path
                        d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                      <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                  </span>
                </div>
              </div>

              <div class="row mt-3">
                <div class="col btn btn-primary mx-2" onclick="addContact()">Tambah</div>
              </div>
            </form>
          </div>
          <div class="position-absolute top-0 end-0 mt-2 me-3">
            <button type="button" class="btn btn-danger btn-sm" id="close" data-bs-toggle="tooltip"
              data-bs-placement="bottom" title="Tutup">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-x-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                  d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal detail contact -->
    <div class="modal fade" id="modal-detail-contact" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog position-relative">
        <div class="modal-content my-bg-element p-1">
          <div class="modal-body p-3 m-0">
            <iframe title="Detail contact" class="w-100 d-inline-block" id="iframe"></iframe>
          </div>
          <div class="position-absolute top-0 end-0 mt-2 me-3">
            <button type="button" class="btn btn-danger btn-sm" id="close-modal-detail-contact" title="Tutup">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
          </button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="/js/customers/detail.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>