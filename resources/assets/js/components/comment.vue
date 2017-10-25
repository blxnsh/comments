<template lang="html">
<div>
    <div :class="replyOffset(comment.level)"
        v-if="comment.level == lvl">
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
        <commentform v-if="replyForm == comment.id" @doComment="addComment" :level="comment.level" :parent_id="comment.id"></commentform>
     </div>

          <comment
              v-for="(reply, index) in comment.replies"
              v-if="comment.replies"
              :comment="reply"
              @addComment="addComment"
              :lvl="reply.level"
              :key="index">
          </comment>
</div>
</template>

<script>
import commentform from './commentform';
export default {
  components: {
    commentform
  },
  name:'comment',
  props: ['comment',
          'lvl'],
  data(){
  return   {
    replyForm: 0,
    updcom : ''
  };
  },
  methods: {
    replyOffset(value){
      value = value < 11 ? value : 10;
      let offset = 'col-xs-offset-' + value;
      return offset;
    },
    showReply(value){
      this.replyForm == value ? this.replyForm = 0 : this.replyForm = value
    },
    addComment(value){
      if(!this.comment.replies){this.comment.replies = [];}
      this.comment.replies.push(value);
      this.$emit('addComment', value);
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
          .catch(error => console.log(error));
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
            this.updcom.put('/api/updatecomment');});
},
}
}
</script>

<style lang="css">
</style>
