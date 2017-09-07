<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'List Games')

@section('content')

  <h1>Show Game</h1>
  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    Game Information
  </div>
  <div class="panel-body">
    Game information obtained from $game, $locations and $templates.
  </div>
  <table class="table">
    <tr>
      <td><strong>Game ID</strong></td>
      <td>{{ $game->gameId }}</td>
      <td><strong>Game Name</strong></td>
      <td>{{ $game->name }}</td>  
    </tr>
  </table>
  </div>

  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
      Location information
  </div>
  <div class="panel-body">
      <tr>
        Example location information
      </tr>
  </div>
  <!-- Table -->
  <table class="table">
  <thead>
      <tr>
        <th>Location Id</th>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>

    @foreach($locations as $location)
    <tr>
      <td>{{ $location->locationId }}</td>
      <td>{{ $location->name }}</td>
    </tr>
    @endforeach
    </tbody>
  </table>
  </div>



  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
      Template information
  </div>
  <div class="panel-body">
      <tr>
        Example template information
      </tr>
  </div>
  <!-- Table -->
  <table class="table">
  <thead>
      <tr>
        <th>Template Id</th>
        <th>Name</th>
      </tr>
    </thead>
    <tbody>

    @foreach($templates as $template)
    <tr>
      <td>{{ $template->templateId }}</td>
      <td>{{ $template->name }}</td>
    </tr>
    @endforeach
    </tbody>
  </table>
  </div>
@endsection