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
    <h3 class="mb-3">Ubah data kontak</h3>

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="m-0 p-0">{{ session('success') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form action="/customer/contact/{{ $contact->id }}" method="POST">
      @csrf
      @method("PUT")
      <input type="hidden" name="cust_code" value="{{ $contact->cust_code }}">
      <input type="hidden" name="id" value="{{ $contact->id }}">
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="Nama" name="name" value="{{ $contact->name }}">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Jabatan" name="position" value="{{ $contact->position }}">
        </div>
      </div>
      
      @if (strlen($contact->email))
        @foreach (explode(',', $contact->email) as $email)
          <div class="row mt-3 row-email" id="row-email-{{ $loop->index }}" data-rowemail="{{ $loop->index }}">
            <div class="col">
              <input type="text" class="form-control" placeholder="Email" name="email[]" value="{{ $email }}">
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
    
              <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail({{ $loop->index }})">
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
        @endforeach
      @else        
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
      @endif

      @if (strlen($contact->phone))
        @foreach (explode(',', $contact->phone) as $phone)
          <div class="row mt-3 row-phone" id="row-phone-{{ $loop->index }}" data-rowphone="{{ $loop->index }}">
            <div class="col">
              <input type="text" class="form-control" placeholder="Nomor telpon" name="phone[]" value="{{ $phone }}">
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
    
              <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone({{ $loop->index }})">
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
        @endforeach
      @else
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
      @endif

      <div class="row mt-3">
        <button class="col btn btn-primary mx-2" type="submit">Simpan perubahan</button>
      </div>
    </form>
  </main>

  <script src="/js/customers/detail.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>