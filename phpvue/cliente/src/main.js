import { createApp } from "vue";
import App from "./App.vue";

import axios from "axios";
import "bootstrap/dist/css/bootstrap.css";
import { createRouter, createWebHistory } from "vue-router";
import CategoryList from "./components/pages/CategoryList";
import CategoryCreate from "./components/pages/CategoryCreate";
import CategoryEdit from "./components/pages/CategoryEdit";
import CategoryShow from "./components/pages/CategoryShow";

axios.defaults.baseURL = process.env.VUE_APP_API_URL;
/*axios.interceptors.request.use(function (config) {
  config.headers['X-Binarybox-Api-Key'] = process.env.VUE_APP_API_KEY;
  return config;
});*/

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", component: CategoryList },
    { path: "/create", component: CategoryCreate },
    { path: "/edit/:id", component: CategoryEdit },
    { path: "/show/:id", component: CategoryShow },
  ],
});

createApp(App).use(router).mount("#app");
