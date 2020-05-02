<!DOCTYPE html>
<html>

<head>
    <?php include 'pieces/head.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed" onload="homepage();">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'pieces/navbar.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'pieces/sidebar.php' ?>
        <!--/main sidebar-->

        <!-- Content Wrapper -->
        <div class="content-wrapper" >
             <div class ='row' >
                <div class="col-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title">Carousel</h3>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="7"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="8"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="9"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="10"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="11"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="12"></li>

                                <!-- <li data-target="#carouselExampleIndicators" data-slide-to="7"></li> -->
                            </ol>
                            <div class="carousel-inner">

                                <div class="carousel-item active">
                                <img class="d-block w-100" src="image/4.jpg" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/8.jpg" alt="Third slide">
                                </div>
                                <div class="carousel-item ">
                                <img class="d-block w-100" src="image/animal6.png" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/9.jpg" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/1.jpg" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/2.jpg "alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/3.jpg" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/5.jpg" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/animal5.png" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/7.jpg" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/6.jpg" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/10.jpg" alt="Third slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="image/animal7.png" alt="Third slide">
                                </div>
                                
                               
                            </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
               
            </div>
            <div class ='row' style="padding: 20px">
                <!-- DONUT CHART -->
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"><i class="nav-icon fas fa-paw"></i> Animale înregistrate</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart1" ></canvas>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <!-- DONUT CHART -->
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title"><i class="nav-icon fas fa-paw"></i> Animale care și-au găsit o casă</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart2" ></canvas>
                        </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>



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
    <!-- <style>
    .content-wrapper{
        background: url("image_animal.png");
        background-size: auto;
        }
    </style>  -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <script src="dist/js/utils.js"></script>
    <script src="../../plugins/chart.js/Chart.min.js"></script>
</body>

</html>
