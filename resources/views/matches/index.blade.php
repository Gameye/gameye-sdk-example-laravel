<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'List Matches')

@section('content')
  <h1>List Matches</h1>
  <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Matches</div>
  <div class="panel-body">
    <p>An overview of your matches.</p>
  </div>

  <!-- Table -->
  <table class="table">
  <thead>
      <tr>
        <th>Match ID</th>
        <th>Game</th>
        <th>Actions</th>
      </tr>
  </thead>
  <tbody>
    @foreach($matches as $match)
      <tr>
        <td><a href="/matches/{{ $match->matchKey }}">{{ $match->matchKey }}</a></td>
        <td>{{ $match->gameKey }}</td>
      
        <td>
          <form method="POST" action="/matches/{{ $match->matchKey }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button name="matchId" class="btn btn-sm btn-danger" type="submit" value="{{ $match->matchKey }}">Destroy</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@endsection