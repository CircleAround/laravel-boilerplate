import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import LoginView from '../views/LoginView.vue'
import AdminUsersView from '../views/admin/users/IndexView.vue'
import AdminUserEditView from '../views/admin/users/EditView.vue'
import AdminUserCreateView from '../views/admin/users/CreateView.vue'
import TeamsView from '../views/teams/IndexView.vue'
import TeamShowView from '../views/teams/ShowView.vue'
import TeamCreateView from '../views/teams/CreateView.vue'
import TeamEditView from '../views/teams/EditView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/admin',
    name: 'admin',
    children: [
      {
        path: 'users',
        name: 'adminUsers',
        component: AdminUsersView
      },
      {
        path: 'users/:id/edit',
        name: 'adminUserEdit',
        component: AdminUserEditView
      },
      {
        path: 'users/create',
        name: 'adminUserCreate',
        component: AdminUserCreateView
      }
    ]
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  },
  {
    path: '/teams',
    name: 'teams',
    component: TeamsView,
  },
  {
    path: '/teams/:id/edit',
    name: 'teamEdit',
    component: TeamEditView,
  },
  {
    path: '/teams/create',
    name: 'teamCreate',
    component: TeamCreateView,
  },
  {
    path: '/teams/:id',
    name: 'teamShow',
    component: TeamShowView,
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
