require('./bootstrap');
import router from './routes';

Vue.directive('focus', {
  inserted: function (el) {
    el.focus()
  }
})

const app = new Vue({
    el: '#app',
    router,
    data:{
      loadComments:[]
    },
    directives: {
  focus: {
    inserted: function (el) {
      el.focus()
    }
  }
}
});
