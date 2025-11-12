import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Dashboard from '../views/Dashboard.vue'

const router = createRouter({
  history: createWebHistory(),
  routes:[
    {path:'/login',component:Login},
    {path:'/register',component:Register},
    {path:'/dashboard',component:Dashboard,meta:{requiresAuth:true}},
    {path:'/',redirect:'/dashboard'}
  ]
})

router.beforeEach((to)=>{
  const auth = useAuthStore()
  if(to.meta.requiresAuth && !auth.isAuthenticated) return '/login'
})

export default router
