<template>
<div>
  <post></post>
  <hr>
  <comments></comments>
</div>
</template>

<script>
import post from './post';
import comments from './comments';
export default {
  components: {
    post,
    comment
  }
}
</script>
