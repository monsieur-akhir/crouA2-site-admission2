<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lit extends Model
{
    protected $table = 'lits';
    protected $primaryKey = 'id';
    protected $with = ['chambre'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle',
        'chambre_id',
        'statut_occp_lit',
        'created_at',
        'updated_at'
    ];

    public function chambre()
    {
       return $this->belongsTo('App\Chambre', 'chambre_id');
    }
    public function lits()
    {
        return $this->hasMany('App\Lit', 'chambre_id');
    }
    

}
