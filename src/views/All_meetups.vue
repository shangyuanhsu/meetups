<template>
  <div class="all_meetups">
    <HelloWorld msg="All Meetups" />
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
  name: "All_meetups",
  components: {
    HelloWorld,
    Card,
  },
  data() {
    return {};
  },
  mounted() {
    const store = useStore();
    store.dispatch("do_load");
    store.dispatch("get_room");
  },
  computed: {
    getAll_card_data: function () {
      const store = useStore();

      const show_card = store.state.card_data;
      const favorites_arr = store.state.favorites_arr;
      show_card.forEach((item) => {
        if (favorites_arr.indexOf(item.room_id) != -1) {
          item.status = 1;
        } else {
          item.status = 0;
        }
      });
      return show_card;
    },
  },
};
</script>
