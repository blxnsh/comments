<template lang="html">
  <div class="container">
    <div class="row">
     <div class="col-md-8 col-md-offset-2">
       <p><h3>Коментарии:</h3></p>
                <comment v-for="(comment,index) in commentsArray"
                  v-if="comment.level == 0"
                  :commArray="commentsArray"
                  :comment="comment"
                  :key="index">
                </comment >

            <p><h3>Отставить коментарий</h3></p>
              <commentform
                  @doComment="addComment"
                  level="-1"
                  parent_id="0">
              </commentform>
              </div>
     </div>
    </div>
  </div>
</template>

<script>
import commentform from './commentform'
import comment from './comment'
export default {
  components: {
    commentform,
    comment
  },
data(){
  return {
    commentsArray: [],
    crud: new Crud({
      level: '',
      parent_id: '',
      body: ''
    }),
  };
},
  mounted() {
  axios.get('/api/getcomments')
          .then(response => this.commentsArray = response.data)
          .then(console.log('Comments loaded!'))
          .catch(error => console.log(error.message));
},
methods: {
  doIndex(value){
    for(let i = 0; i < value.length; i++){
      value[i].index = i;
    }
    return value;
  },
  addComment(value){
    this.crud = new Crud({
      parent_id: value.parent_id,
      level: value.level,
      body: value.body,
    });
    this.crud.post('/api/postcomment')
            .then(response => this.commentsArray.push(response))
            .then(console.log('Comments pushed!'))
                .catch(error => console.log(error.message));

  this.crud = new Crud({
    level: '',
    parent_id: '',
    body: ''});
    this.replyForm = 0;
  }
},

}
</script>

<style lang="css">
</style>
