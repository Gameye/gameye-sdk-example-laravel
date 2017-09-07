<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'List Matches')

@section('content')

  <h1>Show Match</h1>
  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    Match Information
  </div>
  <div class="panel-body">
    Match information obtained from $match and $result.
  </div>
  <table class="table">
    <tr>
      <td><strong>Match ID</strong></td>
      <td>{{ $match->matchId }}</td>
      <td><strong>Server address</strong></td>
      <td>{{ $match->host }}</td>  
    </tr>
    <tr>
      <td><strong>Game port</strong></td>
      <td>{{ $match->portMapping->udp->{27015} }}</td> 
      <td><strong>GOTV port</strong></td>
      <td>{{ $match->portMapping->udp->{27015} }}</td> 
    </tr>
    <tr>
      <td><strong>Map</strong></td>
      <td>{{ $result->map }}</td>
      <td><strong>State</strong></td>
      <td>
      @if ($result->isFinished===true)
      Match ended
      @else 
      Match running
      @endif
      </td>
    </tr>
    <tr>
      <td><strong>Join link game</strong></td>
      <td><a href="steam://connect/{{ $match->host }}:{{  $match->portMapping->udp->{27015} }}">steam://connect/{{ $match->host }}:{{  $match->portMapping->udp->{27015} }}</a></td>
      <td><strong>Join link GOTV</strong></td>
      <td><a href="steam://connect/{{ $match->host }}:{{  $match->portMapping->udp->{27020} }}">steam://connect/{{ $match->host }}:{{  $match->portMapping->udp->{27020} }}</a></td>
    </tr>
  </table>
  </div>

  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
      Round information
  </div>
  <div class="panel-body">
      <tr>
        Example round information
      </tr>
  </div>
  <!-- Table -->
  <table class="table">
  <thead>
      <tr>
        <th>Round</th>
        <th>State</th>
        <th>Score CT</th>
        <th>Score TERRORIST</th>
      </tr>
    </thead>
    <tbody>

    @foreach($result->round as $round)
    <tr>
      <td>{{ $round->number }}</td>
      @if ($round->isFinished===true)
        <td>ended</td>
        <td>{{ $round->result->CT->score }}</td> 
        <td>{{ $round->result->TERRORIST->score }}</td> 
      @else
        <td>playing</td>
        <td></td> 
        <td></td>
      @endif
    </tr>
    @endforeach
    </tbody>
  </table>
  </div>

  <div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
      Player information
    </div>
    <div class="panel-body">
        <tr>
          Player information sample.
        </tr>
    </div>

    <table class="table">
      <thead>
        <tr>
          <th>Player</th>
          <th>Name</th>
          <th>UID</th>
          <th>State</th>
        </tr>
      </thead>
      <tbody>
        @foreach($result->player as $player)
          <tr>
            <td>{{ $player->key }}</td>
            <td>{{ $player->name }}</td>
            <td>{{ $player->uid }}</td>
            @if ($player->isConnected == 1)
            <td>Connected</td>
            @else
            <td>Disconnected</td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection