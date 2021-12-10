@if (!count($customers))
  <h3>Belum ada customer</h3>
@else
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
@endif