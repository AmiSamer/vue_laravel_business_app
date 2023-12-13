
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
                <div class="row-12">
              <div v-if="user.status == 1" class="card">
               <div class="card-header">
                 <h3 class="card-title" style="text-align: center;">Sales report</h3>
                 
               </div>
               <!-- /.card-header -->
               <div class="card-body">

                <form @submit.prevent="dateWiseReport">
                  <div class="row">
                  <div class="col-md-6 col-sm-6 form-group">
                    <label for="">Starting Date</label><br>
                    <input type="date" id="dd" v-model="report.start_date" class="form-control">
                  </div>

                  <div class="col-md-6 col-sm-6 form-group">
                    <label for="">End Date</label><br>
                    <input type="date" v-model="report.end_date" class="form-control" >
                  </div>
                </div>
               
                <a href="" @click="refresh()" class="btn btn-danger float-right" style="margin-left: 5px;">Refresh</a>
                <button type="submit" class="btn btn-info float-right">Submit</button>
                </form>
                <br>
                <br>
                <br>
                 <table  id="example4" class="table table-bordered table-striped">
                   <thead>
                   <tr>
                     <th>Selling Date</th>
                     <th>Product Name</th>
                     <th>Action</th>                                     
                   </tr>
                   </thead>
                   <tbody>
                   </tbody>                
                 </table>

               </div>
               <!-- /.card-body -->
     </div>
     <div v-else>
      <h4>Please purchase your subscription. Thank you</h4>
     </div>
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
 import  Navbar from './partials/Topbar.vue';
 import  TemplateSidebar from './partials/TemplateSidebar.vue';
 import  TemplateFooter from './partials/Footer.vue';
 import  router from '../router/index.js'
//  import axios from 'axios';
 import Swal from 'sweetalert2'
 import store from '../store/index.js'

 
 export default {
   name : 'sale_report',
   components : {Navbar, TemplateSidebar, TemplateFooter},
   computed : {
        user() {
            return store.getters.getUser;
        }
    },
   data(){
     return {
      report : {
        start_date : '',
        end_date : ''
      }
     }

   },

    created() {
      $(document).ready(function () {


            $('#example4').DataTable({
                "processing": true,
                "serverSide": true,
                "searching" : false,
                "bDestroy": true,
                "ajax": "/business/api/show_all_sale",
                "columns": [
                    { "data": "date" },
                    { "data": "product_name" },
                    { "data": "action" },                   
                ]
            });

            });   
     },

     methods : {

      dateWiseReport(){
        var start = this.report.start_date;
        var end = this.report.end_date;
        if(start == ''){
          Swal.fire({
            icon: "warning",
            title: "Please enter starting date",
          });
          return false;
        }
        if(end == ''){
          Swal.fire({
            icon: "warning",
            title: "Please enter end date",
          });
          return false;
        }
          $('#example4').DataTable({
                "processing": true,
                "serverSide": true,
                "searching" : false,
                "bDestroy": true,
                "ajax" : {
                     "url" : "/business/api/date_wise_report",
                     "type" : "POST",
                     "data": {
                              start_date: start,
                              end_date: end,
                              _token: $('meta[name="csrf-token"]').attr('content')                    
                            },
                    },
                
                "columns": [
                    { "data": "date" },
                    { "data": "product_name" },
                    { "data": "action" },                   
                ]
            });
        
      },

      refresh(){
        window.location.reload();
      }

     },
    

   mounted(){

    //  $(function () {
     $('#example4').on('click','.updateUser',function(){
      var show_sale_id = $(this).data('id');
      router.push("/business/sale/show/"+show_sale_id);       
      })
      
      $('#example4').on('click','.deleteUser',function(){
      var show_sale_id = $(this).data('id');

      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get('/business/api/delete_sale/'+show_sale_id).then( response => {
            Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
          });
          setTimeout(function(){ window. location. reload(); }, 800);
        })
          
        }
      });

      }) 
      
    // })

    }
 }
 </script>