<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batiment extends Model
{
    //
    protected $with = ['cite'];
    public function cite()
    {
       return $this->belongsTo('App\Cite', 'cite_id');
    }
    public function paliers()
    {
        return $this->hasMany('App\Palier', 'batiment_id');
    }
}
