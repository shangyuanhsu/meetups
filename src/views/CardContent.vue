<template>
  <div class="cardContent">{{ path }}</div>
</template>

<script>
export default {
  name: "CardContent",
  props: {
    path: String,
  },
  setup() {
    return {};
  },
};
</script>

<style scoped>
</style>