<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Configuration Page')

@section('content')
    <h1>Configuration Page</h1>
    <div class="panel panel-default">
    <!-- Default panel contents -->
        <div class="panel-heading">Settings</div>
            <div class="panel-body">
            <p>
            Please fill in the correct information obtained from Gameye.
            </p>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form class="form-horizontal" method="POST" action="config">
        <div>
            <fieldset>
                {{ csrf_field() }}
                <legend>Config</legend>
                <div class="form-group has-feedback">
                    <label class="col-sm-4 control-label">Gameye API Token</label>
                    <div class="col-sm-8">
                    <input type="text" name="gameyeApiKey" value="{{ $gameyeApiKey }}" class="form-control">
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label class="col-sm-4 control-label">Gameye API Endpoint</label>
                    <div class="col-sm-8">
                    <input type="text" name="gameyeApiEndpoint" value="{{ $gameyeApiEndpoint }}" class="form-control">
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>

    <br>
    <br>
    <form class="form-horizontal" method="POST" action="config">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <fieldset>
            <legend>Clear the configuration</legend>
            <button name="matchId" class="btn btn-sm btn-danger" type="submit">Clear Configuration</button>
        </fieldset>
    </form>
@endsection 
