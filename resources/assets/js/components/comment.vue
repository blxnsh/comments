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
              :array="array"
              :level="comment.level"
              :parent_id="comment.id"
              >
          </commentform>
     </div>

      <div v-if="typeof array[array.findIndex(i => i.id == comment.id)] !== 'undefined'">
        <comment
            v-if="array[array.findIndex(i => i.id == comment.id)].replies"
            v-for="(reply, index) in array[array.findIndex(i => i.id == comment.id)].replies"
            :comment="reply"
            :array="array"
            :key="index"
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
  };
  },
  props: ['comment', 'array'],
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
                  if(typeof this.array[this.array.findIndex(i => i.id == this.comment.id)] === 'undefined'){
                    this.array[this.array.findIndex(i => i.parent_id == value.id) + 1].replies.push(response);
                  } else
                    {
                      this.array[this.array.findIndex(i => i.id == this.comment.id)].replies.push(response);
                    }
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
    .catch(error => {console.log(error)
     if(this.array.findIndex(i => i.id == value.id) == this.array.length){
         this.array.splice(-1,1);
     } else {
     this.array.splice(this.array.findIndex(i => i.id == value.id), 1);
   }});
if(this.array.findIndex(i => i.id == value.id) == this.array.length){
   this.array.splice(-1,1);
} else {
this.array.splice(this.array.findIndex(i => i.id == value.id), 1);
}
}
  }
);
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
}
}
</script>

<style lang="css">
</style>
