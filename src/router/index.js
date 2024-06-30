import { createRouter, createWebHistory } from 'vue-router';
import AddSupplier from '../components/AddSupplier.vue';
import SupplierList from '../components/SupplierList.vue';

const routes = [
   { path: '/', redirect: '/add-supplier' },
   { path: '/suppliers', component: SupplierList },
   { path: '/add-supplier', component: AddSupplier },
];

const router = createRouter({
   history: createWebHistory(),
   routes,
});

export default router;
