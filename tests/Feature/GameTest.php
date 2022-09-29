<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_create_games(){
        $games = [
            [
                'name' => 'Mortal Kombat X',
                'genres' => [2]
            ],
            [
                'name' => 'Counter strike 1.6',
                'description' => 'Legendary shooter of all time',
                'genres' => [1]
            ],
            [
                'name' => 'Gothic',
                'description' => 'My favorite game',
                'genres' => [3]
            ],
            [
                'name' => 'test'
            ]
        ];

        foreach($games as $data){
            $response = $this->post('/api/games',$data);
            $response->assertStatus(201);
        }
    }

    public function test_list_games()
    {
        $response = $this->get('/api/games');
        $response->assertStatus(200);
    }

    public function test_edit_games(){
        $games = [
            1 => [
                'name' => 'Mortal Kombat 9',
                'description' => 'Fighter game',
                'genres' => [3]
            ]
        ];

        foreach($games as $id => $data){
            $response = $this->put("/api/games/{$id}",$data);
            $response->assertStatus(200);
        }
    }

    public function test_show_game(){
        $response = $this->get('/api/games/3');
        $response->assertStatus(200);
    }

    public function test_remove_game(){
        $response = $this->delete('/api/games/4');
        $response->assertStatus(204);
    }
}
