<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amitie extends Model
{
    protected $fillable = [
        'id_expediteur',
        'id_destinataire',
        'statut'
    ];

    public function expediteur()
    {
        return $this->belongsTo(User::class, 'id_expediteur');
    }

    public function destinataire()
    {
        return $this->belongsTo(User::class, 'id_destinataire');
    }
}
