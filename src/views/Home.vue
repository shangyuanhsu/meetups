<template>
  <div class="home">
    <HelloWorld msg="All Meetups" />
    <!-- <slot v-for="item in card_arr">
      <Card
        :card_title="item.title"
        :card_address="item.address"
        :card_description="item.description"
        :img_src="item.src"
        :card_key ="item.id"
      />
    </slot> -->
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from "@/components/HelloWorld.vue";
// import Card from "@/components/Card.vue";
import { useStore } from "vuex";

export default {
  name: "Home",
  components: {
    HelloWorld,
    // Card,
  },
  data() {
    return {
      // card_arr: [],
    };
  },
  mounted() {
    const store = useStore();
    console.log(store.state.card_data);
    // this.card_arr = store.state.card_data;
  },
};
</script>
