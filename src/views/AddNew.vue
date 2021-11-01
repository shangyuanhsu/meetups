<template>
  <div class="addNew">
    <HelloWorld msg="Add New Meetup" />
    <form>
      <h3>Meetup Title</h3>
      <input type="text" />
      <h3>Meetup Image</h3>
      <input type="text" />
      <h3>Address</h3>
      <input type="text" />
      <h3>Description</h3>
      <textarea></textarea>
      <button>Add Meetup</button>
    </form>
  </div>
</template>
<script>
import { useStore } from "vuex";
import HelloWorld from "@/components/HelloWorld.vue";
export default {
  name: "Home",
  components: {
    HelloWorld,
  },
  mounted() {
    const store = useStore();
    store.dispatch("do_load");
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
h3 {
  font-size: 20px;
}
input[type="text"],
textarea {
  display: block;
  width: 100%;
  padding: 8px;
  font: inherit;
  border-radius: 4px;
  border: 1px solid #ccc;
  margin: 8px 0 20px 0;
}

textarea {
  resize: none;
  height: 150px;
}

button {
  margin: 20px 0 45px 0;
  font-size: 20px;
  padding: 10px;
  border-radius: 4px;
  color: #77002e;
  border: 1px solid #77002e;
  background-color: white;
  outline: none;
  cursor: pointer;
  transition: all .5s;
}
button:hover {
  color: white;
  background-color: #77002e;
}
</style>