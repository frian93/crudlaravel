<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class UserManagement extends Model
{
    protected $guarded = [];
    use HasFactory;


    public function UserRole(){
        return $this->belongsTo(Role::class, 'role_id' , 'id')  //if belongsTo Role= 'id' ,  UserManagement = 'role_id'
        ->select('id', 'role');
    }

}
