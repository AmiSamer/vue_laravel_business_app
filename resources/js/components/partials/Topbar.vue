<template>
    <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
   
  </ul>

  <!-- Right navbar links -->
  
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->

    

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <span></span>
        <i class="far fa-user"></i>      
      </a>      
        <div class="dropdown-menu dropdown-menu dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{ user.name }}</span>
        <div class="dropdown-divider"></div>
          <router-link  to="/business/profile" v-if="user.status == 1" class="nav-link" style="text-align: center;"><i class="fas fa-user mr-2"></i>Profile</router-link>
          <div class="dropdown-divider"></div>
          <span v-if="user.id" class="nav-link" style="text-align: center;" @click="logoutUser()"><button class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button></span> 
          <!-- <router-link v-else to="/business/login" class="nav-link" style="text-align: center;"><i class="fas fa-sign-in-alt mr-2"></i>Login</router-link>   -->
        
      </div>     
    </li> 
  </ul>

</nav>
<!-- /.navbar -->
</template>

<script>
 
//  import axios from 'axios';
import router from '../../router/index.js';
import Swal from 'sweetalert2'
import store from '../../store/index.js'

 export default {
       name : 'Topbar details',
       computed : {
        user() {
            return store.getters.getUser;
        }
        },
      
       methods : {
         logoutUser(){         
           axios.post('/business/api/logout').then(response => {
            localStorage.removeItem("auth");            
            Swal.fire({
            icon: "success",
            title: "User logged out successfully",
            });
           setTimeout(function(){ window. location. reload(); }, 800);         
            console.log('success');
          })
         }         
       }
 }

</script>