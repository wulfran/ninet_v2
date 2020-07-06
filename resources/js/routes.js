import HomePage from './Pages/Home';
import Layout from './layouts/Layout';
import Panel from './Pages/Panel/index';

export default [
    {
        path: '/',
        name: 'layout',
        component: Layout,
        children: [
            { path: '/', name: 'home.index', component: HomePage.Index },
            {
                path: '/panel/dashboard',
                name: 'panel.dashboard',
                display: 'Dashboard',
                icon: 'mdi-home',
                component: Panel.Dashboard
            },
            {
                path: '/panel/users',
                name: 'panel.users',
                display: 'Users',
                icon: 'mdi-account-multiple',
                component: Panel.Users
            },
        ]
    }
]
