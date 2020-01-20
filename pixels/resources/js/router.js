import VueRouter from 'vue-router'
import Welcome from "./components/Welcome";
import User from "./components/user/index";
import UserCreate from "./components/user/create";
import UserEdit from "./components/user/edit";

export default new VueRouter({
   routes: [
       {
           path: '/',
           name: 'welcome',
           component: Welcome
       },
       {
           path: '/user',
           name: 'user',
           component: User
       },
       {
           path: '/user/create',
           name: 'user.create',
           component: UserCreate
       },
       {
           path: '/user:id/edit',
           name: 'user.edit',
           component: UserEdit
       }
   ],
   mode: 'history',
   linkActiveClass: 'active'
});
