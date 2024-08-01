<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'reference', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function misesAJour()
    {
        return $this->hasMany(MiseAJourDossier::class);
    }
}
