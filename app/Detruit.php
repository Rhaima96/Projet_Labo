<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detruit extends Model
{
    protected $fillable = [
        'mat_id','m_detruit','qte','unite','resp','date','user_id'

    ];

    public function materiel()
    {
        return $this->belongsTo('App\Materiel', 'mat_id');
    }
}
