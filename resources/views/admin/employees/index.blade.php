@extends('layouts.app')

@section('title', 'Manage Employees')

@section('content')
    <h2>Employees</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Salary</th>
                <th>Performance Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>${{ $employee->salary }}</td>
                    <td>{{ $employee->performance_score }}</td>
                    <td>
                    @if(auth()->user()->can('edit employees'))
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning">Edit</a>
            @endif

            @if(auth()->user()->can('delete employees'))
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                </form>
            @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
