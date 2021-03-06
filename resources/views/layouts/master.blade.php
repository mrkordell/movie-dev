<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf_token" content="{!!csrf_token()!!}">
  <meta name="user_id" content="{{Auth::user()->id}}">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>CineBound</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.0.2/css/hover.css">
  <link rel="stylesheet" href="{{ elixir('css/app.css') }}">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <div id="app">
  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" style="font-family: 'Montserrat', sans-serif;" href="/">CineBound</a>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a v-link="'tracked'" href="javascript:void(0);">Tracked Movies</a></li>
        <li><a v-link="'search'" href="javascript:void(0);">Find Movies</a></li>
        <li><a v-link="'upcoming'" href="javascript:void(0);">Upcoming Movies</a></li>
        <li><a v-link="'popular'" href="javascript:void(0);">Popular Movies</a></li>
        <li><a href="#"><img src="{{Auth::user()->avatar}}" class="img-circle" style="width:25px;" /> {{Auth::user()->name}}</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @yield('content')
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.24/vue.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/0.7.10/vue-router.min.js"></script>
  <script src="https://cdn.jsdelivr.net/lodash/4.11.2/lodash.min.js"></script>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script src="{{ elixir('js/main.js')}}"></script>
</div>
</body>
</html>
