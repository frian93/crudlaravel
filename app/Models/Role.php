<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function Role(){
        return $this->hasMany(UserManagement::class, 'role_id', 'id');   //if hasMany UserManagement = 'role_id' , Role = 'id'
    }
}
