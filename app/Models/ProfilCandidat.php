<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilCandidat extends Model
{
    protected $fillable = [
        'user_id',
        'specialite',
        'annees_experience',
        'cv',
        'competences'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
