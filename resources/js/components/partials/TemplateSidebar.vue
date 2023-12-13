<template>
    <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <router-link to="/business/" class="brand-link"><img src="public/frontend/img/logo.png" height="48" width="58"/><br><b style="color: teal; margin-left: 25px;">e -</b> হিসাব</router-link>
  <!-- Sidebar -->
  <div class="sidebar" >
    <!-- Sidebar Menu -->
    <nav class="mt-2" style="margin-top: 60px !important;">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">    
          <ul class="nav nav-treeview">          
            <li class="nav-item ">
              <router-link to="/business/" class="nav-link active"><i class="fa fa-tachometer-alt nav-icon"></i>
                <p>Dashboard</p></router-link>
            </li>     
          </ul>
        </li>


        <li v-if="user.status == 1" class="nav-item menu-open">    
          <ul class="nav nav-treeview">          
            <li class="nav-item ">
              <router-link to="/business/add_sale" class="nav-link"><i class="fas fa-plus nav-icon"></i>
                <p>Add Sale</p></router-link>
            </li>     
          </ul>
        </li>

        <li v-if="user.status == 1" class="nav-item menu-open">    
          <ul class="nav nav-treeview">          
            <li class="nav-item ">
              <router-link to="/business/sale_report" class="nav-link"><i class="fas fa-table nav-icon"></i>
                <p>Sales Report</p></router-link>
            </li>     
          </ul>
        </li>

        <li v-if="user.role_id == 1" class="nav-item menu-open">    
          <ul class="nav nav-treeview">          
            <li class="nav-item ">
              <router-link to="/business/all_user_list" class="nav-link"><i class="fas fa-user nav-icon"></i>
                <p>User List</p></router-link>
            </li>     
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
</template>


<script>
import store from '../../store/index.js'

export default {
  computed : {
        user() {
            return store.getters.getUser;
        }
    }
}
</script>
