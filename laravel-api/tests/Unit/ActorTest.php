<?php

namespace Tests\Feature;

use App\Models\Actor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActorTest extends TestCase
{
    use RefreshDatabase; // Esto restablece la base de datos antes de cada prueba

    /**
     * Prueba para crear un nuevo actor.
     *
     * @return void
     */
    public function testCrearActor()
    {
        $response = $this->post('/api/actors', [
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        $response->assertStatus(201); // Verifica que la respuesta sea un código 201 (creado)
        $this->assertDatabaseHas('actors', [
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]); // Verifica que los datos del actor estén en la base de datos
    }
}
