import { createRouter, createWebHistory } from "vue-router";

import Home from "../views/Home.vue";
import FruitDetail from "../components/FruitDetail.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: Home,
    },

    {
      path: "/detail/",
      name: "detail",
      component: FruitDetail,
    },
  ],
});

export default router;
