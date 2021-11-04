<template>
  <div class="all_meetups">
    <HelloWorld msg="All Meetups" />
    <slot v-for="item in getAll_card_data">
      <Card
        :card_title="item.title"
        :card_address="item.address"
        :card_description="item.description"
        :img_src="require('../assets/img/meetroom/' + item.src)"
        :card_key="item.room_id"
        :status="item.status == 1 ? true : false"
      />
    </slot>
  </div>
</template>

<script>
// @ is an alias to /src
import { useStore } from "vuex";
import { onMounted, computed } from "vue";
import HelloWorld from "@/components/HelloWorld.vue";
import Card from "@/components/Card.vue";

export default {
  name: "All_meetups",
  components: {
    HelloWorld,
    Card,
  },
  setup() {
    const store = useStore();
    const get_loading = () => {
      store.dispatch("do_load");
    };
    onMounted(get_loading);

    const getAll_card_data = computed(() => {
      const show_card = store.state.card_data;
      return show_card;
    });

    return {
      getAll_card_data,
    };
  },
};
</script>
