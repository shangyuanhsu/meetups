<template>
  <div class="all_meetups">
    <HelloWorld msg="All Meetups" />
    <slot v-for="item in getAll_card_data">
      <router-link :to="{ path: '/CardContent', query: { roomId: `${item.room_id}`}}">
        <Card
          :card_title="item.title"
          :card_address="item.address"
          :card_description="item.description"
          :img_src="require('../assets/img/meetroom/' + item.src)"
          :card_key="item.room_id"
          :status="item.status == 1 ? true : false"
        />
      </router-link>
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
      store.dispatch("get_room");
      store.dispatch("do_load");
    };
    onMounted(get_loading);

    // meetups渲染
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
<style scoped>
.all_meetups {
  width: 65%;
  max-width: 1000px;
  margin: 40px auto 80px auto;
}
a {
  font-weight: bold;
  text-decoration: none;
  color: #3b3b3b;
  display: block;

  margin: 40px auto;
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgb(0 0 0 / 20%);
  cursor: pointer;
}
</style>
