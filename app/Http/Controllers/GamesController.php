<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Gameye\SDK\GameyeClient;
use \Gameye\SDK\GameyeHelper;

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
        
        // Execute gueryGame on the GameyeClient.
        $gamesList = $client->queryGame();
        $games = $gamesList->game;

        return view('games.index')->with('games', $games);
    }

    /**
     * Display the specified Game.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($key)
    {   
        $client = new \Gameye\SDK\GameyeClient([
            "AccessToken" => session('gameyeApiKey'),
            "ApiEndpoint" => session('gameyeApiEndpoint'),
        ]);

        // Execute gueryGame on the GameyeClient.
        $gamesList = $client->queryGame();

        // Get the game specific Locations and Templates from the GameyeClient
        $locations = GameyeHelper::selectLocationListForGame($gamesList, $key);

        // Get the available game templates
        $templateList = $client->queryTemplate($key);
        $templates = GameyeHelper::selectTemplateList($templateList);


        return view('games.show')
            ->with('locations', $locations)
            ->with('templates', $templates)
            ->with('game', $key);
    }
}
