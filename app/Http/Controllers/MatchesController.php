<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Gameye\SDK\GameyeClient;
use \Gameye\SDK\GameyeHelper;

class MatchesController extends Controller
{
    /**
     * Display a listing of the Match.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new \Gameye\SDK\GameyeClient([
            "AccessToken" => session('gameyeApiKey'),
            "ApiEndpoint" => session('gameyeApiEndpoint'),
        ]);

        $matchList = $client->queryMatch();
        $matches = $matchList->match;

        //dd($matches);

        return view('matches.index')->with('matches', $matches);
    }

    /**
     * Show the form for creating a new Match.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new \Gameye\SDK\GameyeClient([
            "AccessToken" => session('gameyeApiKey'),
            "ApiEndpoint" => session('gameyeApiEndpoint'),
        ]);

        $locationList = $client->queryGame();
        $locations = $locationList->location;

        $templateList = $client->queryTemplate('csgo');
        $templates = $templateList->template;

        return view('matches.create')
            ->with('locations', $locations)
            ->with('templates', $templates);
    }

    /**
     * Create a new match through the GameyeClient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new \Gameye\SDK\GameyeClient([
            "AccessToken" => session('gameyeApiKey'),
            "ApiEndpoint" => session('gameyeApiEndpoint'),
        ]);
        
        // The matchId must be unique. Please generate your own unique ID.
        $matchKey = time();
        $locationKeys = [$request->input('locationId')];
        $gameKey = "csgo";
        $templateKey = $request->input('templateId'); 
        
        // More configuration to launch the match with
        $config = [
            'maxplayers' => $request->input('maxplayers'),
            'steamToken' => $request->input('steamToken'),
            'tickrate'   => 128,
            'mapgroup'   => $request->input('mapgroup'),
            'map'        => $request->input('map'),
        ];

        // Do the actual call with the GameyeClient.
        $client->commandStartMatch([
            'matchKey'     => $matchKey,
            'locationKeys' => $locationKeys,
            'gameKey'      => $gameKey,
            'templateKey'  => $templateKey,
            'config'       => $config
        ]);

        return redirect('matches');
    }

    /**
     * Display the specified Match.
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

        $matchState = $client->queryMatch();
        $match = GameyeHelper::selectMatchItem($matchState, $key);

        $matchResult = $client->queryStatistic($key, 'global-match');

        return view('matches.show')
            ->with('match', $match)
            ->with('result', $matchResult);
    }

    /**
     * Remove the specified Match from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        $client = new \Gameye\SDK\GameyeClient([
            "AccessToken" => session('gameyeApiKey'),
            "ApiEndpoint" => session('gameyeApiEndpoint'),
        ]);

        $client->commandStopMatch(['matchKey' => $key]); 

        return redirect('matches');
    }
}
