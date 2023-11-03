<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cite extends Model
{
    public function batiments()
    {
        return $this->hasMany('App\Batiment', 'cite_id');
    }
}
