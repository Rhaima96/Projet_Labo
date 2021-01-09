<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manquant extends Model
{
    protected $fillable = [
        'mat_id','m_manquant','qte','unite','resp','date','user_id'

    ];

    public function materiel()
    {
        return $this->belongsTo('App\Materiel', 'mat_id');
    }
}
