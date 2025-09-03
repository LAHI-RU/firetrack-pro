<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'budget',
        'user_id',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
