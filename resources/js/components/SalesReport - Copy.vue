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
     <div class="card">
               <div class="card-header">
                 <h3 class="card-title" style="text-align: center;">Sales report</h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                 <table id="example4" class="table table-bordered table-striped">
                   <thead>
                   <tr>
                     <th>Serial</th>
                     <th>Product</th>
                     <th>Selling Date</th>                        
                     <th>Action</th>                   
                   </tr>
                   </thead>
                   <tbody>
                   <tr v-for="(sale,i) in sales" :key="sale.id">
                     <td>{{ i+1 }}</td>
                     <td>{{ sale.product_name }}</td>
                     <td> {{ moment(sale.created_at).format("DD-MM-YYYY") }}</td>                                
                     <td><button class="btn btn-warning">View</button> | <button class="btn btn-danger">Delete</button></td>                  
                   </tr>
                   </tbody>
                  
                 </table>
               </div>
               <!-- /.card-body -->
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
 import  store from '../store/index.js';
 // import  router from '../router/index.js'
 import  axios from 'axios'
 import moment from "moment";
 
 export default {
   name : 'sale_report',
   components : {Navbar, TemplateSidebar, TemplateFooter},
   computed : {
         user() {
             return store.getters.getUser;
         }
     },
     data : function(){        
      return {
        sales : [],
        moment : moment
      }


     },
     created() {

      try{
        axios.get('/business/api/show_all_sale').then(response => {
        console.log('my_response', response)
        this.sales = response.data.sales

       }).catch(error => window.alert('Error occured.'))
      }catch(error){
        this.loading = false;
        this.errorMessage = error;
      }
       
     },
   mounted(){
    $(function () {
     $("#example4").DataTable({
       "responsive": true,
       "paging": true, 
       "lengthChange": false, 
       "autoWidth": false,
       "searching": true,
       "ordering": false,
       "info": true,
       "retrieve": true,
       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
     });
    
   });
        }
 }
 </script>