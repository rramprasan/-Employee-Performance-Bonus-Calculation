@extends('layouts.app')

@section('title', 'Assign Bonus')

@section('content')
    <h2>Assign Bonus</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bonuses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Employee:</label>
            <select name="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                <option value="">Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
            @error('employee_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Bonus Amount:</label>
            <input type="number" name="bonus_amount" class="form-control @error('bonus_amount') is-invalid @enderror" 
                   required step="0.01" min="0" value="{{ old('bonus_amount') }}">
            @error('bonus_amount')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label>Bonus Reason:</label>
            <textarea name="bonus_reason" class="form-control @error('bonus_reason') is-invalid @enderror" required>{{ old('bonus_reason') }}</textarea>
            @error('bonus_reason')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Assign Bonus</button>
    </form>
@endsection
