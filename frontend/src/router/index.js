import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ProductDetailView from '../views/ProductDetailView.vue'

export const router = createRouter({
  history: createWebHistory(),
  scrollBehavior(to, _from, savedPosition) {
    if (to.path === _from.path && to.hash === _from.hash) return false
    if (savedPosition) return savedPosition
    return to.hash ? { el: to.hash, behavior: 'smooth' } : { top: 0 }
  },
  routes: [
    { path: '/', name: 'home', component: HomeView },
    { path: '/categorias/:slug', name: 'category', component: HomeView },
    { path: '/productos/:slug', name: 'product', component: ProductDetailView },
    { path: '/:pathMatch(.*)*', redirect: { name: 'home' } },
  ],
})
