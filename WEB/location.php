<!DOCTYPE html>
<html>

<head>
    <?php include 'pieces/head.php' ?>
</head>

<body class="hold-transition sidebar-mini" >
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
                            <h1>
                            <i class="nav-icon fas fa-paw"></i> Locatiile noastre
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Acasă</a></li>
                                <li class="breadcrumb-item active"><i class="nav-icon fas fa-paw"></i> Locatiile noastre</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
            <div class="row">
               <div class="col-md-4">
                        <div class="card-body" style="background-color: white"> 
                            <div style="margin-bottom: 10px"><div id="googleMap1" style="width:100%;height:400px;"></div> </div>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="text-muted text-sm-12"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Adresa: Bucuresti</li>
                                <li class="text-muted text-sm-12"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefon: 0274362537</li>
                            </ul>   
                        </div>
                 </div>

                 <div class="col-md-4">
                        <div class="card-body" style="background-color: white"> 
                        <div style="margin-bottom: 10px"><div id="googleMap2" style="width:100%;height:400px;"></div> </div>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="text-muted text-sm-12"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Adresa: Bucuresti</li>
                                <li class="text-muted text-sm-12"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefon: 0246856937</li>
                            </ul>   
                        </div>
                 </div>

                 <div class="col-md-4">
                        <div class="card-body"   style="background-color: white"> 
                        <div style="margin-bottom: 10px"> <div id="googleMap3" style="width:100%;height:400px; margin-bottom: 2px"></div> </div>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="text-muted text-sm-12"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Adresa: Bucuresti</li>
                                <li class="text-muted text-sm-12"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefon: 0246853726</li>
                            </ul>   
                         </div>
                 </div>
               </div> 
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
    <script>
        function myMap() {
            var myLatLng1 = {lat: 44.439663, lng: 26.096306};

            var map1 = new google.maps.Map(document.getElementById("googleMap1"), {
            center:myLatLng1,
            zoom:17,
            })
            var marker = new google.maps.Marker({
            position: myLatLng1,
            map: map1,
            title: 'Second Home'
            });
        
            var myLatLng2 = {lat: 44.4396, lng: 26.196306};

            var map2 = new google.maps.Map(document.getElementById("googleMap2"), {
            center:myLatLng2,
            zoom:17,
            })
            var marker = new google.maps.Marker({
            position: myLatLng2,
            map: map2,
            title: 'Second Home'
            });

            var myLatLng3 = {lat: 44.4316, lng: 26.196306};

            var map3 = new google.maps.Map(document.getElementById("googleMap3"), {
            center:myLatLng3,
            zoom:17,
            })
            var marker = new google.maps.Marker({
            position: myLatLng3,
            map: map3,
            title: 'Second Home'
            });
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBGabViU3Y4MWiD6U7APxaO3KyBH4QlpY&callback=myMap"></script>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../dist/js/getanimals.js"></script>
    
    
</body>

</html>