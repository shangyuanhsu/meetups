<template>
  <div class="cardContent">{{ title }}</div>
</template>

<script>
import { useStore } from "vuex";
import { onMounted, ref } from "vue";
export default {
  name: "CardContent",
  props: {
    path: String,
  },
  setup() {
    const store = useStore();
    const get_loading = () => {
      store.dispatch("do_load");
    };
    onMounted(get_loading);
    const title = ref("");
    title.value = "bullet journal";
    return {
      title,
    };
  },
};
</script>

<style scoped>
</style>