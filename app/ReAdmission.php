<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReAdmission extends Model
{
    protected $table = 're_demande';
    public function chambre_attribue()
    {
       return $this->hasOne('App\AttributionChambre', 'demande_id')->where('statut',1);
    }
}
