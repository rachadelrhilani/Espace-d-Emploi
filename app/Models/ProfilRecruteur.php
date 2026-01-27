<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilRecruteur extends Model
{
    protected $fillable = [
        'user_id',
        'nom_entreprise',
        'description_entreprise',
        'site_web',
        'localisation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
