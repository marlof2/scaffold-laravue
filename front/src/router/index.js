import Vue from 'vue'
import Router from 'vue-router'
import Jwt from "../api/jwt";


// Routes
import UsersRoutes from "@/modules/users/_routes";
import LoginRoutes from "@/modules/login/_routes";
import PapelRoutes from "@/modules/papel/_routes";

Vue.use(Router)

export const routes = [
  ...UsersRoutes,
  ...LoginRoutes,
  ...PapelRoutes,
  {
    path: "/",
    name: "login",
    component: () => import("@/modules/login"),
    meta: {
      layout: 'auth'
    }
  },
  {
    path: '/dashboard/analytics',
    name: 'dashboard-analytics',
    component: () => import(/* webpackChunkName: "dashboard" */ '@/pages/dashboard/DashboardPage.vue')
  },
  {
    path: '/pagina-inicial',
    name: 'pagina-inicial',
    component: () => import(/* webpackChunkName: "blank" */ '@/pages/BlankPage.vue')
  },
  {
    path: '*',
    name: 'error',
    component: () => import(/* webpackChunkName: "error" */ '@/pages/error/NotFoundPage.vue'),
    meta: {
      layout: 'error'
    }
  }]

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL || '/',
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) return savedPosition

    return { x: 0, y: 0 }
  },
  routes
})

/**
 * Before each route update
 */
router.beforeEach((to, from, next) => {
  if (to.name === "login" && Jwt.getToken()) {
    return next("pagina-inicial");
  }
  if (to.name !== "login" && !Jwt.getToken()) {
    window.localStorage.clear()
    return next("login");
  }

  return next();
});

/**
 * After each route update
 */
router.afterEach((to, from) => {
})

export default router
