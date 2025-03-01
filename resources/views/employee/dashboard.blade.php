@extends('layouts.app')

@section('title', 'Employee Dashboard')

@section('content')
    <h2>Welcome, {{ $employee->name }}!</h2>
    
    <p>Base Salary: <strong>{{ number_format($employee->salary, 2) }}</strong></p>

    <p>Performance Bonus: <strong>{{ number_format($performanceBonus['amount'], 2) }}</strong> ({{ $performanceBonus['reason'] }})</p>
    <p>Additional Bonuses: <strong>{{ number_format($bonuses->sum('bonus_amount'), 2) }}</strong></p>
    <p><strong>Total Salary (Including Bonuses): {{ number_format($finalSalary, 2) }}</strong></p>

    <h3>Your Bonuses</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Bonus Amount</th>
                <th>Reason</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ number_format($performanceBonus['amount'], 2) }}</td>
                <td>{{ $performanceBonus['reason'] }}</td>
                <td>N/A</td>
            </tr>
            @foreach ($bonuses as $bonus)
                <tr>
                    <td>{{ number_format($bonus->bonus_amount, 2) }}</td>
                    <td>{{ $bonus->bonus_reason }}</td>
                    <td>{{ $bonus->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
