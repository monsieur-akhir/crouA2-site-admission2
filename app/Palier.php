<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Palier extends Model
{
    protected $table = 'paliers';
    protected $primaryKey = 'id';
    protected $with = ['batiment'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle',
        'batiment_id',
        'created_at',
        'updated_at'
    ];

    public function batiment()
    {
       return $this->belongsTo('App\Batiment', 'batiment_id');
    }
    public function chambres()
    {
        return $this->hasMany('App\Chambre', 'palier_id');
    }

}
