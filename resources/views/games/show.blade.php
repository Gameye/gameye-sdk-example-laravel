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
    General information about the game
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>Game ID</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $game }}</td>
    </tr>
    </tbody>
  </table>
  </div>

  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
      Location information
  </div>
  <div class="panel-body">
      <tr>
        All servers location for {{ $game }}
      </tr>
  </div>
  <!-- Table -->
  <table class="table">
  <thead>
      <tr>
        <th>Location ID</th>
      </tr>
    </thead>
    <tbody>

    @foreach($locations as $location)
    <tr>
      <td>{{ $location->locationKey }}</td>
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
         All templates available for {{ $game }}
      </tr>
  </div>
  <!-- Table -->
  <table class="table">
  <thead>
      <tr>
        <th>Template ID</th>
      </tr>
    </thead>
    <tbody>

    @foreach($templates as $template)
    <tr>
      <td>{{ $template->templateKey }}</td>
    </tr>
    @endforeach
    </tbody>
  </table>
  </div>
@endsection