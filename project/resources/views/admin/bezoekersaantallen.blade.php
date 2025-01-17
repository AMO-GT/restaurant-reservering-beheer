@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bezoekersaantallen</h1>
    <p>Hier kun je de bezoekersaantallen bekijken.</p>

    <table class="table">
        <thead>
            <tr>
                <th>Datum</th>
                <th>Dag</th> <!-- Nieuwe kolom voor de dag van de week -->
                <th>Aantal Bezoekers</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->date }}</td>
                    <td>{{ ucfirst($visitor->day) }}</td> <!-- Toon de dag van de week -->
                    <td>{{ $visitor->count }}</td>
                    <td>
                        <span class="badge 
                            {{ $visitor->status === 'druk' ? 'bg-danger' : ($visitor->status === 'gemiddeld' ? 'bg-warning' : 'bg-success') }}">
                            {{ ucfirst($visitor->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection