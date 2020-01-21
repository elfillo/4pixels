import VueRouter from 'vue-router'
import Welcome from "./components/Welcome";
import User from "./components/user/index";
import UserCreate from "./components/user/create";
import UserEdit from "./components/user/edit";
import Department from "./components/department/index";
import DepartmentCreate from "./components/department/create";
import DepartmentEdit from "./components/department/edit";

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
           path: '/user/:id/edit',
           name: 'user.edit',
           component: UserEdit
       },
       {
           path: '/department',
           name: 'department',
           component: Department
       },
       {
           path: '/department/create',
           name: 'department.create',
           component: DepartmentCreate
       },
       {
           path: '/department/:id/edit',
           name: 'department.edit',
           component: DepartmentEdit
       },
   ],
   mode: 'history',
   linkActiveClass: 'active'
});
