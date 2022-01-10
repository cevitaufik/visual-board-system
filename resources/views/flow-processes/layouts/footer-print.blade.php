<p class="page-id">WORK ORDER <strong>{{ $order->cust_code . ' - ' . $order->shop_order }}</strong></p>
<p class="page-number">{{ ($loop->iteration) ?? 1 }} / {{ ($totalPage) ?? 1 }}</p>
<p class="printed-date">{{ date('d F Y') }}</p>