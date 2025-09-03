<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'contact_info',
        'user_id',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
