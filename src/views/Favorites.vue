<template>
  <div class="Favorites">
    <HelloWorld msg="My Favorites" />
    <Card
      card_title="sea"
      card_address="Test Address"
      card_description="Test Description"
      img_src="https://momentum.photos/img/66643dc8-1598-4d6c-a029-09f22969e3e1.jpg?momo_cache_bg_uuid=390f8491-2449-4c57-b1a1-be9e7cc8b939"
    />
    <Card
      card_title="sea"
      card_address="Test Address"
      card_description="Test Description"
      img_src="https://momentum.photos/img/66643dc8-1598-4d6c-a029-09f22969e3e1.jpg?momo_cache_bg_uuid=390f8491-2449-4c57-b1a1-be9e7cc8b939"
    />
  </div>
</template>
<script>
// @ is an alias to /src
import HelloWorld from "@/components/HelloWorld.vue";
import Card from "@/components/Card.vue";
export default {
  name: "Home",
  components: {
    HelloWorld,
    Card,
  },
};
</script>