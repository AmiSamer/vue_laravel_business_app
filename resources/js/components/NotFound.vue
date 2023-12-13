<template>
    
    <div class="wrapper">
        <!-- topbar -->
        <Navbar/>
        <!-- topbar ends -->

        <!-- sidebar -->
        <TemplateSidebar/>
        <!-- sidebar ends -->

        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>
        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h3>
          <br>
          <router-link to="/business/dashboard" style="margin-left: 100px;"><button class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></router-link>
        </div>

        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
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
    components : {
        Navbar, TemplateSidebar, TemplateFooter
    }
}
</script>