<template>
  <div class="home">
    <HelloWorld msg="Home" />
  </div>
</template>
<script>
import { useStore } from "vuex";
import { onMounted } from "vue";
import HelloWorld from "@/components/HelloWorld.vue";
export default {
  name: "Home",
  components: {
    HelloWorld,
  },
  setup() {
    const store = useStore();
    const get_loading = () => {
      store.dispatch("do_load");
    };
    onMounted(get_loading);
  },
};
</script>