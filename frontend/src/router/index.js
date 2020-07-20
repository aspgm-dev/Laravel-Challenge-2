import Vue from 'vue'
import Router from 'vue-router'
import VueAxios from 'vue-axios';

import HelloWorld from '../components/HelloWorld.vue'
import News from '../views/news/Index.vue'
import Show from '../views/news/Show.vue'

Vue.use(Router, VueAxios);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'helloworld',
      component: HelloWorld
    },
    {
      path: '/news',
      name: 'news',
      component: News
    },
    {
      path: '/news/show/:id',
      name: 'show',
      component: Show
    }
  ]
})
