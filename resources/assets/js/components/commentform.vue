<template lang="html">
<div>
  <div class="form-group">
    <textarea class="form-control" rows="2"
    v-model="comment.body" v-focus placeholder="Писать сюда :)"></textarea>
  </div>
  <button class="btn btn-primary" @click="letsGo">Оставить коментарий</button>
<hr>
</div>
</template>

<script>
export default {
  data(){
    return {
      comment: new Crud({
        body: '',
        level: this.level,
        parent_id: this.parent_id,
      })
    };
},
props:
 ['level', 'parent_id'],
methods: {
  letsGo() {
    this.comment.level = parseInt(this.level) + 1;
    this.$emit('doComment', this.comment);
  }
}
}
</script>

<style lang="css">
</style>
