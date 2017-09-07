<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'List Games')

@section('content')
  <h1>List Games</h1>
  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Games</div>
  <div class="panel-body">
    <p>An overview of available games.</p>
  </div>

  <!-- Table -->
  <table class="table">
  <thead>
      <tr>
        <th>Game ID</th>
        <th>Name</th>
      </tr>
  </thead>
  <tbody>


    @foreach($games as $game)
      <tr>
        <td><a href="/games/{{ $game->gameId }}">{{ $game->gameId }}</a></td>
        <td>{{ $game->name }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection