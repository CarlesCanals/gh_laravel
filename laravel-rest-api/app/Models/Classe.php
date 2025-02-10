<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    // Define els atributs que es poden assignar massivament
    protected $fillable = ['grup', 'tutor'];

    /**
     * Relació de la classe amb els alumnes.
     * Una classe té molts alumnes.
     */
    public function alumnes()
    {
        return $this->hasMany(Alumne::class);
    }
}


