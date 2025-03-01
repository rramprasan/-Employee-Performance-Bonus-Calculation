<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bonus;
use App\Models\Employee;
use App\Mail\BonusAssignedMail;
use Illuminate\Support\Facades\Mail;

class BonusController extends Controller
{
    public function index()
    {
        $bonuses = Bonus::with('employee')->get();
        return view('admin.bonuses.index', compact('bonuses'));
    }

    public function create()
    {
        $employees = Employee::get();
        return view('admin.bonuses.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'bonus_amount' => 'required|numeric|min:0',
            'bonus_reason' => 'required|string|max:255',
        ]);
        $employee=Employee::findOrFail($request->employee_id);
        $bonus = Bonus::create([
            'employee_id' => $employee->id,
            'bonus_amount' => $request->bonus_amount,
            'bonus_reason' => $request->bonus_reason,
        ]);
    
        // Send Email with the actual Bonus object
        Mail::to($employee->email)->send(new BonusAssignedMail($employee, $bonus));
        return redirect()->route('bonuses.index')->with('success', 'Bonus assigned successfully.');
    }

    public function edit(Bonus $bonus)
    {
        $employees = User::where('usertype', 'employee')->get();
        return view('admin.bonuses.edit', compact('bonus', 'employees'));
    }

    public function update(Request $request, Bonus $bonus)
    {
        $request->validate([
            'bonus_amount' => 'required|numeric',
            'bonus_reason' => 'required|string',
        ]);

        $bonus->update($request->only(['bonus_amount', 'bonus_reason']));
        return redirect()->route('bonuses.index')->with('success', 'Bonus updated successfully.');
    }

    public function destroy(Bonus $bonus)
    {
        $bonus->delete();
        return redirect()->route('bonuses.index')->with('success', 'Bonus deleted successfully.');
    }

    public function calculateAndAssignBonus()
    {
        $employees = Employee::all();
        $bonuses = [];

        foreach ($employees as $employee) {
            $bonusAmount = 0;
            $bonusReason = null;

            if ($employee->performance_score >= 90) {
                $bonusAmount = $employee->salary * 0.20;
                $bonusReason = "Excellent Performance";
            } elseif ($employee->performance_score >= 70) {
                $bonusAmount = $employee->salary * 0.10;
                $bonusReason = "Good Performance";
            } elseif ($employee->performance_score >= 50) {
                $bonusAmount = $employee->salary * 0.05;
                $bonusReason = "Satisfactory Performance";
            } else {
                $bonusReason = "No Bonus - Performance Below 50";
            }

            if ($bonusAmount > 0) {
                $bonus = Bonus::create([
                    'employee_id'   => $employee->id,
                    'bonus_amount'  => $bonusAmount,
                    'bonus_reason'  => $bonusReason
                ]);

                $bonuses[] = $bonus;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Bonuses calculated and assigned successfully.',
            'data' => $bonuses
        ]);
    }

   
}
