@extends('layouts/master')

@section('content')

  <img src="http://image.tmdb.org/t/p/w300{{$movie['poster_path']}}" />

  <h1>{{$movie['title']}}</h1>

  <style>
  html{
    height: 100%;
  }
  body {
  width: 100%;
  height: 100%;
  display: block;
  position: relative;
  }

body::after {
  content: "";
  background: url(http://image.tmdb.org/t/p/original{{$movie['backdrop_path']}});
  opacity: 0.5;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: absolute;
  z-index: -1;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
  </style>
@endsection
