// Apartements
import ApartementIndex from '@/components/apartement/Index.vue';
import ApartementCreate from '@/components/apartement/Create.vue';
import ApartementEdit from '@/components/apartement/Edit.vue';

// Page
import PageComponent from '@/layout/Page.vue';

// Auth 
import LoginComponent from '@/components/auth/LoginComponent.vue';
import LogoutComponent from '@/components/auth/LogoutComponent.vue';

const routes = [
    {
        path: '/',
        redirect: { name: 'login' }
    },
    {
        path: '/admin',
        name: 'admin',
        component: PageComponent,
        meta: { requiresAuth: true },
    },
    {
        path: '/admin/dashboard',
        name: 'dashboard',
        component: PageComponent,
        meta: { requiresAuth: true },
    },
    {
        path: '/admin/login',
        name: 'login',
        component: LoginComponent
    },
    {
        path: '/admin/logout',
        name: 'logout',
        component: LogoutComponent
    },
    
    // Posts
    {
        name: 'apartements',
        path: '/admin/apartements',
        component: ApartementIndex,
        meta: { requiresAuth: true },
    },
    {
        name: 'apartement-create',
        path: '/admin/apartement/create',
        component: ApartementCreate,
        meta: { requiresAuth: true },
    },
    {
        name: 'apartement-edit',
        path: '/admin/apartement/edit/:id',
        component: ApartementEdit,
        meta: { requiresAuth: true },
    },
];

export default routes