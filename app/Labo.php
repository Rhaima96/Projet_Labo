<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labo extends Model
{
    protected $fillable = [
        'name','photo','l_password','user_id'


    ];

    public function materiel()
    {
        return $this->hasMany('App\Materiel');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
