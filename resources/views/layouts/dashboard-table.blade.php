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
  <td>
    @if (isset($order->tool->status))                        
      {{ $order->tool->status }}
    @else
      {{ '' }}
    @endif
  </td>
  <td>{{ $order->no_drawing }}</td>
  <td>
    @if ($order->flow_process)
      <span class="text-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
          <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
        </svg>
      </span>
    @endif
  </td>
</tr>
@endforeach