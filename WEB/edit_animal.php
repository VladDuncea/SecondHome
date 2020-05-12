<!DOCTYPE html>
<html>

<head>
    <?php include 'pieces/head.php';
    // //Redirect unauthorized access
    // if(!isset($_SESSION['userType']))
    // {
    //     echo"<script>window.location = 'unauth_access.php';</script>";
    //     return;
    // } ?>
     <link rel="stylesheet" href="plugins/cropper/cropper.css">
     <style>
    .container
    {
        max-width:500px;
    }
    #blah_edit {
        width: 100%;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini" onload="edit_animal();">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'pieces/navbar.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'pieces/sidebar.php' ?>
        <!--/main sidebar-->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><i class="nav-icon fas fa-paw"></i> Editare informatii animal</h1>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section >
             <!-- Main content -->
             <section class="content">
                <form role="form" class="edit_animal_form" id="continut_form" novalidate="novalidate">
            
                    

                </form>
            </section>
            <!-- /.content -->
       </div>
        <!-- /.content-wrapper -->
      

        <!-- Footer-->
        <?php include 'pieces/footer.php' ?>
        <!-- /footer -->
        
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!--Toasts-->
    <script src="plugins/toastr/toastr.min.js"></script>
    <!--Toasts-->
    <script src="plugins/cropper/cropper.js"></script>
    <!--CUSTOM-->
    <script src='dist/js/utils_animal.js'></script>
    <script src='dist/js/getanimals.js'></script>
  
</body>

</html>