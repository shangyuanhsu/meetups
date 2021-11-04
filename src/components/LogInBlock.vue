<template>
  <div class="logInBlock">
    <form>
      <h1>Log in</h1>
      <p>Not a member yet ? <span @click="goto_Signup">Sign in</span></p>
      <h3>Email</h3>
      <input type="text" />
      <div>
        <h3>Password</h3>
        <span>Forgot password</span>
      </div>
      <input type="text" />
      <button type="button">Log in</button>
      <div class="or_block">
        <span></span>
        or
        <span></span>
      </div>
      <button type="button" class="google_btn" @click="handleClickSignIn">
        <img src="@/assets/img/web_all/googlelogo.png" alt="" />
        Log in with Google
      </button>
      <!-- <button @click="handleClickSignOut">sign out</button> -->
    </form>
  </div>
</template>
<script>
import { useStore } from "vuex";
// import { ref, onMounted } from "vue";
import { inject, toRefs } from "vue";

export default {
  name: "LogInBlock",
  components: {},
  methods: {
    async handleClickSignIn() {
      try {
        const googleUser = await this.$gAuth.signIn();
        if (!googleUser) {
          return null;
        }
        console.log("getId", googleUser.getBasicProfile().getEmail());
      } catch (error) {
        console.error(error);
        return null;
      }
    },
  },
  setup(props) {
    const { isSignIn } = toRefs(props);
    const Vue3GoogleOauth = inject("Vue3GoogleOauth");

    const store = useStore();

    const goto_Signup = () => {
      store.dispatch("go_change_login", "SignIn");
    };

    return {
      Vue3GoogleOauth,
      isSignIn,
      goto_Signup,
    };
  },
};
</script>

<style scoped>
form {
  padding: 30px;
  width: 65%;
  max-width: 1000px;
  margin: 40px auto;
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
.logInBlock div {
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