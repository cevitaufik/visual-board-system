@if (!count($tools))
  <h3>Belum ada produk</h3>
@else
  @foreach ($tools as $tool)
  <tr class="my-cursor row-data" data-id="{{ $tool->drawing }}">
    <td scope="row">{{ $loop->iteration }}</td>
    <td>{{ $tool->cust_code }}</td>
    <td>{{ $tool->code }}</td>

    <td>
      @if (strlen($tool->description) > 20)
      {{ substr($tool->description, 0, 20) . '...'; }}
      @else
      {{ $tool->description; }}
      @endif
    </td>

    <td>{{ $tool->drawing }}</td>
    <td>{{ $tool->dwg_customer }}</td>
    <td>{{ $tool->dwg_production }}</td>
  </tr>
  @endforeach
@endif