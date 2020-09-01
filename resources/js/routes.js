import HomePage from './Pages/Home';
import Layout from './layouts/Layout';
import Panel from './Pages/Panel/index';

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
                icon: 'mdi-home',
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
                icon: 'mdi-account-multiple',
                component: Panel.Users
            },
            {
                path: '/panel/companies',
                name: 'panel.companies',
                display: 'Companies',
                icon: 'mdi-account-multiple',
                apiUrl: 'companies',
                component: Panel.Companies
            },
        ]
    },
]
