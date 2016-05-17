@extends('layouts.master')

@section('content')

  <div class="row">
    <div class="col-md-12">
      <input class="form-control" type="text" value="http://www.cinebound.com/{{Auth::user()->id}}.ics?nocache" readonly />
    </div>

    <router-view></router-view>
  </div>

  @endsection
