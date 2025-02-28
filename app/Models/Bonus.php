<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bonus extends Model
{
    protected $fillable = ['employee_id', 'bonus_amount', 'bonus_reason'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
