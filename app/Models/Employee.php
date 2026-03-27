<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name','last_name','email','phone','department_id','position_id','manager_id'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function manager(){
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function subordinates(){
        return $this->hasMany(Employee::class, 'manager_id');
    }
}