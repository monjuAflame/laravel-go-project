<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Module;


class Permission extends Model
{
    use HasFactory;

    protected $gurded = ['id'];

    public function module(){

        return $this->belongsTo(Module::class);

    }

    public function roles(){

        return $this->belongsToMany(Role::class);

    }


}
