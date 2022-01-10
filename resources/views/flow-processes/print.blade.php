<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/print.css">
  <title>{{ $order->shop_order }}</title>
</head>

<body>

  <div class="no-print">
    <span class="btn-print" onclick="window.print(), window.close()">Print</span>
    <span class="btn-close" onclick="window.close()">close</span>
  </div>

  @if (count(unserialize($order->flow_process)) <= 6) 
  <div class="content">
    @include('flow-processes.layouts.header-print')

    <div class="process-container">
      <table>
        <thead>
          @include('flow-processes.layouts.table-head-print')
        </thead>
        <tbody>
          @foreach (unserialize($order->flow_process) as $process)
          <tr>
            <td>
              <div class="text-center flow-info">
                {{ $loop->iteration * 10 }}
              </div>
            </td>
            @include('flow-processes.layouts.table-data-print')
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="footer">
      @include('flow-processes.layouts.footer-print')
    </div>
    </div>

    @else

    @php
      $data = unserialize($order->flow_process);
      $arrayProcesses = [];
      $arrayProcesses[0] = array_slice($data, 0, 6, true);

      $tmp = array_slice($data, 6, count($data) - 6, true);
      $part = array_chunk($tmp, 10, true);

      foreach ($part as $p) {
        array_push($arrayProcesses, $p);
      }
      
      $totalPage = count($arrayProcesses);
    @endphp

    <div class="content">
      @include('flow-processes.layouts.header-print')

      <div class="process-container">
        <table>
          <thead>
            @include('flow-processes.layouts.table-head-print')
          </thead>
          <tbody>
            @foreach ($arrayProcesses[0] as $process)
            <tr>
              <td>
                <div class="text-center flow-info">
                  {{ $loop->iteration * 10 }}
                </div>
              </td>
              @include('flow-processes.layouts.table-data-print')
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="footer">
        @include('flow-processes.layouts.footer-print')
      </div>
    </div>

    @foreach ($arrayProcesses as $processes)
      @if ($loop->first) @continue @endif

      @php
        $op = array_keys($processes);
      @endphp

      <div class="content">
        <div class="process-container">
          <table>
            <thead>
              @include('flow-processes.layouts.table-head-print')
            </thead>
            <tbody>
              @foreach ($processes as $process)
              <tr>
                <td>
                  <div class="text-center flow-info">
                    {{ $op[$loop->index] }}
                  </div>
                </td>
                @include('flow-processes.layouts.table-data-print')
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="footer">
          @include('flow-processes.layouts.footer-print')
        </div>
      </div>

      @endforeach

    @endif

</body>

</html>