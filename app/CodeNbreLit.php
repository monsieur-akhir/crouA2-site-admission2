<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeNbreLit extends Model
{
    protected $table = 'code_nbre_lits';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code',
        'nbre',
        'created_at',
        'updated_at'
    ];

}
