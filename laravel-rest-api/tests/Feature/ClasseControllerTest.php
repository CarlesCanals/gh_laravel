<?php

namespace Tests\Feature;

use App\Models\Classe;
use App\Models\Alumne;  // Afegeix aquesta línia per importar el model Alumne
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ClasseControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** #[Test] */
    public function test_create_class()
    {
        $data = Classe::factory()->make();  // Utilitzant la factory

        // Fer una petició POST per crear una classe
        $response = $this->postJson('/api/classes', [
            'grup' => $data->grup,
            'tutor' => $data->tutor
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'grup' => $data->grup,
            'tutor' => $data->tutor,
        ]);

        $this->assertDatabaseHas('classes', [
            'grup' => $data->grup,
            'tutor' => $data->tutor,
        ]);
    }

    /** #[Test] */
    public function test_add_alumne_to_class()
    {
        $classe = Classe::factory()->create();

        $data = Alumne::factory()->make([
            'classe_id' => $classe->id
        ]);

        // Afegir l'alumne a la classe
        $response = $this->postJson("/api/classes/{$classe->id}/alumnes", [
            'nom' => $data->nom,
            'cognom' => $data->cognom,
            'data_naixement' => $data->data_naixement,
            'nif' => $data->nif
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'nom' => $data->nom,
            'cognom' => $data->cognom,
            'data_naixement' => $data->data_naixement,
            'nif' => $data->nif,
        ]);

        $this->assertDatabaseHas('alumnes', [
            'nom' => $data->nom,
            'classe_id' => $classe->id,
        ]);
    }

    /** #[Test] */
    public function test_get_all_students_in_class()
    {
        $classe = Classe::factory()->create();

        Alumne::factory(2)->create([
            'classe_id' => $classe->id
        ]);

        $response = $this->getJson("/api/classes/{$classe->id}/alumnes");

        $response->assertStatus(200);
        $response->assertJsonCount(2);  // Verifica que hi ha 2 alumnes
    }


}
