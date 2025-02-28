@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')
    <h2>Add Employee</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Salary:</label>
            <input type="number" name="salary" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label>Performance Score (1-100):</label>
            <input type="number" name="performance_score" class="form-control" min="1" max="100" required>
        </div>

        <button type="submit" class="btn btn-success">Save Employee</button>
    </form>
@endsection
