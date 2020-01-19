<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo'
    ];

    public function users(){
        return $this->belongsToMany(
            User::class,
            'department_user',
            'department_id',
            'user_id'
            );
    }
}
