import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import All_meetups from '../views/All_meetups.vue'
import Login from '../views/Login.vue'
import CardContent from '../views/CardContent.vue'
import NotFound from '../views/NotFound.vue'

const routes = [
  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: NotFound
  },
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/Login',
    name: 'Login.vue',
    component: Login
  },
  {
    path: '/All_meetups',
    name: 'All_meetups',
    component: All_meetups
  },
  {
    path: '/CardContent',
    name: 'CardContent',
    component: CardContent,
    // props: true
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
  history: createWebHistory(),
  routes
})

export default router
