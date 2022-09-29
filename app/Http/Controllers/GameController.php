<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Http\Requests\GameRequest;

 /**
  * @OA\Info(
  *   version="1.0.0",
  *   title="Games API",
  *   description="Games API description"
  * )
  */

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\Get(
     *   tags={"list games"},
     *   path="/api/games",
     *   summary="Game index",
     *   @OA\Response(
     *     response=200,
     *     description="OK",
     *     @OA\JsonContent(
     *       type="object",
     *     )
     *   )
     * )
     */
    public function index()
    {
        return Game::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GameRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(GameRequest $request)
    {
        $game = Game::create($request->validated());
        $game->attachGenres($request);
        return $game;
    }

    /**
     * Display the specified resource.
     *
     * @param  $id (id of resource)
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        return Game::with('genres')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GameRequest $request
     * @param  $id (id of resource)
     * @return \Illuminate\Http\Response
     */

    public function update(GameRequest $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->fill($request->validated());
        $game->save();
        $game->attachGenres($request);
        return response()->json($game);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id (id of resource)
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Game::findOrFail($id)->detachGenres()->delete();
        return response(null, 204);
    }
}
