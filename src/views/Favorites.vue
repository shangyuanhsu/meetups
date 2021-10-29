<template>
  <div class="Favorites">
    <HelloWorld msg="My Favorites" />
     <slot v-for="item in getAll_card_data">
      <Card
        :card_title="item.title"
        :card_address="item.address"
        :card_description="item.description"
        :img_src="item.src"
        :card_key="item.room_id"
        :status="item.status"
      />
    </slot>
  </div>
</template>
<script>
// @ is an alias to /src
import { useStore } from "vuex";
import HelloWorld from "@/components/HelloWorld.vue";
import Card from "@/components/Card.vue";
export default {
  name: "Home",
  components: {
    HelloWorld,
    Card,
  },
  computed: {
    getAll_card_data: function () {
      const store = useStore();
      const show_card = store.state.card_data;
      const favorites_arr = store.state.favorites_arr;
      const show_favorites_arr = show_card.filter((item) => {
        return favorites_arr.indexOf(item.room_id) != -1
      });
       console.log(show_favorites_arr)
      return show_favorites_arr;
    },
  },
};
</script>