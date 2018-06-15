<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public function users(){
        $this->hasMany(User::class);
    }
}
