<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function Role()
    {
        return $this->hasMany(UserManagement::class, 'role_id', 'id');   //if hasMany UserManagement = 'role_id' , Role = 'id'

        //if hasMany return $this->hasMany(RelatedModel::class, 'foreign_key', 'local_key');

        // RelatedModel::class → The child model.
        // foreign_key → The column in the child table that links to this model.
        // local_key → The primary key in this model.   

        // example
        // return $this->hasMany(UserManagement::class, 'UserManagement_id', 'Role_id'); 


    }
}
