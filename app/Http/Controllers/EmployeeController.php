<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Bonus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
   
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6', 
            'salary' => 'required|numeric|min:0',
            'performance_score' => 'nullable|integer|min:1|max:100',
        ]);
    
       
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'usertype' => 'employee',
        ]);
    
        
        Employee::create([
            'user_id' => $user->id, 
            'name' => $request->name,
            'email' => $request->email,
            'salary' => $request->salary,
            'performance_score' => $request->performance_score,
        ]);
    
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function edit(Employee $employee)
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.employees.edit', compact('employee','roles'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6', 
            'salary' => 'required|numeric|min:0',
            'performance_score' => 'nullable|integer|min:1|max:100',
        ]);
    
        
        $employee = Employee::findOrFail($employee->id);
        $user = User::findOrFail($employee->user_id);
    
        
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        if (auth()->user()->hasRole('admin')) { 
            $user = $employee->user;
            if ($user) {
               $user->syncRoles($request->roles);
            }
        }
        
        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'salary' => $request->salary,
            'performance_score' => $request->performance_score,
        ]);
    
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
       
        Bonus::where('employee_id',$employee->id)->delete();
        $user=User::find($employee->user_id);
        $user->delete();
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
  

public function dashboard()
{
   
    $employee=Employee::where('user_id',Auth::user()->id)->first();
    $bonuses = Bonus::where('employee_id', $employee->id)->get();
   
    $performanceBonus = $this->calculateBonus($employee->performance_score, $employee->salary);
    $totalBonus = $performanceBonus['amount'] + $bonuses->sum('bonus_amount');
    // dd($totalBonus);
    $finalSalary = $employee->salary + $totalBonus;
    // dd($finalSalary);
    return view('employee.dashboard', compact('employee', 'bonuses', 'performanceBonus', 'totalBonus', 'finalSalary'));
}

private function calculateBonus($score, $salary)
{
    if ($score >= 90) {
        return ['amount' => 0.20 * $salary, 'reason' => 'Excellent Performance'];
    } elseif ($score >= 70) {
        return ['amount' => 0.10 * $salary, 'reason' => 'Good Performance'];
    } elseif ($score >= 50) {
        return ['amount' => 0.05 * $salary, 'reason' => 'Average Performance'];
    } else {
        return ['amount' => 0, 'reason' => 'No Bonus'];
    }
}

}
