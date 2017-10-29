import ava from 'ava';
import app from './app';
import main from './components/main';
import VueRouter from 'vue-router';
let lenth = '';

ava('foo', t => {
axios.get('/api/getcomments')
          .then(response => lenth = response.data.length);
	t.is(main.data().commentsArray.length, lenth);
});
