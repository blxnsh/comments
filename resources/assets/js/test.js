import test from 'ava';
import Vue from 'vue';
import axios from 'axios';
import Crud from './core/crud';
import main from './components/comment.vue';

let vm;
test.beforeEach( t => {
  let N = Vue.extend(main);

  vm = new N({
    data(){
  return  {replyForm: 0,
           array:[{
             id:1,
             level:0,
             parent_id:0,
             body:'text'
           },
           {
             id:2,
             level:1,
             parent_id:1,
             body:'childText'
           }],
           commentReplyForm: new Crud({
             body: '',
             level: 0,
             parent_id: 1})
  }
},
    propsData:{
      commArray: [{
        id:1,
        level:0,
        parent_id:0,
        body:'text'
      },
      {
        id:2,
        level:1,
        parent_id:1,
        body:'childText'
      }],
      comment:{
        id:1,
        level:0,
        parent_id:0,
        body:'text'
      }
    }
  });
});

test('Page data loaded', t => {
t.pass(vm.$data && vm.$props);
});

test('Comments equal', t => {
  t.deepEqual(vm.$data.array, [{
    id:1,
    level:0,
    parent_id:0,
    body:'text'
  },
  {
    id:2,
    level:1,
    parent_id:1,
    body:'childText'
  }]
);
});
