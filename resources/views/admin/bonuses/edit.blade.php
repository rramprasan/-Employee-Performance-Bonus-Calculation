@extends('layouts.app')

@section('title', 'Assign Bonus')

@section('content')
    <h2>Assign Bonus</h2>

    <form action="{{ route('bonuses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Employee:</label>
            <select name="employee_id" class="form-control" required>
                <option value="">Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Bonus Amount:</label>
            <input type="number" name="bonus_amount" class="form-control" required min="0" step="0.01">
        </div>

        <div class="form-group">
            <label>Bonus Reason:</label>
            <input type="text" name="bonus_reason" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Assign Bonus</button>
    </form>
@endsection
