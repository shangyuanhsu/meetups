import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'
import All_meetups from '../views/All_meetups.vue'
import Login from '../views/Login.vue'
import CardContent from '../views/CardContent.vue'

const routes = [
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
    path: '/CardContent/:path',
    name: 'CardContent',
    component: CardContent,
    children: [
      { path: "1", component: CardContent },
      { path: "2", component: CardContent },
      { path: "3", component: CardContent }
    ],
    props: true
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
