@extends('layouts.main')

@section('css')

@endsection

@section('main-content')
<table border="1" id="data-table" width="100%">
    <tr>
        <th>Tanggal</th>
        <th>User</th>
        <th>Description</th>
        <th>attachment</th>
    </tr>
    @forelse ($dataTickets as $ticket)
    <tr>
        <td>{{ $ticket->tanggal}}</td>
        <td>{{ $ticket->user}}</td>
        <td>{{ $ticket->description }}</td>
        <td>
            @if (!is_null($ticket->attachment))
            <image src="{{ $ticket->attachment}}" width="300">
            @endif
        </td>
    </tr>
    @empty
    <p>no data</p>
    @endforelse
</table>
@endsection

@section('js')

</script>
@endsection
