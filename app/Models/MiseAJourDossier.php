<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiseAJourDossier extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'dossier_id', 'description'
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}
