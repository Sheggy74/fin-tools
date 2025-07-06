import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../pages/HomeView.vue'
import AboutView from '../pages/AboutView.vue'
import { useAuthStore } from '@/stores/auth'
import SecuritiesView from '@/pages/SecuritiesView.vue'

const routes = [
  { 
    path: '/auth', 
    name: 'Auth',
    component: () => import('@/pages/AuthPage.vue'),
    meta: { requiresAuth: false} 
  },
  { 
    path: '/', 
    name:'Home',
    component: HomeView,
    meta: { requiresAuth: true} 
  },
  { 
    path: '/about', 
    component: AboutView,
    meta: { requiresAuth: true}  
  },
  { 
    path: '/security-list', 
    component: SecuritiesView,
    meta: { requiresAuth: true}  
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  const auth = useAuthStore()
console.log(to.meta.requiresAuth && !auth.isAuthenticated);

  if(to.meta.requiresAuth && !auth.isAuthenticated){
    next({name: 'Auth'})
  } else if (to.name === 'Auth' && auth.isAuthenticated) {
    next({name: 'Home'})
  } else {
    next()
  }
})

export default router
