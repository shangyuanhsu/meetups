<template>
  <header>
    <h1>Vue Meetups</h1>
    <div id="nav">
      <router-link to="/">All Meetups</router-link> |
      <router-link to="/AddNew">Add New Meetup</router-link>|
      <router-link to="/Favorites">My Favorites</router-link>
    </div>
  </header>
  <router-view />
</template>
<script>
import { useStore } from "vuex";

export default {
  mounted() {
    const store = useStore();
     store.dispatch("get_room");
  }
};
</script>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  background-color: #fcf3f6;
}
header {
  background-color: #77002e;
  padding: 30px 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  color: #ffffff;
  margin-bottom: 80px;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #3b3b3b;
}

#nav a {
  display: inline-block;
  margin: 0 10px;
  font-weight: bold;
  text-decoration: none;
  color: #ffffff;
}

#nav a.router-link-exact-active {
  color: #ffffff;
  border-bottom: 2px solid #ffffff;
}
</style>
