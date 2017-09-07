<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Gameye\SDK\GameyeClient;

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
        $gameId = 1; // gameId 1: csgo
        $matches = $client->GetActiveMatches($gameId);

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
        $gameId = 1; // 1: CSGO
        $locations = $client->GetLocations($gameId);
        $templates = $client->GetTemplates($gameId);

        return view('matches.create')
            -> with ('locations',$locations)
            -> with ('templates', $templates);
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
        $matchId = time();
        $locationIds = $request->input('locationId');
        $gameId = 1; // 1: CSGO
        $templateId = $request->input('templateId'); 
        
        // More Configuration to launch the match with
        $config = [
            'maxplayers' => 1,
            'sv_setsteamaccount' => $request->input('sv_setsteamaccount'),
            'tickrate' => 128,
            'mapgroup' => $request->input('mapgroup'),
            'map' => $request->input('map'),
        ];

        // Do the actual call with the GameyeClient.
        $client -> StartMatch($matchId, $locationIds, $gameId, $templateId, $config);

        return redirect('matches');
    }

    /**
     * Display the specified Match.
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

        $matchResult = $client->GetMatchResult($id);      
        $match = $client->GetMatch($id);

        return view('matches.show')
            -> with('match', $match)
            -> with('result', $matchResult);
    }

    /**
     * Remove the specified Match from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = new \Gameye\SDK\GameyeClient([
            "AccessToken" => session('gameyeApiKey'),
            "ApiEndpoint" => session('gameyeApiEndpoint'),
        ]);

        $client->StopMatch($id); 

        return redirect('matches');
    }
}
