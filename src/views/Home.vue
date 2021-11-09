<template>
  <div class="home">
    <section>
      <div class="introduction">
        <h1>Dive in! There are so many things to do on Meetup</h1>
        <p>
          Join a group to meet people, make friends, find support, grow a
          business, and explore your interests. Thousands of events are
          happening every day, both online and in person!
        </p>
      </div>
      <img src="../assets/img/web_all/online_events.svg" alt="" />
    </section>
  </div>
</template>
<script>
import { useStore } from "vuex";
import { onMounted } from "vue";

export default {
  name: "Home",
  components: {},
  setup() {
    const store = useStore();
    const get_loading = () => {
      store.dispatch("do_load");
    };
    onMounted(get_loading);
  },
};
</script>
<style scoped>
.home {
  width: 90%;
  max-width: 1200px;
  margin: 40px auto 80px auto;
}
section {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
}
.introduction {
  width: 480px;
}
.introduction h1 {
  font-size: 45px;
}
.introduction p {
  margin: 20px 0px;
  line-height: 1.5em;
}
img {
  width: 600px;
}
</style>