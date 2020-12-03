<?php

namespace App\Repositories;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteRepository
{
    /**
     * Obtiene todas las Noticias favoritas de un Usuario segun su ID
     */
    public function getFavoritesByUserID(int $userID)
    {
        $favorites = Favorite::where([
            ['is_favorite', '=', '1'],
            ['user_id', '=', $userID],
        ])->get();

        return $favorites;
    }

    /**
     * 
     * 
     */
    public function deleteFavoritesByTitle(string $title)
    {
        Favorite::where('title', $title)
        ->update(['is_favorite' => 0]);
    }

    /**
     * 
     */
    public function searchFavorite(Request $request)
    {
        $favorite = Favorite::where('title', $request->title);

        return $favorite;
    }


    public function updateFavorite(string $title, int $userID)
    {
        Favorite::where('title', $title)
          ->where('user_id', $userID)
          ->update(['is_favorite' => 1]);
    }
}