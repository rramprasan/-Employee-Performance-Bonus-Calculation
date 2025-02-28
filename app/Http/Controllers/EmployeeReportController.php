<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;


class EmployeeReportController extends Controller
{
    public function getEmployeeBonusReport()
    {
        $employees = Employee::with(['user', 'bonuses'])->get();

        $report = $employees->map(function ($employee) {
            return [
                'employee_id' => $employee->id,
                'name' => $employee->name,
                'email' => $employee->email,
                'salary' => $employee->salary,
                'total_bonus' => $employee->bonuses->sum('bonus_amount'),
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $report
        ]);
    }
}
