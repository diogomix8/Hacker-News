<?php

namespace App\Services;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteService
{
    /**
     * Registra un Favorito para un usuario
     * 
     */
    public function createNewFavorite(Request $request)
    {
        $favorite = new Favorite();
        $favorite->title = $request->title;
        $favorite->url = $request->url;
        $favorite->user_id = Auth::id();
        $favorite->save();
    }
}