<!DOCTYPE html>
<html>

<head>
    <?php include 'pieces/head.php';
    //Redirect unauthorized access
    if(!isset($_SESSION['userType']))
    {
        echo"<script>window.location = 'unauth_access.php';</script>";
        return;
    } ?>
    <link rel="stylesheet" href="plugins/cropper/cropper.css">
    <style>
    .container
    {
        max-width:500px;
    }
    #blah {
        width: 100%;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">
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
                            <h1><i class="nav-icon fas fa-paw"></i> Formular</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Acasă</a></li>
                                <li class="breadcrumb-item active"><i class="nav-icon fas fa-paw"></i> Formular </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            
            <!-- Main content -->
            <section class="content">
                <form role="form" id="addanimal_form" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="nav-icon fas fa-paw"></i> Adăugare animăluț</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName"> Nume animăluț</label>
                                        <input type="text" id="inputName" name="animal_name" class="form-control" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputStatus">Categorie</label>
                                        <select class="form-control custom-select" name="animal_type" id="inputCategorie" required="required">
                                        <option selected disabled>Selectați categoria</option>
                                        <option value=1>Pisici</option>
                                        <option value=2>Câini</option>
                                        <option value=3>Rozătoare</option>
                                        <option value=4>Reptile</option>
                                        <option value=5>Păsări</option>
                                        <option value=6>Acvatice</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputVarsta">Vârstă</label>
                                        <input type="number" name="animal_age" class="form-control" id="inputVarsta">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputRasa">Rasă</label>
                                        <input type="text" class="form-control" name="animal_breed" id="inputRasa" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription"> Descriere animăluț</label>
                                        <textarea id="inputDescription" name="animal_description" class="form-control" rows="4" required="required"></textarea>
                                    </div>
                
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="nav-icon fas fa-paw"></i> Poza</h3>
                                </div>

                                <div class="card-body">
                                    <div class="form-group" style="margin: 0">
                                        <button type="button" class="btn btn-success" style="margin: 5px" onclick="document.getElementById('getFile').click()"><i class="nav-icon fas fa-paw"></i> Încarcă o imagine</button>
                                        <input type='file' id="getFile" name="animal_image" style="visibility:hidden;" onchange="readURL(this);"/><br>
                                        <!-- <input type='file' onchange="readURL(this);" > -->
                                        <div id="cropper_container" class="container">
                                            <img id="blah" src="#" style="display:none" alt="Imagine încărcată" class="cropper-hidden"/>
                                        </div>
                                        
                                    </div>
                                    <!-- ------------------------------------------------- -->
                                    <!-- <div class="container">
                                        <form method="post" action="" enctype="multipart/form-data" id="myform">
                                            <div class='preview'>
                                                <img src="" id="img" width="100" height="100">
                                            </div>
                                            <div >
                                                <input type="file" id="file" name="file" />
                                                <input type="button" class="button" value="Upload" id="but_upload">
                                            </div>
                                        </form>
                                    </div> -->

                                    <!-- ---------------------------------------------------- -->

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a href="index.php" class="btn btn-secondary"><i class="nav-icon fas fa-paw"></i> Anulare</a>
                            
                            <button type="submit" value="Adăugare animăluț" class="btn btn-success float-right"><i class="nav-icon fas fa-paw"></i> Adăugare animăluț</button>
                            <!-- <button type="submit" onchange="add_animal();" value="Submit">Adăugare animăluț</button> -->
                        </div>
                    </div>
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
    <script src='dist/js/addanimal.js'></script>
  
</body>

</html>