@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')
    <h2>Edit Employee</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
    </div>

    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
    </div>

    <div class="form-group">
        <label>New Password (Optional):</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label>Salary:</label>
        <input type="number" name="salary" class="form-control" value="{{ $employee->salary }}" step="0.01" required>
    </div>

    <div class="form-group">
        <label>Performance Score (1-100):</label>
        <input type="number" name="performance_score" class="form-control" value="{{ $employee->performance_score }}" min="1" max="100" required>
    </div>

    @if(auth()->user()->hasRole('admin'))
        <div class="form-group">
            <label>Assign Roles:</label>
            @foreach($roles as $id => $name)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" value="{{ $name }}" 
                        {{ $employee->user->hasRole($name) ? 'checked' : '' }}>
                    <label>{{ ucfirst($name) }}</label>
                </div>
            @endforeach
        </div>
    @endif

    <button type="submit" class="btn btn-primary">Update Employee</button>
</form>

@endsection
