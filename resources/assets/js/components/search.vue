<template>
  <div class="form-group" style="margin-top:20px;">
    <div class="input-group">
      <input v-model="search" v-on:keyup.enter="searchMovies" class="form-control" placeholder="Find a Movie" />
      <span class="input-group-btn">
        <button v-on:click="searchMovies" class="btn btn-default" type="button">Search</button>
      </span>
    </div>
  </div>

  <div class="row" v-show="results">
    <div class="media" v-for="result in results">
      <div class="media-left">
        <a href="/movie/{{result.id}}">
          <img class="media-object" v-bind:src="img_base + result.poster_path" alt="">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">{{ result.title }}</h4>
        World Premiere: {{ result.release_date | date }} <br />
        <button class="btn btn-primary"  v-on:click="addMovie(result.id, $event)">Add Movie</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      results: [],
      search: '',
      img_base: 'http://image.tmdb.org/t/p/w92',
      base: 'http://image.tmdb.org/t/p/w154',
    };
  },
  methods: {
    searchMovies: function(){
      const that = this;
      $.post('/api/movies', {query: this.search}, function(data){
        that.results = data.results;
      }, 'JSON');
    }
  }
};
</script>
