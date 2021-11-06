<template>
  <div class="signOut">
    <form>
      <h1>Member</h1>
      <!-- <button type="button" @click="handleClickSignOut">sign out</button> -->
      <button type="button" @click="sign_out">sign out</button>
    </form>
  </div>
</template>
<script>
import { useStore } from "vuex";
// import { ref, onMounted } from "vue";
import { inject, toRefs } from "vue";

export default {
  name: "SignOut",
  components: {},
  methods: {
    async handleClickSignOut() {
      try {
        await this.$gAuth.signOut();
        // console.log("isAuthorized", this.Vue3GoogleOauth.isAuthorized);
        console.log(this.$store.state.user_id);
      } catch (error) {
        console.error(error);
      }
    },
  },
  setup(props) {
    const { isSignIn } = toRefs(props);
    const Vue3GoogleOauth = inject("Vue3GoogleOauth");

    const store = useStore();
    const sign_out = () => {
      store.dispatch("bye_user_id");
      location.href = "./#/All_meetups";
    };

    return {
      Vue3GoogleOauth,
      isSignIn,
      sign_out,
    };
  },
};
</script>

<style scoped>
form {
  padding: 30px;
  width: 65%;
  max-width: 1000px;
  margin: 40px auto 80px auto;
  background-color: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgb(0 0 0 / 20%);
  text-align: left;
}

p {
  margin: 20px 0 40px 0;
}
span {
  color: #77002e;
  cursor: pointer;
}
.signIn div {
  display: flex;
  justify-content: space-between;
}
.or_block {
  color: #77002e;
  align-items: center;
}
.or_block span {
  width: 45%;
  border-top: 1px solid #77002e;
  cursor: unset;
}
input[type="text"] {
  display: block;
  width: 100%;
  padding: 8px;
  font: inherit;
  border-radius: 4px;
  border: 1px solid #ccc;
  margin: 8px 0 20px 0;
}
button {
  display: block;
  width: 100%;
  margin: 30px 0;
  font-size: 20px;
  padding: 10px;
  border-radius: 4px;
  color: white;
  border: 1px solid #77002e;
  background-color: #77002e;
  outline: none;
  cursor: pointer;
  transition: all 0.5s;
}
button:hover {
  color: #77002e;
  background-color: white;
}
.google_btn {
  background-color: white;
  color: #77002e;
  display: flex;
  justify-content: center;
  align-items: center;
}
.google_btn img {
  width: 22px;
  margin: 0 20px 0 0;
}
</style>