<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id', 'position', 'identification_number', 'salary', 'hire_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}