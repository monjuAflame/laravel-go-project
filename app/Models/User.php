<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use App\Models\Role;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    protected $guarded = ['id'];

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var string[]
    //  */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role(){
        
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission)
    {
        return $this->role->permissions->where('slug', $permission)->first() ? true : false;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
        ->singleFile();
    }


}
