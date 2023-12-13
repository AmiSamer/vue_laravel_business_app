
import './bootstrap';

import '../../public/frontend/plugins/jquery/jquery.min.js';
import '../../public/frontend/plugins/bootstrap/js/bootstrap.bundle.min.js';
import '../../public/frontend/plugins/jquery-ui/jquery-ui.min.js';
import '../../public/frontend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js';
import '../../public/frontend/dist/js/adminlte.js';




import '../../public/frontend/plugins/jquery-mousewheel/jquery.mousewheel.js';
import '../../public/frontend/plugins/raphael/raphael.min.js';
import '../../public/frontend/plugins/jquery-mapael/jquery.mapael.min.js';
import '../../public/frontend/plugins/jquery-mapael/maps/usa_states.min.js';
import '../../public/frontend/dist/js/pages/dashboard2.js';
import '../../public/frontend/plugins/chart.js/Chart.min.js';


import '../../public/frontend/plugins/datatables/jquery.dataTables.min.js'
import '../../public/frontend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'
import '../../public/frontend/plugins/datatables-responsive/js/dataTables.responsive.min.js'
import '../../public/frontend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'
import '../../public/frontend/plugins/datatables-buttons/js/dataTables.buttons.min.js'
import '../../public/frontend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'
import '../../public/frontend/plugins/jszip/jszip.min.js'

import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
pdfMake.vfs = pdfFonts.pdfMake.vfs;

import '../../public/frontend/plugins/datatables-buttons/js/buttons.html5.min.js'
import '../../public/frontend/plugins/datatables-buttons/js/buttons.print.min.js'
import '../../public/frontend/plugins/datatables-buttons/js/buttons.colVis.min.js'




import { createApp } from 'vue'
import app from './components/App.vue'
import router from './router/index.js'
import Vuex from 'vuex'
import store from './store/index.js'
import axios from 'axios';


//middleware related
function isLoggedIn() {
    return store.getters.getAuthenticated;
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
            next({
                name: 'login',
            })
        } else {
            next()
        }
    }else if(to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                name: 'dashboard',
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})



//auth user related
let auth = localStorage.getItem("auth");
if(auth){
    store.dispatch('authUser').then(() => {
        createApp(app).use(router,Vuex,store,axios).mount('#app')
    });
}else {
    createApp(app).use(router,Vuex,store,axios).mount('#app')
}





