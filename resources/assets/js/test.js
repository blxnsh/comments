import test from 'ava';
import app from './app';
import main from './components/main';

test('foo', t => {
axios.get('/api/getcomments')
          .then(response => const lenth = response.data.length);
	t.is(main.data().commentsArray.length, lenth);
});
