<template>
    <body class="hold-transition login-page" style="background-color: #343a40 !important;">
<div class="login-box">
    <div class="login-logo" style="margin-left: -105px;">
            <img src="public/frontend/img/logo.png" height="72"/>
    </div>
    <div class="login-logo" style="margin-top: -25px !important;">    
            <a href=""><b style="color: teal;">e - </b><span>হিসাব</span></a>
    </div>
  <!-- /.login-logo -->
  <div class="card" style="padding-top: 40px; padding-bottom: 100px; background-color: #485159">
    <div class="card-body login-card-body" style="background-color: #485159;">
        
      <p class="login-box-msg">Please login to your account</p>

      <form @submit.prevent="loginFormSubmit">
        <label for="">Email :</label>
        <div class="input-group mb-3">
          <input type="email" class="form-control" v-model="form.email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <label for="">Password :</label>
        <div class="input-group mb-3">
          <!-- <input type="password" class="form-control" v-model="form.password"> -->
          <input v-if="showCurrentPassword" type="text" class="form-control" v-model="form.password" >
          <input v-else type="password" class="form-control" v-model="form.password" >
          <div class="input-group-append">
            <!-- <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div> -->
            <button class="btn btn-success btn-sm"  @click="toggleShowCurrentPassword"><span class="icon is-small is-right">
            <i style="padding-top: 4px;" class="fas" :class="{ 'fa-eye-slash': showCurrentPassword, 'fa-eye': !showCurrentPassword }"></i>
            </span>
            </button>  
          </div>
        </div>
        <br>
        <div class="row"> 
          <!-- /.col -->
          
          <div class="col-12">
            <button type="button" @click="userLogin" class="btn btn-success btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

</body>
</template>

<script>
import router from '../../router/index.js'
// import axios from 'axios'
import store from '../../store/index.js'
import Swal from 'sweetalert2'

export default {

  computed : {
    buttonLabelForCurrentPassword() {
           return (this.showCurrentPassword) ? "Hide" : "Show";
        }
  },
   data() {
      return {
        showCurrentPassword : false,
         form: {
            email: '',
            password: ''
         }
      }
   },
   
methods: {   
  
  toggleShowCurrentPassword() {
      this.showCurrentPassword = !this.showCurrentPassword;
    },

    loginFormSubmit(e) {
        e.preventDefault();
      },

      userLogin(){

          if(this.form.email == ''){
            Swal.fire({
              icon: "warning",
              title: "Please Enter email address",
            });
            return false;
          }

          if(this.form.password == ''){
            Swal.fire({
              icon: "warning",
              title: "Please Enter your password",
            });
            return false;
          }

          axios.get('sanctum/csrf-cookie').then(response => {
          axios.post('/business/api/login', this.form).then(response => {
          this.getUserData();
           let dash=  router.push({name :'dashboard'})
           if(dash){
            Swal.fire({
            icon: "success",
            title: "user logged in successfully!",
          });
            location.replace("/business/dashboard")
           }           
             console.log('henlo');
          }).catch(error => Swal.fire({
              icon: "error",
              title: "Email and password did not match",
              }))
        })
      },

      getUserData(){
        axios.get('/business/api/user').then(response => {
            console.log(response.data);
            let user = response.data;
            store.commit('SET_USER',user);
            store.commit('SET_AUTHENTICATED',true);
            localStorage.setItem("auth",true);
          })
      }      
   },

   mounted(){
        }
}
</script>