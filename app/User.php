<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'persona_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    /**
     * Funcion que recive un array de roles o un rol y chequea si el usuario tiene alguno de los roles o el rol asociado
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles){
        if(is_array($roles)){
            foreach ($roles as $role){
                if($this->hasRole($role)){
                    return true;
                }
            }
        } else {
            if($this->hasRole($roles)){
                return true;
            }
        }
        return false;
    }

    public function hasRole(string $role){
        if($this->roles()->where('nombre','=',$role)->first()){
            return true;
        }
        return false;
    }

}
