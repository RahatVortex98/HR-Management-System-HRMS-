<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'department_id',
        'min_salary',
        'max_salary',
        'description',
       
    ];
    protected $casts = [
        'min_salary'=>'decimal:2',
        'max_salary'=>'decimal:2',
    ];
    public function deparment(){
        return $this->belongsTo(Department::class);
    }

    public function emplyees(){
        return $this->hasMany(User::class);
    }
}
