import { createRouter, createWebHistory } from 'vue-router'
import LoginView from "../views/LoginView.vue"
import {isGuest, isAuth} from "../guard/index"
import DashboardView from "../views/DashboardView.vue"
import TransactionView from "../views/TransactionView.vue"
import ProductView from "../views/ProductView.vue"
import CashierView from "../views/CashierView.vue"

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path : "/login",
      component : LoginView,
      beforeEnter: isGuest,
    },
    {
      path: "/",
      component: DashboardView,
      beforeEnter: isAuth,
      props: {path:"/"}
    },
    {
      path: "/product",
      component: ProductView,
      beforeEnter: isAuth,
      props: {path:"/product"}
    },
    {
      path: "/transaction",
      component: TransactionView,
      beforeEnter: isAuth,
      props: {path:"/transaction"}
    },
    {
      path: "/cashier",
      component: CashierView,
      beforeEnter: isAuth,
      props: {path:"/cashier"}
    },
    
  ]
})

export default router
