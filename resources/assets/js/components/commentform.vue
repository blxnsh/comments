<template lang="html">
<div>
    <form @submit.prevent="letsGo">
    <div class="form-group">
      <textarea class="form-control" rows="2" :id="getFormId()"
      v-model="commentReplyForm.body" v-focus placeholder="Писать сюда :)"></textarea>
    </div>
    <button :dusk="getId()" class="btn btn-primary" type="submit">Оставить коментарий</button>
    </form>
<hr>
</div>
</template>

<script>
export default {
  data() {
    return {
      commentReplyForm: new Crud({
        body: '',
        level: this.level,
        parent_id: this.parent_id,
      })
    };
  },
  props: ['level', 'parent_id'],
  methods: {
    getId() {
      return 'comment-add-' + this.parent_id;
    },
    getFormId() {
      return 'comment-form-' + this.parent_id;
    },
    letsGo() {
      this.commentReplyForm.level = parseInt(this.level) + 1;
      this.$emit('doComment', this.commentReplyForm);
    }
  }
}
</script>

<style lang="css">
</style>
