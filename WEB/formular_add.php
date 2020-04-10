<!DOCTYPE html>
<html>

<head>
    <?php include 'pieces/head.php' ?>
    
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
                            <h1>Formular</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Acasă</a></li>
                                <li class="breadcrumb-item active">Formular </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
                        <!-- Main content -->
                <section class="content">
                <div class="row">
                    <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Adăugare animăluț</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">Nume animăluț</label>
                            <input type="text" id="inputName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Categorie</label>
                            <select class="form-control custom-select" id="inputCategorie">
                            <option selected disabled>Selectați categoria</option>
                            <option>Pisici</option>
                            <option>Câini</option>
                            <option>Rozătoare</option>
                            <option>Reptile</option>
                            <option>Păsări</option>
                            <option>Acvatice</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputVarsta">Vârstă</label>
                            <input type="number" class="form-control" id="inputVarsta">
                        </div>
                        <div >
                            <label for="inputRasa">Rasă</label>
                            <input type="text" class="form-control" id="inputRasa">
                        </div>
                        <div class="form-group">
                            <label for="inputDescription">Descriere animăluț</label>
                            <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                        </div>
                
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    </div>
                    <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Poza</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>

              </div>
            </div>
            <div class="card-body">
            <button class="btn btn-secondary" onclick="document.getElementById('getFile').click()">Încarcă o imagine</button>
            <input type='file' id="getFile" style="display:none" onchange="readURL(this);"/>
             <!-- <input type='file' onchange="readURL(this);" > -->
             <img id="blah" src="#" alt="Imagine încărcată" />
            
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a href="index.php" class="btn btn-secondary">Anulare</a>
                        
                        <input type="submit" onclick="add_animal();" value="Adăugare animăluț" class="btn btn-success float-right"/>
                        <!-- <button type="submit" onchange="add_animal();" value="Submit">Adăugare animăluț</button> -->
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

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script src='../../dist/js/addanimal.js'></script>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(160);
                };

            reader.readAsDataURL(input.files[0]);
        }
        }
    </script>
</body>

</html>