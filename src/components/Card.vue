<template>
  <div class="card">
    <div class="card_img">
      <img :src="img_src" />
    </div>

    <h2>{{ card_title }}</h2>
    <p>{{ card_address }}</p>
    <p>{{ card_description }}</p>
    <button @click="add_f(card_key)">To Favorites</button>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: {
    img_src: String,
    card_title: String,
    card_address: String,
    card_description: String,
    card_key: Number,
  },
  methods:{
      add_f(id){
          console.log(id)
      }
  }
};
</script>

<style scoped>
.card {
  width: 65%;
  max-width: 1000px;
  margin: 40px auto;
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgb(0 0 0 / 20%);
}
#card .card_img {
  width: 100%;
  height: 20rem;
  overflow: hidden;
}
.card_img img {
  width: 100%;
}
.card h2 {
  font-size: 32px;
  margin: 20px 0;
}
.card p {
  margin: 10px 0;
}

.card button {
  margin: 20px 0 45px 0;
  font-size: 20px;
  padding: 10px;
  border-radius: 4px;
  color: #77002e;
  border: 1px solid #77002e;
  background-color: white;
  outline: none;
  cursor: pointer;
  transition: all 0.5s;
}
.card button:hover {
  color: white;
  background-color: #77002e;
}
</style>