<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumne extends Model
{
    use HasFactory;

    // Define els atributs que es poden assignar massivament
    protected $fillable = ['nom', 'cognom', 'data_naixement', 'nif', 'classe_id'];

    /**
     * Relació de l'alumne amb la classe.
     * Un alumne pertany a una classe.
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
