@foreach ($orders as $order)
<tr class="my-cursor row-data" data-id="{{ $order->shop_order }}" data-bs-target="#m{{ $order->shop_order }}">
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
  <td>{{ $order->no_drawing }}</td>
</tr>
@endforeach