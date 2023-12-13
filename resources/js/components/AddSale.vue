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
                <h3 class="card-title">Add New Sale</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form @submit.prevent="add_sale">
                <div class="card-body">
                 <!-- <input v-model="form.user.name"> -->

                 <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Selling Date <small style="color: red;"><b>*</b></small></label>
                    <input type="date" class="form-control" v-model="form.selling_date" >
                  </div>
                  </div>

                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Product <small style="color: red;"><b>*</b></small></label>
                    <input type="text" class="form-control" v-model="form.product"  placeholder="Enter Product Name">
                  </div>
                  </div>


                  <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Price <small style="color: red;"><b>*</b></small></label>
                    <input type="number" class="form-control" v-model="form.price" placeholder="Enter Product Price">
                  </div>
                 </div>

                 <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Quantity <small style="color: red;"><b>*</b></small></label>
                    <input type="number" class="form-control" v-model="form.quantity" placeholder="For Example : 3">
                  </div>
                 </div>


                 </div>


                

                
                  
                 
                 
                  <div class="form-group">
                    <h4>Selling Price : <b style="color: #ffc107;">{{ total() }}</b> <span style="color : white" >&#x9f3;</span></h4>
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

                <div class="card-footer">
                  <button v-if="user.id && user.status == 1" type="submit" class="btn btn-success float-right">Add</button>
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
import  Navbar from './partials/Topbar.vue';
import  TemplateSidebar from './partials/TemplateSidebar.vue';
import  TemplateFooter from './partials/Footer.vue';
import  store from '../store/index.js';
import  router from '../router/index.js'
// import  axios from 'axios'
import Swal from 'sweetalert2'

// $(document).ready(function () {

//   $('.sidebar-mini').removeClass('sidebar-open');

//      $('.nav-item').click(function () {
//       $('.sidebar-mini').removeClass('sidebar-open');
//       $('.sidebar-mini').addClass(' pippip sidebar-closed sidebar-collapse');    
//     });
//   });



export default {
  name : 'add_sale',
  components : {Navbar, TemplateSidebar, TemplateFooter},
  computed : {
        user() {
            return store.getters.getUser;
        }
    },

  data(){
    return {
      form : {
        selling_date : '',
        product : '',
        price : '',
        quantity : '',
        total_price : ''      
      },

      file : null

    }
  },

  methods : { 
    total(){ 
     let total = this.form.price*this.form.quantity
     return total; 
    },

    myImg(event){
      this.file = event.target.files[0] 
      console.log(this.file.name)
      //return this.file.name
    },

    add_sale(){ 


      if(this.form.selling_date == ''){
          Swal.fire({
            icon: "warning",
            title: "Please Enter Selling Date",
          });
          return false;
      }

      if(this.form.product == ''){
          Swal.fire({
            icon: "warning",
            title: "Please Enter product name",
          });
          return false;
      }

      if(this.form.price == ''){
          Swal.fire({
            icon: "warning",
            title: "Please Enter product price",
          });
          return false;
      }

      if(this.form.quantity == ''){
          Swal.fire({
            icon: "warning",
            title: "Please Enter quantity",
          });
          return false;
      }

    let total_cost = this.total();
    let ss = this.file
    
    if(ss != null){
    const myForm = new FormData()
    myForm.append('selling_date',this.form.selling_date)
    myForm.append('product',this.form.product)
    myForm.append('price',this.form.price)
    myForm.append('quantity',this.form.quantity) 
    myForm.append('total',total_cost)
    myForm.append('image',this.file, this.file.name)
    axios.post('/business/api/save_sale',myForm).then(response => {
    // alert('Product added successfully!')
    Swal.fire({
            icon: "success",
            title: "Sale is added successfully!",
            // timer: 1500
          });
    // window.location.reload();
    setTimeout(function(){ window. location. reload(); }, 800);
    // console.log('my_response',response)
    })
  
    }else{
    const myForm = new FormData()
    myForm.append('selling_date',this.form.selling_date)
    myForm.append('product',this.form.product)
    myForm.append('price',this.form.price)
    myForm.append('quantity',this.form.quantity)
    myForm.append('image',null)
    myForm.append('total',total_cost)
    axios.post('/business/api/save_sale',myForm).then(response => {
      // alert('Product added successfully!')
      Swal.fire({
            icon: "success",
            title: "Sale is added successfully!",
            // timer: 1500
          });
      // window.location.reload();
      setTimeout(function(){ window. location. reload(); }, 800);
    // console.log('my_response',response)
    })

    }
  
    } 
    
  },
  mounted(){
        }
}
</script>