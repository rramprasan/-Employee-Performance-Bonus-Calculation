@extends('layouts.app')

@section('title', 'Bonuses List')

@section('content')
    <h2>Bonuses List</h2>
    <a href="{{ route('bonuses.create') }}" class="btn btn-primary">Assign New Bonus</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Bonus Amount</th>
                <th>Reason</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bonuses as $bonus)
                <tr>
                    <td>{{ $bonus->employee->name }}</td>
                    <td>${{ $bonus->bonus_amount }}</td>
                    <td>{{ $bonus->bonus_reason }}</td>
                    <td>
                        <a href="{{ route('bonuses.edit', $bonus->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('bonuses.destroy', $bonus->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
