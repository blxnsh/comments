<template lang="html">
<div>
    <div :class="replyOffset(comment.level)">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Коментарий #{{comment.id}} / Родитель #{{comment.parent_id}} / Уровень #{{comment.level}}
                </div>

                <div class="panel-body">
                    <p>{{comment.body}}</p>
                    <a @click="showReply(comment.id)">Ответить</a>
                    <a @click="updateComment(comment)">Редактировать</a>
                    <a @click="deleteComment(comment)">Удалить</a>
                 </div>
            </div>
            <commentform
              v-if="replyForm == comment.id"
              @doComment="addComment"
              :commArray="array"
              :level="comment.level"
              :parent_id="comment.id"
              >
          </commentform>
     </div>

      <div v-if="typeof array[array.findIndex(i => i.id == comment.id)] !== 'undefined'">
        <comment
            v-if="array[array.findIndex(i => i.id == comment.id)].replies"
            v-for="reply in array[array.findIndex(i => i.id == comment.id)].replies"
            :comment="reply"
            :commArray="array"
            :key="reply.id"
            @doDelete="deleteCommentReply"
            >
        </comment>
      </div>

</div>
</template>

<script>
import commentform from './commentform';
export default {
  components: {
    commentform
  },
  name:'comment',
  data(){
  return   {
    replyForm: 0,
    updcom: '',
    crud: '',
    array: this.commArray
  };
  },
  props: ['comment', 'commArray'],
  methods: {
    replyOffset(value){
      value = value < 9 ? value : 8;
      let offset = 'col-xs-offset-' + value;
      return offset;
    },
    showReply(value){
      this.replyForm == value ? this.replyForm = 0 : this.replyForm = value
    },
    addComment(value){

      this.crud = new Crud({
        parent_id: value.parent_id,
        level: value.level,
        body: value.body,
      });
      this.crud.post('/api/postcomment')
              .then(response => {
                    //костыль
                    axios.get('/api/getcomments')
                            .then(response => this.array = response.data)
                  })
                  .catch(error => console.log(error.message));

      this.replyForm = 0;
},
    deleteComment(value) {
    swal({
      title: "Вы уверены?",
      text: "Комментарий #" + value.id + " будет уделен",
      icon: "warning",
      buttons: true,
      dangerMode: true,
        })
      .then((willDelete) => {
    if (willDelete) {
      swal("Коментарий удален!", {
        icon: "success",
      });
    axios.delete('/api/deletecomment', {params: {id: value.id}})
    .then(response =>
      {
        this.$emit('doDelete', value)
      })
      .catch(error => {
        console.log(error.message);
        axios.get('/api/getcomments')
                .then(response => this.array = response.data);
      });
    }
  });
},
    updateComment(value) {
    swal({
      text: 'Изменить Коментарий #' + value.id,
      content: "input",
      buttons: true,
      dangerMode: true,
        })
      .then(name => value.body = name)
      .then(response => {this.updcom = new Crud(value);
                        this.updcom.put('/api/updatecomment')});
},
deleteCommentReply(value){
   this.array.splice(this.array.findIndex(i => i.id == value.parent_id), 1);  
}
}
}
</script>

<style lang="css">
</style>
