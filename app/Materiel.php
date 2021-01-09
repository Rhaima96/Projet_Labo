<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    protected $fillable = [
        'title','photo','labo_id','user_id'

    ];


        public function labo()
        {
            return $this->belongsTo('App\Labo', 'labo_id', 'id');
        }
    }
