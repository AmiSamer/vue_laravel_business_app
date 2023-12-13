<style>
.sidebar-mini .sidebar-closed .sidebar-collapse {
  overflow:hidden;
}
</style>

<template>
   <div class="wrapper">
    <!-- topbar -->
   <Navbar/>
 <!-- topbar ends -->
 
 <!-- sidebar -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <router-link to="/business/" class="brand-link"><img src="/business/public/frontend/img/logo.png" height="48" width="58"/><br><b style="color: teal; margin-left: 25px;">e -</b> হিসাব</router-link>
  <!-- Sidebar -->
  <div class="sidebar" >
    <!-- Sidebar Menu -->
    <nav class="mt-2" style="margin-top: 60px !important;">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">    
          <ul class="nav nav-treeview">          
            <li class="nav-item ">
              <router-link to="/business/" class="nav-link active"><i class="fa fa-tachometer-alt nav-icon"></i>
                <p>Dashboard</p></router-link>
            </li>     
          </ul>
        </li>


        <li class="nav-item menu-open">    
          <ul class="nav nav-treeview">          
            <li class="nav-item ">
              <router-link to="/business/add_sale" class="nav-link"><i class="fas fa-plus nav-icon"></i>
                <p>Add Sale</p></router-link>
            </li>     
          </ul>
        </li>

        <li class="nav-item menu-open">    
          <ul class="nav nav-treeview">          
            <li class="nav-item">
              <router-link to="/business/sale_report" class="nav-link"><i class="fas fa-table nav-icon"></i>
                <p>Sales Report</p></router-link>
            </li>     
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
  <!-- sidebar ends -->


  <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="col-md-12">
                <router-link to="/business/sale_report"><button class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></router-link> 
                <br>
                <br>
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">View Sales Report</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            
                <div class="card-body">            
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Selling Date</label>
                    <h3 style="color: #52f3f3;">{{moment(sale.selling_date).format('DD/MM/YYYY')}}</h3>
                  </div>
                      <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <h3 style="color: #52f3f3;">{{ sale.product_name }}</h3>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6 col-sm-6">
                    <label for="exampleInputPassword1">Price </label>
                    <h3 style="color: #52f3f3;">{{ sale.product_price }} <span style="color : white" >&#x9f3;</span></h3>
                  </div>
                  <div class="form-group col-md-6 col-sm-6">
                    <label for="exampleInputPassword1">Quantity </label>
                    <h3 style="color: #52f3f3;">{{ sale.quantity }}</h3>
                  </div>
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputPassword1">Total Selling Price </label>
                    <h3 style="color: #ffc107;" id="total_id">{{ sale.total_selling_price }} <span style="color : white" >&#x9f3;</span></h3>
                  </div>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputFile">Image of Receipt</label>
                    <br>
                    <div >
                      <img :src="'/business/public/frontend/'+logo" alt="_no receipt image" style="width: 300px; height: auto;">
                    </div>                                     
                  </div>
                  </div>
                     
                  <div class="col-md-12 col-sm-12">
                    <br>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modal-default">Edit <i class='fas fa-edit'></i></button>
                    </div>
                  </div>               
                </div>
                <!-- /.card-body -->           
            </div>
            <!-- /.card -->

            <!-- modal starts -->
          <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form @submit.prevent="update_sale()">
                <div class="card-body">
                 <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Selling Date <small style="color: red;"><b>*</b></small></label>
                    <input type="date" class="form-control" v-model="sale.selling_date">
                  </div>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Product <small style="color: red;"><b>*</b></small></label>
                    <input type="text" class="form-control"  v-model="sale.product_name" placeholder="Enter Product Name">
                  </div>
                  </div>


                  <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price <small style="color: red;"><b>*</b></small></label>
                    <input type="number" class="form-control"  v-model="sale.product_price" placeholder="Enter Product Price">
                  </div>
                 </div>

                 <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Quantity <small style="color: red;"><b>*</b></small></label>
                    <input type="number" class="form-control"  v-model="sale.quantity"  placeholder="For Example : 3">
                  </div>
                 </div>
                 </div>

                  <div class="form-group">
                <!-- <h4 id="pipi" >Total Selling Price : <b style="color: #ffc107;">{{ sale.total_selling_price }}</b></h4> -->
                <h4 id="total" >Total Selling Price : <b style="color: #ffc107;">{{ total() }}</b> <span style="color : white" >&#x9f3;</span></h4>
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputFile">Image of Receipt</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" id="img" @change="myImg">
                        <!-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> -->
                      </div>
                     
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer modal-footer ">
                  <button  type="submit" class="btn btn-info">update</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
            <!-- modal ends  -->
          </div>              
            </div>
        </div>
    </div>



  
     <!-- footer  -->
 <TemplateFooter/>
 <!-- footer ends  -->
   </div>
</template>


<script setup>
 import  Navbar from './partials/Topbar.vue';
 import  TemplateFooter from './partials/Footer.vue';
//  import  axios from "axios";
 import { onMounted, ref } from "vue";
 import moment from 'moment'
 import Swal from 'sweetalert2'

 let sale = ref({id : '' })
 let logo = ref('')
 const file = ref('')

const props = defineProps({
      id : {
          type : String,
          default : ''
      }
  })

onMounted( async()=>{
    get_sale_data()
})



const get_sale_data = () => {
    axios.get(`/business/api/show_single_sale/${props.id}`).then( response => {
    console.log('show_sale_response',response.data.sale)
    sale.value = response.data.sale;
    logo.value = response.data.sale.receipt_image;
    })  
}

const total = () => {   
     let total = sale.value.product_price*sale.value.quantity
     return total; 
}


const myImg = (event) =>{
     file.value = event.target.files[0]   
    }

const update_sale = () => {

  let total_cost = total();
 
  if(sale.value.selling_date == ''){
    // alert('Please enter selling date');
    Swal.fire({
            icon: "warning",
            title: "Please enter selling date",
          });
    return false;
  }

  if(sale.value.product_name == ''){
    // alert('Please enter product name');
    Swal.fire({
            icon: "warning",
            title: "Please enter product name",
          });
    return false;
  }

  if(sale.value.product_price == ''){
    // alert('Please enter product price');
    Swal.fire({
            icon: "warning",
            title: "Please enter product price",
          });
    return false;
  }

  if(sale.value.quantity == ''){
    // alert('Please enter product quantity');
    Swal.fire({
            icon: "warning",
            title: "Please enter product quantity",
          });
    return false;
  }
 
  const updateForm = new FormData()
  updateForm.append('sale_id',sale.value.id)
  updateForm.append('selling_date',sale.value.selling_date)
  updateForm.append('product',sale.value.product_name)
  updateForm.append('price',sale.value.product_price)
  updateForm.append('quantity',sale.value.quantity)
  updateForm.append('total',total_cost)
  updateForm.append('image',file.value)
  
  axios.post('/business/api/update_sale',updateForm).then(response => {
    // alert('Sale updated successfully!')
    Swal.fire({
            icon: "success",
            title: "Sale is updated successfully!",
            // timer: 1500
          });
    // window.location.reload();
    setTimeout(function(){ window. location. reload(); }, 800);
  })
}

</script>
