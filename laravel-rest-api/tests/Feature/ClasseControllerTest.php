<?php

namespace Tests\Feature;

use App\Models\Classe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClasseControllerTest extends TestCase
{
    use RefreshDatabase;

    /** #[Test] */
    public function test_create_class()
    {
        // Dades per a crear una nova classe
        $data = [
            'grup' => 'A',
            'tutor' => 'Sr. López'
        ];

        // Realitza la petició POST per crear la classe
        $response = $this->postJson('/api/classes', $data);

        // Comprova que la resposta sigui correcta
        $response->assertStatus(201);
        $response->assertJson([
            'grup' => 'A',
            'tutor' => 'Sr. López',
        ]);

        // Comprova que la classe es trobi a la base de dades
        $this->assertDatabaseHas('classes', [
            'grup' => 'A',
            'tutor' => 'Sr. López',
        ]);
    }

    /** #[Test] */
    public function test_get_classes()
    {
        // Crear una classe a la base de dades
        Classe::create([
            'grup' => 'A',
            'tutor' => 'Sr. López'
        ]);

        // Realitzar una petició GET per obtenir les classes
        $response = $this->getJson('/api/classes');

        // Comprovar que la resposta sigui correcta
        $response->assertStatus(200);
        $response->assertJsonCount(1); // Comprova que hi ha 1 classe
    }
}
