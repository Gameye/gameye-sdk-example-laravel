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
        <th>Actions</th>
      </tr>
  </thead>
  <tbody>


    @foreach($matches as $match)
      <tr>
        <td><a href="/matches/{{ $match->matchId }}">{{ $match->matchId }}</a></td>
        <td>
          <form method="POST" action="/matches/{{ $match->matchId }}">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button name="matchId" class="btn btn-sm btn-danger" type="submit" value="{{ $match->matchId }}">Destroy</button>
          </form>
        </td>
      </tr>
    @endforeach
      <tr>
        <td></td>
        <td>
          <a class="btn btn-sm btn-primary pull-right" href="matches/create" value="">+ Create a new Match</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection