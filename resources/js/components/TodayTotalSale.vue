
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
                 <h3 class="card-title" style="text-align: center;">Today's Sales report</h3>
                 <br>
                 <br>
                 <h4 style="color: skyblue;">{{ today }}</h4>
               </div>
               <!-- /.card-header -->
               <div class="card-body">          
                <table id="example4" class="table " style="margin-left: -1rem;">
                   <thead>
                   <tr>
                     <th>Product Name</th>
                     <th>Product Price <span style="color: yellow;">(BDT)</span></th>
                     <th>Quantity</th>
                     <th>Total Selling Price <span style="color: yellow;">(BDT)</span></th>                                     
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
 import  Navbar from './partials/Topbar.vue';
 import  TemplateSidebar from './partials/TemplateSidebar.vue';
 import  TemplateFooter from './partials/Footer.vue';


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
                "ajax": "/business/api/today_all_sale",
                "columns": [
                    { "data": "product_name" },
                    { "data": "product_price" },
                    { "data": "quantity"},                   
                    { "data": "total_selling_price"},                   
                ]
            })

            });   
     },
     mounted(){
        axios.get('/business/api/total_today').then(response=>{
                console.log(response.data.today)
                this.today = response.data.today
                
            })
     }

 }
 </script>