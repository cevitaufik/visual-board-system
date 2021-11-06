@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<h1 class="fw-bold mb-4 mt-3">Daftar pengguna</h1>

@if (session()->has('success'))    
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <p class="m-0 p-0">{{ session('success') }}</p>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<a href="/user/create" class="btn btn-primary mb-3">Tambah pengguna baru</a>

<div class="my-bg-element rounded-3 overflow-auto">
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama lengkap</th>
        <th scope="col">Nama pengguna</th>
        <th scope="col">Email</th>
        <th scope="col">Posisi</th>
        <th scope="col">Hak akses tambahan</th>
        <th scope="col">Status</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        @if ($user->position == 'superadmin')
            @continue
        @endif
        <tr>
          <td scope="row">{{ $loop->index }}</td>
          <td class="text-capitalize">{{ $user->name }}</td>
          <td>{{ $user->username }}</td>
          <td>{{ $user->email }}</td>
          <td class="text-capitalize">{{ $user->position }}</td>
          <td>
            @if (isset($user->access))
              @foreach ($user->access as $access)
              <ul class="mb-0">
                <li>{{ $access }}</li>
              </ul>
              @endforeach
            @else
              tidak ada
            @endif            
          </td>
          <td>{{ ($user->status) ? 'Aktif' : 'Nonaktif' }}</td>
          <td>
            <div>
              <a href="/user/{{ $user->username }}" class="badge bg-primary my-hover">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
              </a>
              <a href="/user/{{ $user->username }}/edit" class="badge bg-warning my-hover">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                </svg>
              </a>
              <form action="{{ route('user.destroy', $user->username) }}" method="post" class="d-inline-block">
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
</div>

@endsection