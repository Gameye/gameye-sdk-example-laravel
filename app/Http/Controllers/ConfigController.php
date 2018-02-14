<?php

namespace App\Http\Controllers;

use \Gameye\SDK\GameyeClient;
use Illuminate\Http\Request;
use Validator;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gameyeApiKey = session('gameyeApiKey');
        $gameyeApiEndpoint = session('gameyeApiEndpoint');
        if(empty($gameyeApiEndpoint)) $gameyeApiEndpoint = "https://api.gameye.com";

        return view('config.index')
            ->with('gameyeApiKey', $gameyeApiKey)
            ->with('gameyeApiEndpoint', $gameyeApiEndpoint);
    }
    
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'gameyeApiKey' => 'required',
            'gameyeApiEndpoint' => 'required|URL',
        ]);

        if ($validator->fails())
        {
            return redirect('config')
                ->withErrors($validator)
                ->withInput();
        }
        
        $client = new \Gameye\SDK\GameyeClient([
            "AccessToken" => $request->input('gameyeApiKey'),
            "ApiEndpoint" => $request->input('gameyeApiEndpoint'),
        ]);

        $games = $client->queryGame();

        // Do an api call to check if the key and endpoint are valid
        try {
            $games = $client->queryGame(); 
        }
        catch (\Exception $e) {
            $validator->errors()->add('gameyeApiKey', $e->getMessage());
            return redirect('config')
                ->withErrors($validator)
                ->withInput();
        }

        // Set the variables uses session in this example.
        session(['gameyeApiEndpoint' => $request->input('gameyeApiEndpoint')]);
        session(['gameyeApiKey' => $request->input('gameyeApiKey')]);

        return redirect('config')
            ->with('status', 'Succesfully connected to the Gameye API.');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('gameyeApiEndpoint');
        $request->session()->forget('gameyeApiKey');
        
        return redirect('config')
            -> with('status', 'Config has been reset to default settings.');  
    }
}
