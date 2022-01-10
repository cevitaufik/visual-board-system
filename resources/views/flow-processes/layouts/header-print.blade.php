<div class="header-container">
  <div class="header">
    WORK ORDER
  </div>
  <div class="sub-header">
    {{ $order->cust_code . ' - ' . $order->shop_order }}
  </div>
  <div class="qr-code">
    {!! QrCode::size(114)->generate($order->shop_order) !!}
  </div>
</div>

<div class="general-info-container">
  <div class="left-info">
    <table>
      <tr>
        <td>Deskripsi</td>
        <td>: {{ $order->description }}</td>
      </tr>
      <tr>
        <td>Kode tool</td>
        <td>: {{ $order->tool_code }}</td>
      </tr>
      <tr>
        <td>Noomor drawing</td>
        <td>: {{ $order->no_drawing }}</td>
      </tr>
      <tr>
        <td>Tipe pekerjaan</td>
        <td>: {{ $order->job_type_code}}</td>
      </tr>
    </table>
  </div>

  <div class="right-info">
    <table>
      <tr>
        <td>Quantity</td>
        <td>: {{ $order->quantity }} pcs</td>
      </tr>
      <tr>
        <td>Nomor PO</td>
        <td>: {{ $order->po_number }}</td>
      </tr>
      <tr>
        <td>Tanggal order</td>
        <td>: {{ date('d F Y', strtotime($order->created_at)) }}</td>
      </tr>
      <tr>
        <td>Target kirim</td>
        <td>: {{ date('d F Y', strtotime($order->due_date)) }}</td>
      </tr>
    </table>
  </div>
</div>

<div class="order-note">
  <p><strong>Catatan:</strong> {{ $order->note }}</p>
</div>