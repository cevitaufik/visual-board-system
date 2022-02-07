@extends('layouts.main')
@section('main')
@include('layouts.sidebar')

<h1 class="fw-bold mb-0 mt-3">Kontribusi</h1>
<p class="mb-4">Jumlah output setiap user.</p>

<div class="my-bg-element rounded-3 overflow-auto p-2">
  <table class="table datatable my-text-white">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama penguna</th>
        <th scope="col">Jumlah output</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contributions as $user => $contribution)
        <tr>
          <td scope="row">{{ $loop->iteration }}</td>
          <td><a href="/user/{{ $user}}">{{ $user}}</a></td>
          <td>{{ $contribution }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection