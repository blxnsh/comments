<template lang="html">
  <div class="container">
    <div class="row">
     <div class="col-md-8 col-md-offset-2">
       <p><h3>Коментарии:</h3></p>

                <comment v-for="comment in commentsArray"
                  :comment="comment"
                  @addComment="addComment"
                  :key="comment.id"
                  :lvl="0">
                </comment>

            <p><h3>Опиши свое восхищение</h3></p>
                <commentform @doComment="addComment" level="-1" parent_id="0"></commentform>
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
          .catch(error => console.log(error.message));
},
methods: {
  addComment(value){
    this.crud.parent_id = value.parent_id;
    this.crud.level = value.level;
    this.crud.body = value.body;
    this.crud.post('/api/postcomment')
            .then(response => this.commentsArray.push(response))
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
