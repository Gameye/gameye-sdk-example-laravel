<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'List Matches')

@section('content')

  <h1>Match {{ $match->matchKey }}</h1>
  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    Match Information
  </div>
  <div class="panel-body">
   General match information
  </div>
  <table class="table">
    <tr>
      <td><strong>Server address</strong></td>
      <td><a href="steam://connect/{{ $match->host}}:{{ $match->port->game }}">{{ $match->host}}:{{ $match->port->game }}</a></td> 
       <td><strong>Created at</strong></td>
      <td>{{ \Carbon\Carbon::createFromTimestamp(($match->created / 1000))->toDateTimeString() }}</td>
    </tr>
    <tr>
      <td><strong>Game port</strong></td>
      <td>{{ $match->port->game }}</td> 
      <td><strong>GOTV port</strong></td>
      <td>{{ $match->port->gotv }}</td> 
    </tr>
    <tr>
      <td><strong>Rounds played</strong></td>
      <td>{{ $result->finishedRounds }}</td>
      <td><strong>Status</strong></td>
      <td>
      @if (isset($result->stop))
      Match ended
      @else 
      Match running
      @endif
      </td>
    </tr>
  </table>
  </div>

  
  <div class="panel panel-default">
    <div class="panel-heading">Team: {{ $teams[1]->name }}</div>
    <div class="panel-body"><strong>Score: {{ $teams[1]->statistic->score }}</strong></div>
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>UID</th>
          <th>Nickname</th>
          <th>Kills</th>
          <th>Assists</th>
          <th>Deaths</th>
        </tr>
      </thead>
      <tbody>
        @foreach($teamOnePlayers as $player)
          <tr>
            <td><img src="{{ Steam::user($player->uid)->GetPlayerSummaries()[0]->avatarUrl }}"></td>
            <td>{{ $player->uid }}</td>
            <td><a href="{{ Steam::user($player->uid)->GetPlayerSummaries()[0]->profileUrl }}" target="_blank">{{ $player->name }}</a></td>
            <td>{{ $player->statistic->kill }}</td>
            <td>{{ $player->statistic->assist }}</td>
            <td>{{ $player->statistic->death }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">Team: {{ $teams[2]->name }}</div>
    <div class="panel-body"><strong>Score: {{ $teams[2]->statistic->score }}</strong></div>
    <table class="table">
      <thead>
        <tr>
          <th></th>
          <th>UID</th>
          <th>Nickname</th>
          <th>Kills</th>
          <th>Assists</th>
          <th>Deaths</th>
        </tr>
      </thead>
      <tbody>
        @foreach($teamTwoPlayers as $player)
          <tr>
            <td><img src="{{ Steam::user($player->uid)->GetPlayerSummaries()[0]->avatarUrl }}"></td>
            <td>{{ $player->uid }}</td>
            <td><a href="{{ Steam::user($player->uid)->GetPlayerSummaries()[0]->profileUrl }}" target="_blank">{{ $player->name }}</a></td>
            <td>{{ $player->statistic->kill }}</td>
            <td>{{ $player->statistic->assist }}</td>
            <td>{{ $player->statistic->death }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>


@endsection