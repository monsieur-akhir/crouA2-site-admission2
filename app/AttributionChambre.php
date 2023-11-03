<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributionChambre extends Model
{
    protected $with = ['lit','demande'];

    public function demande()
    {
       return $this->belongsTo('App\Demande', 'demande_id');
    }
    public function lit()
    {
       return $this->belongsTo('App\Lit', 'lit_id');
    }
  
}
