<script src='../../dist/js/addanimal.js'></script>
<script src='../../dist/js/getanimals.js'></script>
<aside class="main-sidebar elevation-4 sidebar-light-orange">
    <!-- SecondHome logo + Name -->
    <a href="index.php" class="brand-link navbar-orange">
        <img src="dist/img/logooo.png" alt="SecondHome Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><b>S</b>econd<b>H</b>ome</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
        
        <!-- Sidebar User Panel -->
        <!-- Afisare utlilizator/Autentificare in functie de user conectat/guest-->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <?php if (isset($_SESSION['userId'])): ?>
            <div class="image">
                <img src="<?php echo $_SESSION['userImg']?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="detalii_user.php" class="d-block" id='user_name'><?php echo $_SESSION['FirstName']." ".$_SESSION['LastName'];?></a>
            </div>
        <?php else: ?>
            <div class="image">
                <img src="login2.png" class="img-circle" alt="Autentificare" style="opacity: .75">
            </div>
            <div class="info">
                <a href="login.php" class="d-block">Autentificare</a>
            </div>
        <?php endif; ?>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">

            <!--
                <li class="nav-item has-treeview"> 
                    <a href="pages/animale.html"   class="nav-link" >
                        <i class="nav-icon fas fa-paw"></i>
                        <p>
                            Vezi animalele
                        </p>
                    </a>
                </li>
            -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon	fas fa-paw"></i>
                        <p>
                            Animăluțele noastre
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="animale.php" class="nav-link">
                                <i class="nav-icon fas fa-paw-alt"></i>
                                <p>Toate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pisici.php" class="nav-link">
                                <i class="nav-icon fas fa-cat"></i>
                                <p>Pisici</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="caini.php" class="nav-link">
                                <i class="nav-icon fas fa-dog"></i>
                                <p>Câini</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="rozatoare.php" class="nav-link">
                                <i class="nav-icon fas fa-rabbit"></i>
                                <p>Rozătoare</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="reptile.php" class="nav-link">
                                <i class="nav-icon fas fa-snake"></i>
                                <p>Reptile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pasari.php" class="nav-link">
                                <i class="nav-icon fas fa-crow"></i>
                                <p>Păsări
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="acvatice.php" class="nav-link">
                                <i class="nav-icon fas fa-fish"></i>
                                <p>Acvatice
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

               
                
                <!--Meniu utilizator -->
                <?php if (isset($_SESSION['userId']) && $_SESSION['userType']==0): ?>
                    <li class="nav-item">
                        <a href="animalele_mele.php" class="nav-link">
                            <i class="nav-icon	fas fa-paw"></i>
                            <p>
                                Animalele mele
                                <!-- <i class="fas fa-angle-left right"></i> -->
                                <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="animale_adoptate.php" class="nav-link">
                            <i class="nav-icon	fas fa-paw"></i>
                            <p>
                                Animale adoptate
                                <!-- <i class="fas fa-angle-left right"></i> -->
                                <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="formular_add.php" class="nav-link">
                            <i class="nav-icon	fas fa-paw"></i>
                            <p>
                                Formular 
                                <!-- <i class="fas fa-angle-left right"></i> -->
                                <!-- <span class="badge badge-info right">6</span> -->
                            </p>
                        </a>
                    </li>
                <?php endif; ?>

                

                <!--Meniu angajat -->
                <?php if (isset($_SESSION['userId']) && $_SESSION['userType']>=1): ?>
                
                <?  include "server/php/connection.php";
                    $sql1 = "SELECT COUNT(RID) nr FROM Requests JOIN Pets USING(PID) WHERE request_type = 0 AND request_state = 0";
                    $sql2 = "SELECT COUNT(RID) nr FROM Requests JOIN Pets USING(PID) WHERE request_type = 1 AND request_state = 0";
                    $sql3 = "SELECT COUNT(RID) nr FROM Requests JOIN Pets USING(PID) WHERE request_type = 2 AND request_state = 0";

                    if(!$result1 = mysqli_query($conn,$sql1))
                    {
                        $response["status"]=-1;  //Database error
                        error_log("SQL ERROR: ".mysqli_error($conn));   //Error logging
                        echo json_encode($response);
                        return;
                    }
                    $nr_a = mysqli_fetch_assoc($result1)['nr'];
                    if(!$result2 = mysqli_query($conn,$sql2))
                    {
                        $response["status"]=-1;  //Database error
                        error_log("SQL ERROR: ".mysqli_error($conn));   //Error logging
                        echo json_encode($response);
                        return;
                    }
                    $nr_c = mysqli_fetch_assoc($result2)['nr'];
                  
                    if(!$result3 = mysqli_query($conn,$sql3))
                    {
                        $response["status"]=-1;  //Database error
                        error_log("SQL ERROR: ".mysqli_error($conn));   //Error logging
                        echo json_encode($response);
                        return;
                    }
                    $nr_ad = mysqli_fetch_assoc($result3)['nr'];
                    
                    ?>
                    <li class="nav-item">
                        <a href="admin_adoptie.php" class="nav-link">
                            <i class="nav-icon	fas fa-paw"></i>
                            <p>
                                Cereri animale   
                                <span class="badge badge-success right"><? echo $nr_a; ?></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin_cazare.php" class="nav-link">
                            <i class="nav-icon	fas fa-paw"></i>
                            <p>
                                Cereri cazare
                                <span class="badge badge-success right"><? echo $nr_c; ?></span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin_adoptie_user.php" class="nav-link">
                            <i class="nav-icon	fas fa-paw"></i>
                            <p>
                                Cereri adopție
                                <span class="badge badge-success right"><? echo $nr_ad; ?></span>
                            </p>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="contact.php" class="nav-link">
                    <i class="nav-icon fa fa-phone"></i>
                        <p>
                            Contact
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="location.php" class="nav-link">
                         <i class=" nav-icon fas fa-map-marker-alt"></i>
                        <p>
                            Locatiile noastre
                        </p>
                    </a>
                </li>

                
                <?php if (isset($_SESSION['userId'])): ?>
                    <!-- Deconectare, apare doar cand userul e conectat -->
                    <li class="nav-item">
                        <a href="deconectare.php" class="nav-link">
                            <i class="nav-icon fal fa-sign-out-alt"></i>
                            <p>Deconectare</p>
                        </a>
                    </li>
                    <!-- Final deconectare -->
                <?php endif; ?>
            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>