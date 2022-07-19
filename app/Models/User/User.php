<?php

namespace App\Models\User;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\UserCode;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\User\Traits\Relationship\UserRelationship;
use App\Models\User\Traits\Scope\UserScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;

/**
 * Class User.
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable,
        UserScope,
        // HasApiTokens,
        // HasFactory,
        UserRelationship;
     
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'email', 'status', 'avatar', 'password', 'gender', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
}
