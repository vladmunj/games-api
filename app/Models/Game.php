<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\GameRequest;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }

    public function attachGenres(GameRequest $request){
        if($request->filled('genres')){
            $genres = Genre::find($request->genres);
            if($genres->count() == 0) return false;
            $this->genres()->attach($genres);
        }
    }

    public function detachGenres(){
        $this->genres()->detach();
        return $this;
    }
}
