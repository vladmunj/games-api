<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenreTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_genres()
    {
        $genres = [
            ['name' => 'Shooter'],
            ['name' => 'Fighting'],
            ['name' => 'RPG']
        ];

        foreach($genres as $data){
            $response = $this->post('/api/genres',$data);
            $response->assertStatus(201);
        }
    }

    public function test_list_genres(){
        $response = $this->get('/api/genres');
        $response->assertStatus(200);
    }
}
