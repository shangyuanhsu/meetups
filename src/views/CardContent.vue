<template>
  <div class="cardContent">
    <!-- <h2>{{ room_id }}</h2> -->
    <section>
      <p>Friday, December 3, 2021</p>
      <h2>Path to Purpose - Reigniting Your Flame After Sport</h2>
      <div class="host">
        <img :src="require('../assets/img/member_img/member.png')" />
        <div class="host_info">
          <p>Host By</p>
          <p class="host_name">Judy Hsu</p>
        </div>
      </div>
    </section>
    <main>
      <section>
        <img
          class="room_img"
          :src="require('../assets/img/meetroom/1_1635904875.jpeg')"
        />
        <h3>Details</h3>
        <p id="show_content">
          Please RSVP to access the registration link to secure your spot!<br />
          <br />
          Description:
          <br />
          Right now, more than ever, people are feeling burnt out, disconnected,
          and unfulfilled in their careers. The pandemic has left many wondering
          if they can foster a new relationship with their work. For retired
          athletes, finding a way to relate to work is not a new challenge. When
          your identity is wrapped up in sport for most of your life, it’s hard
          to know what to do with yourself when that chapter of your life
          closes.<br />
          <br />
          o How can you accept your new reality from a place of power and
          confidence?<br />
          o How can you feel that engaged in and passionate about something
          else?<br />
          o How can you experience deep connection to others through team
          comradery at work?<br />
          o How can you find a sense of purpose and satisfaction working towards
          professional goals?<br />
          <br />
          In the Path to Purpose workshop for retired athletes, Ariel, with help
          from her partner Natasha, will share tools from her training in sport
          & performance psychology and experience as a career coach to help you
          spark that same fire within you that carried you through sport. They
          will help you see how much more you still have to offer and provide
          steps for finding purpose alignment through your work. At the end of
          the workshop, you will walk away with more clarity, confidence, and
          excitement about the next steps in your career journey.<br />
          <br />
          Contact:
          <br />
          Ariel Naftali<br />
          Email: ariel@performwithpurpose.org<br />
          Website: https://www.performwithpurpose.org/<br />
          LinkedIn: https://www.linkedin.com/in/ariel-jaye-naftali-79499465/<br />
          FB: https://www.facebook.com/ariel.naftali/<br />
          IG: https://www.instagram.com/arieljayecoaching/<br />
          <br />
          Natasha Habert<br />
          Email: tasha@habert.us<br />
          Website: www.optimize-thrive-perform.com/<br />
          LinkedIn: https://www.linkedin.com/in/natasha-habert/<br />
        </p>
      </section>
      <section>
        <div class="other_info_zone">
          <div class="other_info">
            <p><span>#aaa</span><span>#bbb</span></p>
          </div>
          <div class="other_info">
            Friday, December 3, 2021<br />
            2:00 AM to 2:45 AM GMT+8<br />
            Online event<br />
            Link visible for attendees<br />
          </div>
        </div>
      </section>
    </main>
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
      return route.query.roomId;
    });

    return {
      room_id,
    };
  },
};
</script>

<style scoped>
.cardContent {
  padding: 30px 50px;
}
.cardContent > section {
  max-width: 1200px;
  margin: 20px auto;
}

section > .host {
  margin: 20px 0;
  display: flex;
  align-items: center;
}
.host_info {
  margin-left: 10px;
}
.host_name {
  font-weight: bold;
}
section > div img {
  width: 40px;
}
h3 {
  margin: 20px 0;
}
main {
  max-width: 1200px;
  display: flex;
  justify-content: space-between;
  margin: 0px auto;
}
#show_content {
  word-break: break-all;
  line-height: 1.5em;
}
.room_img {
  width: 100%;
  margin-top: 20px;
}
.other_info_zone {
  width: 400px;
  position: sticky;
  top: 20px;
}
.other_info {
  width: 100%;
  /* height: 150px; */
  background: white;
  border-radius: 24px;
  margin: 20px 0 20px 50px;
  padding: 20px 30px;
  line-height: 1.5em;
}
</style>