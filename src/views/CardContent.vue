<template>
  <div class="cardContent">
    <h2>{{ room_id }}</h2>
  </div>
</template>

<script>
import { useRoute } from "vue-router";

import { useStore } from "vuex";
import { computed, onMounted } from "vue";
export default {
  name: "CardContent",
  props: {
    path: String,
  },
  setup() {
    const store = useStore();
    const route = useRoute();

    const get_loading = () => {
      store.dispatch("do_load");
    };
    onMounted(get_loading);

    const room_id = computed(() => {
      return route.params.path;
    });

    return {
      room_id,
    };
  },
};
</script>

<style scoped>
</style>