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
 
 
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h5 class="m-0" style="text-align: center;">Welcome</h5>
           <h1 style="color: orange; text-align: center">{{ user.name }}</h1>
         </div><!-- /.col -->
        
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
 
   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
      
   

   <div class="row">

    <!-- chart  -->
    <div class="col-md-4">
      <br>
     <canvas id="myChart" width="auto" height="auto"></canvas>
   </div>
   <!-- chart ends  -->


   <div class="col-md-6">
    <br>
    <div class="col-md-12 col-sm-12">
        <!-- small card -->
        <div class="small-box bg-success">
          <div class="inner">              
            <h3>{{today_total}} &#2547;</h3>
            <h5>Today's Total Sales</h5>

          </div>
          <div class="icon">
            <i class="fas fa-money-bill-wave"></i>
          </div>
          <!-- <a href="#" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a> -->
          
            <router-link v-if="user.status == 1" to="/business/today_total_sale" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </router-link>
          
          
        </div>
      </div>



<div class="row-12">
  <div class="card">
               <div class="card-header">
                 <h3 class="card-title">Sales chart of year <span style="color: yellow;">{{ current_year }}</span></h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                 <table id="example3" class="table table-bordered table-striped">
                   <thead>
                   <tr>
                     <th>Months</th>
                     <th>Total Sales (BDT)</th>
                     
                   </tr>
                   </thead>
                   <tbody>
                   <tr>
                     <td>January</td>
                     <td v-if="january_sale == 0">-</td>
                     <td v-else>{{ january_sale }} &#2547;</td>
                    
                   </tr>
                   <tr>
                     <td>February</td>
                     <td v-if="february_sale == 0">-</td>
                     <td v-else>{{ february_sale }} &#2547;</td>
                    
                   </tr>
                   <tr>
                    <td>March</td>
                    <td v-if="march_sale == 0">-</td>
                    <td v-else>{{ march_sale }} &#2547;</td>
                     
                   </tr>
                   <tr>
                    <td>April</td>
                     <td v-if="april_sale == 0">-</td>
                     <td v-else>{{ april_sale }} &#2547;</td>
                     
                   </tr>
                   <tr>
                     <td>May</td>
                     <td v-if="may_sale == 0">-</td>
                     <td v-else>{{ may_sale }} &#2547;</td>
                     
                   </tr>
                   <tr>
                     <td>June</td>
                     <td v-if="june_sale == 0">-</td>
                     <td v-else>{{ june_sale }} &#2547;</td>
                    
                   </tr>
                   <tr>
                     <td>July</td>
                     <td v-if="july_sale == 0">-</td>
                     <td v-else>{{ july_sale }} &#2547;</td>
                    
                   </tr>
                   <tr>
                     <td>August</td>
                     <td v-if="august_sale == 0">-</td>
                     <td v-else>{{ august_sale }} &#2547;</td>
                     
                   </tr>
                   <tr>
                     <td>September</td>
                     <td v-if="september_sale == 0">-</td>
                     <td v-else>{{ september_sale }} &#2547;</td>
                     
                   </tr>
                   <tr>
                     <td>October</td>
                     <td v-if="october_sale == 0">-</td>
                     <td v-else>{{ october_sale }} &#2547;</td>
                     
                   </tr>
                   <tr>
                     <td>November</td>
                     <td v-if="november_sale == 0">-</td>
                     <td v-else>{{ november_sale }} &#2547;</td>
                     
                   </tr>
                   <tr>
                     <td>December</td>
                     <td v-if="december_sale == 0">-</td>
                     <td v-else>{{ december_sale }} &#2547;</td>
                     
                   </tr>
                   </tbody>
                   
                 </table>
               </div>
               <!-- /.card-body -->
     </div>
</div>
 <br>   
</div>

   </div> 
    </div>
     <!--/. container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 
 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
   <!-- Control sidebar content goes here -->
 </aside>
 <!-- /.control-sidebar -->
 
 <!-- footer  -->
 <TemplateFooter/>
 <!-- footer ends  -->
 
 </div>
 </template>
 
 <script>
 import  Navbar from './partials/Topbar.vue';
 import  TemplateSidebar from './partials/TemplateSidebar.vue';
 import  TemplateFooter from './partials/Footer.vue';
 import store from '../store/index.js'
 import Chart from 'chart.js/auto';
//  import axios from 'axios';

 
 export default {
    name : 'dashboard',
    components : {Navbar, TemplateSidebar, TemplateFooter},
    computed : {
        user() {
            return store.getters.getUser;
        }
    },
    data(){
      return {
        today_total : '',
        current_year : '',

        january_sale : '',
        february_sale : '',
        march_sale : '',
        april_sale : '',
        may_sale : '',
        june_sale : '',
        july_sale : '',
        august_sale : '',
        september_sale : '',
        october_sale : '',
        november_sale : '',
        december_sale : '',
      }
    },

    created(){
      axios.get('/business/api/total_today').then(response=>{
        console.log('money',response.data.total)
        console.log('today',response.data.today)
        this.today_total = response.data.total
      }),

      axios.get('/business/api/total_year').then(response=>{
        console.log('yearly_money',response.data)
        
        this.current_year = response.data.current_year

        this.january_sale = response.data.january_sale
        this.february_sale = response.data.february_sale
        this.march_sale = response.data.march_sale
        this.april_sale = response.data.april_sale
        this.may_sale = response.data.may_sale
        this.june_sale = response.data.june_sale
        this.july_sale = response.data.july_sale
        this.august_sale = response.data.august_sale
        this.september_sale = response.data.september_sale
        this.october_sale = response.data.october_sale
        this.november_sale = response.data.november_sale
        this.december_sale = response.data.december_sale
      })
    },

    mounted(){ 
      const ctx = document.getElementById('myChart'); 
      const data = {
            labels: [
              'January',
              'February',
              'March',
              'April',
              'May',
              'June',
              'July',
              'August',
              'September',
              'October',
              'November',
              'December',
            ],
            datasets: [{
              label: 'My First Dataset',
              data: [100,
                     100,
                     100,
                     100,
                     100,
                     100,
                     100,
                     100,
                     100,
                     100,
                     100,
                     100,
              ],
              backgroundColor: [
                '#F4C2C2',
                'red',
                'black',
                'white',
                'skyblue',
                'green',
                'yellow',
                'grey',
                'teal',
                'purple',
                'orange',
                'blue',
              ],
              hoverOffset: 4
            }]
          };
          
      const myChart = new Chart(ctx,{
        type: 'doughnut',
        data: data,
        options: {
        plugins: {
            legend: {
                labels: {

                   color : "white",
                    // This more specific font property overrides the global property
                    
                }
            }
        }
    }
      });
      myChart;
  }
    
 }

  // $(function () {
  //    $("#example3").DataTable({
  //      "responsive": true,
  //      "paging": true, 
  //      "lengthChange": false, 
  //      "autoWidth": true,
  //      "searching": true,
  //      "ordering": false,
  //      "info": true,
  //      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  //    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  //  });





 </script>