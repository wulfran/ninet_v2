import HomePage from './Pages/Home';
import Layout from './layouts/Layout';
import Panel from './Pages/Panel/index';
import Invoices from "./Pages/Panel/Invoices/index";

export default [
    {
        path: '/',
        name: 'home',
        component: Layout,
        children: [
            {
                path: '/',
                name: 'home.index',
                display: 'Home',
                icon: 'fa-home',
                component: HomePage.Index
            },
        ]
    },
    {
        path: '/panel',
        name: 'panel',
        component: Layout,
        children: [
            {
                path: '/panel/users',
                name: 'panel.users',
                display: 'Users',
                icon: 'fa-users',
                component: Panel.Users
            },
            {
                path: '/panel/companies',
                name: 'panel.companies',
                display: 'Companies',
                icon: 'fa-building',
                apiUrl: 'companies',
                component: Panel.Companies
            },
            {
                path: '/panel/invoices',
                name: 'panel.invoices',
                display: 'Invoices',
                icon: 'mdi-account-multiple',
                component: Invoices.Index,
            }
        ]
    },
]
