import { createRouter, createWebHistory } from 'vue-router';
import about from '../components/about.vue';
import employee from "../components/employee.vue";

const routes = [
    {
        path: '/about',
        component: about,
        name: 'about'
    },
    {
        path: '/employee',
        component: employee,
        name: 'employee'
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router