import VueRouter from 'vue-router'
import Home from "./components/Home";
import About from "./components/About";

export default new VueRouter({
   routes: [
       {
           path: '/',
           name: 'home',
           component: Home
       },
       {
           path: '/about',
           name: 'about',
           component: About
       },
   ],
   mode: 'history'
});
