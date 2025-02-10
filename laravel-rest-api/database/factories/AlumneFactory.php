<?php

namespace Database\Factories;

use App\Models\Alumne;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlumneFactory extends Factory
{
    protected $model = Alumne::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->firstName,    // Genera un nom aleatori per a l'alumne
            'cognom' => $this->faker->lastName,  // Genera un cognom aleatori
            'data_naixement' => $this->faker->date,  // Genera una data de naixement aleatòria
            'nif' => $this->faker->unique()->word, // Genera un NIF aleatori
            'classe_id' => Classe::factory(), // Utilitza una classe generada aleatòriament per a cada alumne
        ];
    }
}
