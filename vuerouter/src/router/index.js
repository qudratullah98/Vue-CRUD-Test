import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import UserComponent from '../components/UserComponent.vue'
import EditComponent from '../components/EditComponent.vue'
import UpdateComponent from '../components/UpdateComponent.vue';
const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  }, {
    path: '/users',
    name: 'users',
    component: UserComponent
  }, {
    path: '/users/edit/:id',
    name: 'EditUser',
    component: EditComponent
  },{
    path: '/Create/User',
    name: 'NewUser',
    component: UpdateComponent
  }, 
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
