<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    protected $fillable = ['user_id', 'name', 'email', 'salary', 'performance_score'];

    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
