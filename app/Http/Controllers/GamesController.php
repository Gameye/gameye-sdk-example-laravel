<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Gameye\SDK\GameyeClient;

class GamesController extends Controller
{
    /**
     * Display a listing of the Games.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \Gameye\SDK\GameyeClient([
            "AccessToken" => session('gameyeApiKey'),
            "ApiEndpoint" => session('gameyeApiEndpoint'),
        ]);
        
        // Execute GetGames on the GameyeClient.
        $games = $client->GetGames();
        return view('games.index')->with('games', $games);
    }

    /**
     * Display the specified Game.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $client = new \Gameye\SDK\GameyeClient([
            "AccessToken" => session('gameyeApiKey'),
            "ApiEndpoint" => session('gameyeApiEndpoint'),
        ]);

        // Get the game specific Locations and Templates from the GameyeClient
        $locations = $client->GetLocations($id);
        $templates = $client->GetTemplates($id);
        $game = $client->GetGames()[$id];

        return view('games.show')
            -> with('game', $game)
            -> with('locations', $locations)
            -> with('templates', $templates);
    }
}
