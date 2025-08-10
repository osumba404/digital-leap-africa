import { createRouter, createWebHistory } from 'vue-router'
import ProjectsView from '../views/ProjectsView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      // We will make the Projects page the default for now
      path: '/projects',
      name: 'projects',
      component: ProjectsView
    },
    // We can add a redirect so the root URL also goes to projects
    {
      path: '/',
      redirect: '/projects'
    }
  ]
})

export default router