<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    //
    protected $with = ['palier'];

    protected $table = 'chambres';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle',
        'palier_id',
        'code_nbre_lit_id',
        'nombre_lit',
        'nbre_restant_lit',
        'created_at',
        'updated_at'
    ];

    public function codeNbreLit()
    {
       return $this->belongsTo('App\CodeNbreLit', 'code_nbre_lit_id');
    }

    public function palier()
    {
       return $this->belongsTo('App\Palier', 'palier_id');
    }

    public function lits()
    {
        return $this->hasMany('App\Lit', 'chambre_id', 'id');
    
    }
}
