<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.app')

@section('title', 'Create a Match')

@section('content')

    <h1>Create a CSGO Match</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form class="form-horizontal" method="POST" action="/matches">
        <div>
            {{ csrf_field() }}
            <fieldset>
                <legend>Match</legend>
                <div class="form-group has-feedback">
                    <label class="col-sm-4 control-label">Location</label>
                    <div class="col-sm-8">
                        <select name="locationId" class="form-control">
                            @foreach ($locations as $location)
                                <option value="{{ $location->locationKey }}">{{ $location->locationName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Config</legend>
                <div class="form-group has-feedback">
                    <label class="col-sm-4 control-label">Template</label>
                    <div class="col-sm-8">
                        <select name="templateId" class="form-control">
                            @foreach ($templates as $template)
                                <option value="{{ $template->templateKey }}"
                                @if ($template->templateKey == 20) 
                                    selected="selected" 
                                @endif
                                >{{ $template->templateKey }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label class="col-sm-4 control-label">Steam token</label>
                    <div class="col-sm-8">
                        <input type="text" name="steamToken" value="" class="form-control">
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label class="col-sm-4 control-label">Max players</label>
                    <div class="col-sm-8">
                        <input type="text" name="maxplayers" value="10" class="form-control">
                    </div>
                </div>
    
                <div class="form-group has-feedback">
                    <label class="col-sm-4 control-label">Mapgroup</label>
                    <div class="col-sm-8">
                        <input type="text" name="mapgroup" value="mg_active" class="form-control">
                    </div>
                </div>

                <div class="form-group has-feedback">
                    <label class="col-sm-4 control-label">Map</label>
                    <div class="col-sm-8">
                        <input type="text" name="map" value="de_dust2" class="form-control">
                    </div>
                </div>
            </fieldset>
        </div>

        <div class="btn-group">
            <a class="btn btn-default" href="/matches">Cancel</button></a>
            <button type="submit" class="btn btn-primary"> Create</button>
        </div>
    </form>
 
@endsection