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

    <form @submit.prevent="login">
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
        <input type="password" class="form-control" v-model="form.password">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <br>
      <div class="row"> 
        <!-- /.col -->
        
        <div class="col-12">
          <button type="submit" class="btn btn-success btn-block">Login</button>
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
import router from '../router/index.js'
// import axios from 'axios'
import store from '../store/index.js'
import Swal from 'sweetalert2'

export default {
 data() {
    return {
       form: {
          email: '',
          password: ''
       }
    }
 },
 
methods: {    
    login(){

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
        console.log('henlo');
        axios.post('/business/api/login', this.form).then(response => {
          this.getUserData();
         let dash=  router.push({name :'dashboard'})
         if(dash){
          // alert('user logged in successfully')
          Swal.fire({
            icon: "success",
            title: "user logged in successfully!",
            // timer: 1500
          });
          location.replace("/business/dashboard")
         }         
          console.log(response);
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