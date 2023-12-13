import {createRouter, createWebHistory} from 'vue-router'

import Home from '../components/Home.vue'
import Dashboard from '../components/Dashboard.vue'
import NotFound from '../components/NotFound.vue'
import AddSale from '../components/AddSale.vue'
import SalesReport from '../components/SalesReport.vue'
import SalesReportShow from '../components/SalesReportShow.vue'
import TodayTotalSale from '../components/TodayTotalSale.vue'
import AdminLogin from '../components/auth_components/Login.vue'
import UserProfile from '../components/auth_components/Profile.vue'
import AdminRegister from '../components/auth_components/Register.vue'
import AllUser from '../components/auth_components/AllUser.vue'


const routes = [
    {
        path : '/business',
        component : Home,
        name : 'intro_page',
        meta : {
            requiresVisitor : true,
        }
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
        // component: () => import('../components/UserList.vue')
    },

    {
        path : '/business/add_sale',
        name : 'add_sale',
        component : AddSale,
        meta : {
            requiresAuth : true,
        }
    },
    {
        path : '/business/sale_report',
        name : 'sale_report',
        component : SalesReport,
        meta : {
            requiresAuth : true,
        }
    },

    {
        path : '/business/sale/show/:id',
        name : 'show_single_sale',
        component : SalesReportShow,
        meta : {
            requiresAuth : true,
        },
        props : true
    },

    {
        path : '/business/today_total_sale',
        name : 'today_total',
        component : TodayTotalSale,
        meta : {
            requiresAuth : true,
        },
        props : true
    },

    {
        path : '/business/login',
        name : 'login',
        component : AdminLogin,
        meta : {
            requiresVisitor : true,
        }
    },

    {
        path : '/business/profile',
        name : 'profile',
        component : UserProfile,
        meta : {
            requiresAuth : true,
        }
    },

    {
        path : '/business/register',
        component : AdminRegister,
        meta : {
            requiresVisitor : true,
        }
    },
    {
        path : '/business/dashboard',
        name: 'dashboard',
        component : Dashboard,
        meta : {
            requiresAuth : true,
        }
    },
    {
        path : '/business/all_user_list',
        name: 'all_user',
        component : AllUser,
        meta : {
            requiresAuth : true,
        }
    }
]


const router = createRouter({
    history: createWebHistory(),
    routes
  })
  
  export default router