<template>
  <div class="row">
    <div class="col-md-12">
      <input class="form-control" type="text" value="http://www.cinebound.com/{{user_id}}.ics?nocache" readonly />
    </div>
  </div>
  <div class="row">
  <div class="col-md-12">
    <h3>Tracked Movies</h3>
    <div class="row" v-for="chunk in movies | limit limit | inChunksOf 6">
      <div class="col-sm-2" style="margin-bottom:20px;" v-for="movie in chunk" v-on:mouseover="remove = movie" v-on:mouseout="remove = {}">
        <div class="position:relative;">
        <div style="position:absolute;top:50%;left:50%;margin-left:-25px;margin-top:-55px;color:#fff;z-index:9999;font-size:36pt;" v-if="remove == movie" v-on:click="removeMovie(movie.id)"></div>
        <a class="hvr-grow" href="/movie/{{movie.tmdb_id}}"><img v-bind:src="base + movie.poster_path" class="pull-left" style="width:100%" /></a><br />
        <span class="movie-title">{{movie.title}}</span><br />
        <span class="movie-release-date">{{movie.release_date | date}}</span>
        </div>
      </div>
    </div>
    <div class="row" v-if="movies.length > 12">
      <div class="col-md-12">
        <button class="btn btn-primary" v-on:click="limit = 9999">Show All</button>
      </div>
    </div>
  </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                movies: [],
                img_base: 'http://image.tmdb.org/t/p/w92',
                base: 'http://image.tmdb.org/t/p/w154',
                remove: {},
                limit: 12,
                user_id: $('meta[name="user_id"]').attr('content')
            };
        },
        route: {
          data(transition) {
            $.get('/user/movies', (data) => transition.next({movies: data}), 'json');
          }
        },
        methods: {
          removeMovie: function(id){
            $.post('user/remove', {id: id, "_token": "{{csrf_token()}}"}, function(data){

            });
            this.movies = _.filter(this.movies, function(movie){
              if(movie.id != id){
                return movie;
              }
            });
          }
        }
    };
</script>
