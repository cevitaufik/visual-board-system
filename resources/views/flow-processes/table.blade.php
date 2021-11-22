@if (!count($processes))
  <h3>Belum ada flow process</h3>
@else
  @foreach ($processes as $process)
  <tr class="my-cursor row-data" data-id="{{ $process->id }}">
    <td scope="row">{{ $loop->iteration }}</td>
    <td>{{ $process->no_drawing }}</td>
    <td>{{ $process->op_number }}</td>
    <td>{{ $process->work_center }}</td>

    <td>
      @if (strlen($process->description) > 20)
      {{ substr($process->description, 0, 20) . '...'; }}
      @else
      {{ $process->description }}
      @endif
    </td>

    <td>{{ $process->estimation }} menit</td>
  </tr>
  @endforeach
@endif