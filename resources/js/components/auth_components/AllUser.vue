
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
                 <h3 class="card-title" style="text-align: center;">All User List</h3>                
               </div>
               <!-- /.card-header -->
               <div class="card-body">          
                <table id="example4" class="table table-bordered table-striped">
                   <thead>
                   <tr>
                     <th>User name</th>
                     <th>User email</th>
                     <th>Active status</th>                                   
                   </tr>
                   </thead>
                   <tbody>
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

 import  Navbar from '../partials/Topbar.vue';
 import  TemplateSidebar from '../partials/TemplateSidebar.vue';
 import  TemplateFooter from '../partials/Footer.vue';
 import Swal from 'sweetalert2'

 export default {
   name : 'sale_report',
   components : {Navbar, TemplateSidebar, TemplateFooter},
   data(){
     return {
        today : '',
     }

   },

    created() {
      $(document).ready(function () {

            $('#example4').DataTable({
                "processing": true,
                "serverSide": true,
                "searching" : true,
                "ajax": "/business/api/all_user",
                "columns": [
                    { "data": "name" },
                    { "data": "email" },              
                    { "data": "action"},                   
                ]
            })

            });   
     },
     mounted(){

        $('#example4').on('click','.activation',function(){
      var user_id = $(this).data('id');

      Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, change activation!"
      }).then((result) => {
        if (result.isConfirmed) {
          axios.get('/business/api/change_status/'+user_id).then( response => {

            console.log(response.data)
            Swal.fire({
            title: "Status is changed!",
            text: "Status is changed successfully.",
            icon: "success"
          });
          setTimeout(function(){ window. location. reload(); }, 800);
        })
          
        }
      });

      }) 
        
     }

 }
 </script>