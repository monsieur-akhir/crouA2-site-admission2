<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    //
    public function chambre_attribue()
    {
       return $this->hasOne('App\AttributionChambre', 'demande_id')->where('statut',1);
    }
}
