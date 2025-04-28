@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Manage Sensors</h1>

    <a href="{{ route('sensors.create') }}" class="btn btn-primary mb-3">Add New Sensor</a>

    <table class="table">
        <thead>
            <tr>
                <th>Location</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sensors as $sensor)
                <tr>
                    <td>{{ $sensor->location }}</td>
                    <td>{{ $sensor->latitude }}</td>
                    <td>{{ $sensor->longitude }}</td>
                    <td>{{ ucfirst($sensor->status) }}</td>
                    <td>
                        <a href="{{ route('sensors.edit', $sensor->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('sensors.destroy', $sensor->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
