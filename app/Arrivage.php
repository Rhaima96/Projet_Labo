<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrivage extends Model
{

    protected $dates = ['date'];

    protected $fillable = [
        'mat_id','ref','designation','date','qte','unite','nv','nbs','photo','observation','rs','user_id'

    ];

    public function materiel()
    {
        return $this->belongsTo('App\Materiel', 'mat_id');
    }
}
