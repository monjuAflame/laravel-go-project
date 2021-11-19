<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class Module extends Model
{
    use HasFactory;

    protected $gurded = ['id']; 

    public function permissons(){

        return $this->hasMany(Permission::class);

    }


}
