Vue.filter('inChunksOf', (array, number = 2) => _.chunk(array, number));

Vue.filter('date', function(value){
  const date = new Date(value);
  return (date.getMonth() + 1) + '-' + date.getDate() + '-' + date.getFullYear();
});

Vue.filter('limit', (data, number = 9999) =>  data.slice(0, number));

import Tracked from './components/tracked.vue';
import Search from './components/search.vue';
import Upcoming from './components/upcoming.vue';
import Popular from './components/popular.vue';
let App = Vue.extend({});

var router = new VueRouter();

router.map({
    '/search': {
        component: Search
    },
    '/upcoming': {
        component: Upcoming
    },
    '/tracked': {
      component: Tracked
    },
    '/popular': {
      component: Popular
    }
});

router.start(App, '#app');

if(router.app === null || router.app.$route.path == "/"){
    router.go('/tracked');
}
