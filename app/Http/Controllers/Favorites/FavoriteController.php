<?php

namespace App\Http\Controllers\Favorites;

use App\Http\Controllers\Controller;
use App\Repositories\FavoriteRepository;
use App\Services\FavoriteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Obtiene todas las Noticias Favoritas de un Usuario
     *
     */
    public function index(
        FavoriteRepository $favoriteRepository
    )
    {
        $userID = Auth::id();
        $favorites = $favoriteRepository->getFavoritesByUserID($userID);
        return response()->view('favorites/show', [
            'favorites' => $favorites
        ]);
    }

    /**
     * Crea un nuevo Favorito para el Usuario registrado
     * 
     */
    public function create(
        Request $request,
        FavoriteRepository $favoriteRepository,
        FavoriteService $favoriteService
    )
    {
        $favorite = $favoriteRepository->searchFavorite($request);
        if(isset($favorite))
        {
            $favoriteRepository->updateFavorite($request->title, Auth::id());
        }else{
            $favoriteService->createNewFavorite($request);
        }

        
    }


    /**
     * Elimina al Favorito de la lista del Usuario segun el titulo
     */
    public function delete(
        Request $request,
        FavoriteRepository $favoriteRepository
    )
    {
        $favoriteRepository->deleteFavoritesByTitle($request->title);
        $userID = Auth::id();
        $favorites = $favoriteRepository->getFavoritesByUserID($userID);
        return response()->view('favorites/show', [
            'favorites' => $favorites
        ]);
        
    }


}