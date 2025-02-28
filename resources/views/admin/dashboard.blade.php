@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h2>Welcome, Admin!</h2>
    <p>Manage employees and bonuses.</p>

    <a href="{{ route('employees.index') }}" class="btn btn-primary">Manage Employees</a>
    <a href="{{ route('bonuses.index') }}" class="btn btn-success">View Bonuses</a>
@endsection
