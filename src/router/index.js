import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'
import All_meetups from '../views/All_meetups.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/All_meetups',
    name: 'All_meetups',
    component: All_meetups
  },
  {
    path: '/AddNew',
    name: 'AddNew',

    component: () => import(/* webpackChunkName: "about" */ '../views/AddNew.vue')
  },
  {
    path: '/Favorites',
    name: 'Favorites',

    component: () => import(/* webpackChunkName: "about" */ '../views/Favorites.vue')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
