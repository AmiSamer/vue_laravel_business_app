<template>

    <div class="wrapper">
 
         <!-- Preloader -->
   <!-- <div class="preloader flex-column justify-content-center align-items-center">
     <img class="animation__wobble" src="public/frontend/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
   </div> -->
 
 
         <!-- topbar -->
         <Navbar/>
         <!-- topbar ends -->
 
         <!-- sidebar -->
         <TemplateSidebar/>
         <!-- sidebar ends -->
     <div class="content-wrapper">
         <div class="content-header">
             <div class="container-fluid">
                 <div class="col-md-12">
                    
             <!-- general form elements -->
             <div class="card card-primary">
               <div class="card-header">
                 <h3 class="card-title">Profle</h3>
               </div>
               <!-- /.card-header -->
               <!-- form start -->
               <form @submit.prevent="myFormSubmit">
                 <div class="card-body">
                  <!-- <input v-model="form.user.name"> -->
 
                  <div class="row">
                   <div class="col-md-6 col-sm-6">
                     <div class="form-group">
                     <label for="exampleInputEmail1">Name<small style="color: red;"><b>*</b></small></label>
                     <input type="text" class="form-control" v-model="user.name" >
                   </div>
                   </div>
 
                   <div class="col-md-6 col-sm-6">
                     <div class="form-group">
                     <label for="exampleInputEmail1">Email <small style="color: red;"><b>*</b></small></label>
                     <input type="email" class="form-control" v-model="user.email"  placeholder="Enter Product Name">
                   </div>
                   </div>
 
 
                   <div class="col-md-4 col-sm-4">                   
                       <div class="form-group">
                        <label >Password <small style="color: red;"><b>*</b></small></label>
                        <div class="input-group">                   
                        <input v-if="showCurrentPassword" type="text" class="form-control" v-model="form.password" >
                        <input v-else type="password" class="form-control" v-model="form.password" >   
                        <div class="input-group-append">                      
                      <button class="btn btn-success btn-sm"  @click="toggleShowCurrentPassword"><span class="icon is-small is-right">
                      <i style="padding-top: 4px;" class="fas" :class="{ 'fa-eye-slash': showCurrentPassword, 'fa-eye': !showCurrentPassword }"></i>
                      </span>
                      </button>                        
                        </div>
                        </div>                
                        </div>                    
                  </div>

                  <div class="col-md-4 col-sm-4">
                   <div class="form-group">
                     <label for="exampleInputPassword1">New Password <small style="color: red;"><b>*</b></small></label>
                     <div class="input-group">                   
                        <input v-if="showNewPassword" type="text" class="form-control" v-model="form.new_password" >
                        <input v-else @keypress="newPass" type="password" class="form-control" v-model="form.new_password" >   
                        <div class="input-group-append">                      
                      <button class="btn btn-success btn-sm"  @click="toggleShowNewPassword"><span class="icon is-small is-right">
                      <i style="padding-top: 4px;" class="fas" :class="{ 'fa-eye-slash': showNewPassword, 'fa-eye': !showNewPassword }"></i>
                      </span>
                      </button>                        
                        </div>
                      </div>
                     <!-- <input type="password" class="form-control" v-model="form.new_password" > -->
                   </div>
                  </div>
 
                  <div class="col-md-4 col-sm-4">
                   <div class="form-group">
                     <label for="exampleInputPassword1">Confirm New Password <small style="color: red;"><b>*</b></small></label>
                     <input @keyup="confirmPassword" type="password" class="form-control" v-model="form.confirm_password">
                   </div>
                   <label for="confirm-password" v-if="form.invalidPasswords" style="color: yellow;">Not matched</label>
                   <label for="confirm-password" v-if="form.validPasswords" style="color: lightgreen;">Matched!</label>
                  </div>
                 
                  </div>
                 </div>
                 <!-- /.card-body -->
 
                 <div class="card-footer">
                   <button  type="button" @click="updateProfile()" :disabled="form.submitDisabled" class="btn btn-warning float-right">update</button>
                 </div>
               </form>
             </div>
             <!-- /.card -->
           </div>              
             </div>
         </div>
     </div>
 
     <!-- footer  -->
 <TemplateFooter/>
 <!-- footer ends  -->
    </div>  
 </template>
 
 <script>
 import  Navbar from '../partials/Topbar.vue';
 import  TemplateSidebar from '../partials/TemplateSidebar.vue';
 import  TemplateFooter from '../partials/Footer.vue';
 import  store from '../../store/index.js';
 import  router from '../../router/index.js'
 import Swal from 'sweetalert2'
 


 export default {
   name : 'profile',
   components : {Navbar, TemplateSidebar, TemplateFooter},
   computed : {
         user() {
             return store.getters.getUser;
         },
         buttonLabelForCurrentPassword() {
           return (this.showCurrentPassword) ? "Hide" : "Show";
        },
        buttonLabelForNewPassword() {
           return (this.showNewPassword) ? "Hide" : "Show";
        },
     },
 
   data(){
     return {
      showCurrentPassword: false,
      showNewPassword: false,
       form : {
        password : '',
        new_password : '',
        confirm_password : '',
        invalidPasswords: false,
        validPasswords: false,
        submitDisabled: false    
       }
     }
   },
 
   methods : {

    toggleShowCurrentPassword() {
      this.showCurrentPassword = !this.showCurrentPassword;
    },

    toggleShowNewPassword() {
      this.showNewPassword = !this.showNewPassword;
    },
     
    updateProfile(){

            
      if(this.user.name == ''){      
          Swal.fire({
              icon: "warning",
              title: "Please Enter your name",
            });
          return false;
      }

      if(this.user.email == ''){   
          Swal.fire({
              icon: "warning",
              title: "Please enter your email address",
            });
          return false;
      }

      if(this.form.password == ''){
          Swal.fire({
              icon: "warning",
              title: "Please enter your password",
            });
          return false;
      }

      if(this.form.new_password.length < 8){
        Swal.fire({
              icon: "warning",
              title: "Password must be at least 8 characters",
            });
        return false;
      }

      if(this.form.confirm_password == ''){
          Swal.fire({
              icon: "warning",
              title: "Please confirm your password",
            });
          return false;
      }

      if(this.form.new_password != this.form.confirm_password){
        Swal.fire({
              icon: "warning",
              title: "New password and confirm password did not match",
            });
        return false;
      }


    const myForm = new FormData()
    myForm.append('user_id',this.user.id)
    myForm.append('name',this.user.name)
    myForm.append('email',this.user.email)
    myForm.append('current_password',this.form.password)
    myForm.append('new_password',this.form.new_password)
    axios.post('/business/api/user_profile_update',myForm).then(response => {
      console.log('checking_response',response)
      if(response.data.flag == 0){
        Swal.fire({
              icon: "error",
              title: response.data.message,
              })

      }else{

           if(response.data.error == true){
            Swal.fire({
              icon: "error",
              title: response.data.message,
              })
           }else{
            localStorage.removeItem("auth");
            Swal.fire({
            icon: "success",
            title: "Profile updated successfully!",
            });
            location.replace("/business/login")  
            setTimeout(function(){ window. location. reload(); }, 800);
            
           }
       
      }

       
    }).catch(error => Swal.fire({
              icon: "error",
              title: response.data.message,
              }))
      },

      myFormSubmit(e) {
        e.preventDefault();
      },

      confirmPassword(){
            if((this.form.new_password != this.form.confirm_password)){
              this.form.invalidPasswords = true
              this.form.validPasswords = false
              this.form.submitDisabled = true
            }else{
              this.form.invalidPasswords = false
              this.form.validPasswords = true
              this.form.submitDisabled = false
              
            }
          },

        newPass(){
          this.form.validPasswords = false
          this.form.invalidPasswords = false
        }

  },
  mounted(){
        }
   
 }
 </script>