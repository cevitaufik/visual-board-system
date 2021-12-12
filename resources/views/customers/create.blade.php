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

<body class="my-bg-element pb-5">
  <main class="container-fluid p-3">
    <form action="/customer" method="POST">
      @csrf

      <div class="row">
        <h3 class="col">Tambah customer baru</h3>
      </div>

      @if (session()->has('success'))    
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <p class="m-0 p-0">{{ session('success') }}</p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="row mb-3">
        <div class="col-lg-12">
          <div class="row px-2 m-0 p-0">

            <div class="col-sm-6 p-1">
              <label for="name" class="d-block">Nama perusahaan</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required>
              @error('name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-3 p-1">
              <label for="email" class="d-block">Email</label>
              <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}">
              @error('email')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="col-sm-3 p-1">
              <label for="phone" class="d-block">Nomor telpon</label>
              <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone') }}">
              @error('phone')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

          </div>

          <div class="col-12 px-2 m-0 p-0">
            <div class="p-1">
              <label for="address" class="d-block">Alamat</label>
              <textarea name="address" style="height: 100px"
                class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
              @error('address')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <hr>

          <h3>Kontak</h3>

          @if (old('contact_person.1'))
              @foreach (old('contact_person') as $contact)
                <div class="row m-0 p-0" id="contact-person-{{ $loop->index }}">

                  <div class="row m-0 p-0">
                    <div class="col-sm-6 mt-2">
                      <label for="contact_name" class="d-block">Nama</label>
                      <input type="text" name="contact_person[{{ $loop->index }}][name]" class="form-control" value="{{ old('contact_person.'. $loop->index .'.name') }}">
                    </div>
      
                    <div class="col-sm-6 mt-2">
                      <label for="contact_position" class="d-block">Jabatan</label>
                      <input type="text" name="contact_person[{{ $loop->index }}][position]" class="form-control" value="{{ old('contact_person.'. $loop->index .'.position') }}">
                    </div>
                  </div>
      
                  <div class="row pt-2 m-0 ps-0 pe-0 mb-3">
                    <div class="col-md-6 mt-2">
                      <label for="contact_email" class="d-block">Email</label>
      
                      <div class="row" id="contact_email_{{ $loop->index }}_row">
      
                        @if (old('contact_person.'. $loop->index .'.email.1'))
                          @foreach (old('contact_person.'. $loop->index .'.email') as $email)

                          {{-- iiiiiiiiiiiii --}}

                            <div class="col-9 mt-2 input-email" id="input_contact_email_{{ $loop->parent->index }}_{{ $loop->iteration }}" data-numberemail="{{ $loop->iteration }}">
                              <input type="text" name="contact_person[{{ $loop->parent->index }}][email][]" class="form-control" value="{{ old('contact_person.'.$loop->parent->index.'.email.' . $loop->index) }}">
                            </div>
        
                            <div class="col-3 mt-2" id="action_contact_email_{{ $loop->iteration }}">
                              <span class="badge bg-success add-btn mt-2" onclick="addRowEmail({{ $loop->parent->index }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                  class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                                  <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                  <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                              </span>
        
                              <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail({{ $loop->parent->index }}, {{ $loop->index }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                  class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                                  <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                  <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                              </span>
                            </div>  
                          
                          @endforeach
                        @else
                          <div class="col-9 mt-2 input-email" id="input_contact_email_{{ $loop->index }}_1" data-numberemail="1">
                            <input type="text" name="contact_person[{{ $loop->index }}][email][]" class="form-control" value="{{ old('contact_person.'. $loop->index .'.email.0') }}">
                          </div>
      
                          <div class="col-3 mt-2" id="action_contact_email_{{ $loop->index }}_1">
                            <span class="badge bg-success add-btn mt-2" onclick="addRowEmail({{ $loop->index }})">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                                <path
                                  d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                <path
                                  d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                              </svg>
                            </span>
      
                            <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail({{ $loop->index }}, 1)">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                                <path
                                  d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                <path
                                  d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                              </svg>
                            </span>
                          </div>
                        @endif
      
                      </div>
      
                    </div>

                      {{-- ininininininininin --}}
                      
                    <div class="col-md-6 mt-2">
                      <label for="contact_phone" class="d-block">Nomor telpon</label>
      
                      <div class="row" id="contact_phone_0_row">
      
                        @if (old('contact_person.'. $loop->index .'.phone.1'))
                          @foreach (old('contact_person.'.$loop->index.'.phone') as $phone)
                            <div class="col-9 mt-2 input-phone" id="input_contact_phone_{{ $loop->parent->index }}_{{ $loop->iteration }}" data-numberphone="{{ $loop->iteration }}">
                              <input type="text" name="contact_person[{{ $loop->parent->index }}][phone][]" class="form-control" value="{{ old('contact_person.'.$loop->parent->index.'.phone.' . $loop->index) }}">
                            </div>
          
                            <div class="col-3 mt-2" id="action_contact_phone_{{ $loop->parent->index }}_{{ $loop->iteration }}">
                              <span class="badge bg-success add-btn mt-2" onclick="addRowPhone({{ $loop->parent->index }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                  class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                                  <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                  <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                </svg>
                              </span>
          
                              <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone({{ $loop->parent->index }}, {{ $loop->iteration }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                  class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                                  <path
                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                  <path
                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                </svg>
                              </span>
                            </div>
                          @endforeach
                        @else
                          <div class="col-9 mt-2 input-phone" id="input_contact_phone_{{ $loop->index }}_1" data-numberphone="1">
                            <input type="text" name="contact_person[{{ $loop->index }}][phone][]" class="form-control" value="{{ old('contact_person.'.$loop->index.'.phone.0') }}">
                          </div>
      
                          <div class="col-3 mt-2" id="action_contact_phone_{{ $loop->index }}_1">
                            <span class="badge bg-success add-btn mt-2" onclick="addRowPhone({{ $loop->index }})">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                                <path
                                  d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                <path
                                  d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                              </svg>
                            </span>
      
                            <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone({{ $loop->index }}, 1)">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                                <path
                                  d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                <path
                                  d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                              </svg>
                            </span>
                          </div>
                        @endif                  
      
                      </div>
      
                    </div>
      
                  </div>
      
                  <div class="mb-3 d-flex justify-content-center" id="add-contact-0">
                    <div class="btn btn-primary" onclick="addContact({{ $loop->index }})">Tambah kontak lainnya</div>
                  </div>
                  <hr>
                </div>
              @endforeach
          @else
            <div class="row m-0 p-0" id="contact-person-0">

              <div class="row m-0 p-0">
                <div class="col-sm-6 mt-2">
                  <label for="contact_name" class="d-block">Nama</label>
                  <input type="text" name="contact_person[0][name]" class="form-control" value="{{ old('contact_person.0.name') }}">
                </div>

                <div class="col-sm-6 mt-2">
                  <label for="contact_position" class="d-block">Jabatan</label>
                  <input type="text" name="contact_person[0][position]" class="form-control" value="{{ old('contact_person.0.position') }}">
                </div>
              </div>

              <div class="row pt-2 m-0 ps-0 pe-0 mb-3">
                <div class="col-md-6 mt-2">
                  <label for="contact_email" class="d-block">Email</label>

                  <div class="row" id="contact_email_0_row">

                    @if (old('contact_person.0.email.1'))
                      @foreach (old('contact_person.0.email') as $email)                    

                        <div class="col-9 mt-2 input-email" id="input_contact_email_0_{{ $loop->iteration }}" data-numberemail="{{ $loop->iteration }}">
                          <input type="text" name="contact_person[0][email][]" class="form-control" value="{{ old('contact_person.0.email.' . $loop->index) }}">
                        </div>
    
                        <div class="col-3 mt-2" id="action_contact_email_{{ $loop->iteration }}">
                          <span class="badge bg-success add-btn mt-2" onclick="addRowEmail(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                              <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                              <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                          </span>
    
                          <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail(0, {{ $loop->index }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                              <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                              <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                          </span>
                        </div>  
                      
                      @endforeach
                    @else
                      <div class="col-9 mt-2 input-email" id="input_contact_email_0_1" data-numberemail="1">
                        <input type="text" name="contact_person[0][email][]" class="form-control" value="{{ old('contact_person.0.email.0') }}">
                      </div>

                      <div class="col-3 mt-2" id="action_contact_email_0_1">
                        <span class="badge bg-success add-btn mt-2" onclick="addRowEmail(0)">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                            <path
                              d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path
                              d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                          </svg>
                        </span>

                        <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail(0, 1)">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                            <path
                              d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path
                              d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                          </svg>
                        </span>
                      </div>
                    @endif

                  </div>

                </div>

                <div class="col-md-6 mt-2">
                  <label for="contact_phone" class="d-block">Nomor telpon</label>

                  <div class="row" id="contact_phone_0_row">

                    @if (old('contact_person.0.phone.1'))
                      @foreach (old('contact_person.0.phone') as $phone)
                        <div class="col-9 mt-2 input-phone" id="input_contact_phone_0_{{ $loop->iteration }}" data-numberphone="{{ $loop->iteration }}">
                          <input type="text" name="contact_person[0][phone][]" class="form-control" value="{{ old('contact_person.0.phone.' . $loop->index) }}">
                        </div>
      
                        <div class="col-3 mt-2" id="action_contact_phone_0_{{ $loop->iteration }}">
                          <span class="badge bg-success add-btn mt-2" onclick="addRowPhone(0)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                              <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                              <path
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                          </span>
      
                          <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone(0, {{ $loop->iteration }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                              class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                              <path
                                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                              <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                          </span>
                        </div>
                      @endforeach
                    @else
                      <div class="col-9 mt-2 input-phone" id="input_contact_phone_0_1" data-numberphone="1">
                        <input type="text" name="contact_person[0][phone][]" class="form-control" value="{{ old('contact_person.0.phone.0') }}">
                      </div>

                      <div class="col-3 mt-2" id="action_contact_phone_0_1">
                        <span class="badge bg-success add-btn mt-2" onclick="addRowPhone(0)">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                            <path
                              d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path
                              d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                          </svg>
                        </span>

                        <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone(0, 1)">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                            <path
                              d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path
                              d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                          </svg>
                        </span>
                      </div>
                    @endif                  

                  </div>

                </div>

              </div>

              <div class="mb-3 d-flex justify-content-center" id="add-contact-0">
                <div class="btn btn-primary" onclick="addContact(0)">Tambah kontak lainnya</div>
              </div>
              <hr>
            </div>
          @endif          

        </div>
      </div>

      <div class="position-fixed bottom-0 end-0 m-3">
        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Simpan</button>
      </div>
    </form>
  </main>

  <script src="/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script>
    // menambah baris email
    function addRowEmail(index) {
      let numberemail = $(`#contact-person-${index} .input-email`).last().data('numberemail') + 1

      $(`#contact_email_${index}_row`).append(
        `
        <div class="col-9 mt-2 input-email" id="input_contact_email_${index}_${numberemail}" data-numberemail="${numberemail}">
          <input type="text" name="contact_person[${index}][email][]" class="form-control" value="{{ old('contact_person.${index}.email.${numberemail}') }}">
        </div>

        <div class="col-3 mt-2" id="action_contact_email_${index}_${numberemail}">
          <span class="badge bg-success add-btn mt-2" onclick="addRowEmail(${index})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
          </span>

          <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail(${index}, ${numberemail})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-x-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
          </span>
        </div>
        `
      )
    }

    // menghapus baris email
    function deleteRowEmail(index, row) {
      $(`#input_contact_email_${index}_${row}`).remove()
      $(`#action_contact_email_${index}_${row}`).remove()
    }

    // menambah baris nomor telpon
    function addRowPhone(index) {
      let numberphone = $(`#contact-person-${index} .input-phone`).last().data('numberphone') + 1

      $(`#contact_phone_${index}_row`).append(
        `
        <div class="col-9 mt-2 input-phone" id="input_contact_phone_${index}_${numberphone}" data-numberphone="${numberphone}">
          <input type="text" name="contact_person[${index}][phone][]" class="form-control" value="{{ old('contact_person.${index}.phone.${numberphone}') }}">
        </div>

        <div class="col-3 mt-2" id="action_contact_phone_${index}_${numberphone}">
          <span class="badge bg-success add-btn mt-2" onclick="addRowPhone(${index})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
          </span>

          <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone(${index}, ${numberphone})">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-x-square my-hover" viewBox="0 0 16 16">
              <path
                d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
              <path
                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
            </svg>
          </span>
        </div>
        `
      )

      ++numberphone
    }

    // menghapus baris nomor telpon
    function deleteRowPhone(index, row) {
      $(`#input_contact_phone_${index}_${row}`).remove()
      $(`#action_contact_phone_${index}_${row}`).remove()
    }

    //menambah kontak baru
    function addContact(index) {

      $(`#add-contact-${index}`).addClass('d-none')

      let newIndex = index + 1
      $(`#contact-person-${index}`).after(
        `
        <div class="row m-0 p-0" id="contact-person-${newIndex}">

          <div class="row m-0 p-0">
            <div class="col-sm-6 mt-2">
              <label for="contact_name" class="d-block">Nama</label>
              <input type="text" name="contact_person[${newIndex}][name]" class="form-control" value="{{ old('contact_person.${newIndex}.name') }}">
            </div>

            <div class="col-sm-6 mt-2">
              <label for="contact_position" class="d-block">Jabatan</label>
              <input type="text" name="contact_person[${newIndex}][position]" class="form-control" value="{{ old('contact_person.${newIndex}.position') }}">
            </div>
          </div>

          <div class="row pt-2 m-0 ps-0 pe-0 mb-3">
            <div class="col-md-6 mt-2">
              <label for="contact_email" class="d-block">Email</label>

              <div class="row" id="contact_email_${newIndex}_row">

                @if (old('contact_person.${newIndex}.email.1'))
                  @foreach (old('contact_person.${newIndex}.email') as $email)                    

                    <div class="col-9 mt-2 input-email" id="input_contact_email_${newIndex}_{{ $loop->iteration }}" data-numberemail="{{ $loop->iteration }}">
                      <input type="text" name="contact_person[${newIndex}][email][]" class="form-control" value="{{ old('contact_person.${newIndex}.email.' . $loop->index) }}">
                    </div>

                    <div class="col-3 mt-2" id="action_contact_email_{{ $loop->iteration }}">
                      <span class="badge bg-success add-btn mt-2" onclick="addRowEmail(${newIndex})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                          <path
                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                          <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                      </span>

                      <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail(${newIndex}, {{ $loop->index }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                          <path
                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                          <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                      </span>
                    </div>  
                  
                  @endforeach
                @else
                  <div class="col-9 mt-2 input-email" id="input_contact_email_${newIndex}_1" data-numberemail="1">
                    <input type="text" name="contact_person[${newIndex}][email][]" class="form-control" value="{{ old('contact_person.${newIndex}.email.0') }}">
                  </div>

                  <div class="col-3 mt-2" id="action_contact_email_${newIndex}_1">
                    <span class="badge bg-success add-btn mt-2" onclick="addRowEmail(${newIndex})">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                        <path
                          d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        <path
                          d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                      </svg>
                    </span>

                    <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowEmail(${newIndex}, 1)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                        <path
                          d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        <path
                          d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                      </svg>
                    </span>
                  </div>
                @endif

              </div>

            </div>

            <div class="col-md-6 mt-2">
              <label for="contact_phone" class="d-block">Nomor telpon</label>

              <div class="row" id="contact_phone_${newIndex}_row">

                @if (old('contact_person.${newIndex}.phone.1'))
                  @foreach (old('contact_person.${newIndex}.phone') as $phone)
                    <div class="col-9 mt-2 input-phone" id="input_contact_phone_${newIndex}_{{ $loop->iteration }}" data-numberphone="{{ $loop->iteration }}">
                      <input type="text" name="contact_person[${newIndex}][phone][]" class="form-control" value="{{ old('contact_person.${newIndex}.phone.' . $loop->index) }}">
                    </div>

                    <div class="col-3 mt-2" id="action_contact_phone_${newIndex}_{{ $loop->iteration }}">
                      <span class="badge bg-success add-btn mt-2" onclick="addRowPhone(${newIndex})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                          <path
                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                          <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                      </span>

                      <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone(${newIndex}, {{ $loop->iteration }})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                          class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                          <path
                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                          <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                        </svg>
                      </span>
                    </div>
                  @endforeach
                @else
                  <div class="col-9 mt-2 input-phone" id="input_contact_phone_${newIndex}_1" data-numberphone="1">
                    <input type="text" name="contact_person[${newIndex}][phone][]" class="form-control" value="{{ old('contact_person.${newIndex}.phone.0') }}">
                  </div>

                  <div class="col-3 mt-2" id="action_contact_phone_${newIndex}_1">
                    <span class="badge bg-success add-btn mt-2" onclick="addRowPhone(${newIndex})">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-plus-square my-hover" viewBox="0 0 16 16">
                        <path
                          d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        <path
                          d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                      </svg>
                    </span>

                    <span class="badge bg-danger delete-btn ms-1 mt-2" onclick="deleteRowPhone(${newIndex}, 1)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-square my-hover" viewBox="0 0 16 16">
                        <path
                          d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                        <path
                          d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                      </svg>
                    </span>
                  </div>
                @endif                  

              </div>

            </div>

          </div>

          <div class="mb-3 d-flex justify-content-center" id="add-contact-${newIndex}">
            <div class="btn btn-primary" onclick="addContact(${newIndex})">Tambah kontak lainnya</div>
          </div>

          <hr>
        </div>        
        `
      )      
    }

  </script>
</body>

</html>