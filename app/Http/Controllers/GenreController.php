<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Requests\GenreRequest;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Genre::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GenreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request)
    {
        return Genre::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  $id (id of resource)
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Genre::with('games')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GenreRequest $request
     * @param  $id (id of resource)
     * @return \Illuminate\Http\Response
     */
    public function update(GenreRequest $request, $id)
    {
        Genre::where('id',$id)->update($request->validated());
        return Genre::findOrFail($id)->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id (id of resource)
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::findOrFail($id)->delete();
        return response(null, 204);
    }
}
