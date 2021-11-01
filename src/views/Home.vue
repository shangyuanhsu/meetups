<template>
  <div class="home">
    <HelloWorld msg="HOME" />
  </div>
</template>
<script>
// @ is an alias to /src
import { useStore } from "vuex";
import HelloWorld from "@/components/HelloWorld.vue";
export default {
  name: "Home",
  components: {
   HelloWorld,
  },
    mounted() {
    const store = useStore();
    store.dispatch("do_load");
  },
 
};
</script>