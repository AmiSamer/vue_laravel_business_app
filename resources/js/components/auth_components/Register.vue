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
      
    <p class="login-box-msg">Please sign up here!</p>

    <!-- form starts  -->
    <form  @submit.prevent="OnFormSubmit" >

      <label for="">Full Name :</label>
      <div class="input-group mb-3">
        <input type="text" class="form-control" v-model="form.name">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div>

      <label for="">Email :</label>
      <div class="input-group mb-3">
        <input type="email" class="form-control" v-model="form.email" autocomplete="off">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>

      <label for="">Password :</label>
      <div class="input-group mb-3">
        <!-- <input type="password" class="form-control" v-model="form.password" autocomplete="off"> -->
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

      <label for="">Confirm Password :</label>
      <div class="input-group mb-3">
        <input @keyup="confirmPassword" type="password" v-model="form.confirm" class="form-control" autocomplete="off"  id="confirm-password" >
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>
      <label for="confirm-password" v-if="form.invalidPasswords" style="color: yellow;">Password did not match!</label>

      <br>
      <div class="row"> 
        <!-- /.col -->
        
        <div class="col-12">
          <button type="button" @click="addUser()" class="btn btn-success btn-block" :disabled="form.submitDisabled" style="background-color: #1590a3; border-color: #1590a3;">Register</button>
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

// import { registerRuntimeCompiler } from 'vue';
 import router from '../../router/index.js'
// import axios from 'axios'
import store from '../../store/index.js'
import Swal from 'sweetalert2'

export default {
  name : 'Add Member',
  computed : {
    buttonLabelForCurrentPassword() {
           return (this.showCurrentPassword) ? "Hide" : "Show";
        }
  },
  data () {
            return {
              showCurrentPassword : false,
              form : {
                  full_name: '',
                  email: '',
                  password: '',
                  confirm: '',
                  invalidPasswords: false,
                  submitDisabled: false
              }
              
            }
        },
  methods : {

      toggleShowCurrentPassword() {
        this.showCurrentPassword = !this.showCurrentPassword;
      },

      
      addUser(){
        var my_password = this.form.password;
        var my_confirm_password = this.form.confirm;  
               
      if(this.form.name == ''){
          // alert('Please Enter your name.');
          Swal.fire({
              icon: "warning",
              title: "Please Enter your name",
            });
          return false;
      }

      if(this.form.email == ''){
          // alert('Please enter your email address.');
          Swal.fire({
              icon: "warning",
              title: "Please enter your email address",
            });
          return false;
      }

      if(this.form.password == ''){
          // alert('please enter your password.');
          Swal.fire({
              icon: "warning",
              title: "Please enter your password",
            });
          return false;
      }

      if(this.form.password.length < 8){
        // alert('password must be at least 8 characters.');
        Swal.fire({
              icon: "warning",
              title: "Password must be at least 8 characters",
            });
        return false;
      }

      if(this.form.confirm == ''){
          // alert('please confirm your password.');
          Swal.fire({
              icon: "warning",
              title: "Please confirm your password",
            });
          return false;
      }

      if(my_password != my_confirm_password){
        Swal.fire({
              icon: "warning",
              title: "Password did not match",
            });
        return false;
      }
          axios.get('sanctum/csrf-cookie').then(response => {
          axios.post('/business/api/register', this.form).then(response => {
            this.getUserData();
            let dash=  router.push({name :'dashboard'})
           if(dash){
            Swal.fire({
              icon: "success",
              title: "User registration is successfull",
            });
            location.replace("/business/dashboard")
           }
            console.log(response);
          }).catch(error => Swal.fire({
              icon: "error",
              title: error.response.data.message,
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
      },

      OnFormSubmit(e) {
        e.preventDefault();
      },

      confirmPassword() {
            if ((this.form.password !== this.form.confirm) && (this.form.confirm != '')){
              this.form.invalidPasswords = true
              this.form.submitDisabled = true
            } else {
              this.form.invalidPasswords = false
              this.form.submitDisabled = false
            }
          }

  },
  mounted(){
        }
}

</script>