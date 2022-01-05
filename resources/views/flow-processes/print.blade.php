<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/print.css">
  <title>{{ $order->shop_order }}</title>
</head>
<body>
  <div class="content">

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
      <p><b>Catatan:</b> {{ $order->note }}</p>
    </div>

    <div class="process-container">
      <table>
        <thead>
          <tr>
            <th scope="col" class="op">OP</th>
            <th scope="col" class="work-center">WORKC.</th>
            <th scope="col" class="instruction">INSTRUKSI</th>
            <th scope="col" class="estimation">EST. <small>(menit)</small></th>
            <th scope="col" class="qty">QTY</th>
          </tr>
        </thead>
        <tbody>
          @foreach (unserialize($order->flow_process) as $process)
            <tr>
              <td>
                <div class="text-center flow-info">
                  {{ $loop->iteration * 10 }}
                </div>                
              </td>
              <td>
                <div class="text-center flow-info">
                  {{ $process['work_center'] }}
                </div>
              </td>
              <td>
                <div class="flow-info">
                  {{ $process['description'] }}
                  <small class="bottom">Nama operator:</small>
                </div>
              </td>
              <td>
                <div class="text-center flow-info">
                  {{ $process['estimation'] }}
                  <small class="bottom">Tanggal:</small>
                </div>
              </td>
              <td>
                <div class="text-center flow-info">
                  {{ $order->quantity }}
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>