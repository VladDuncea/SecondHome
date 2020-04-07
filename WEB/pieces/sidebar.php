<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- SecondHome logo + Name -->
    <a href="index.php" class="brand-link">
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
                <a href="utilizator.php" class="d-block"><?php echo $_SESSION['FirstName']." ".$_SESSION['LastName'];?> </a>
            </div>
        <?php else: ?>
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
                    <a href="animale.html" class="nav-link">
                        <i class="nav-icon	fas fa-paw"></i>
                        <p>
                            Animalutele noastre
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-info right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="animale.php" class="nav-link">
                                <i class="nav-icon fas fa-cat"></i>
                                <p>Toate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="categ_pisici.php" class="nav-link">
                                <i class="nav-icon fas fa-cat"></i>
                                <p>Pisici</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                <i class="nav-icon fas fa-dog"></i>
                                <p>Câini</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/boxed.html" class="nav-link">
                                <i class="nav-icon fas fa-rabbit"></i>
                                <p>Rozătoare</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="nav-icon fas fa-snake"></i>
                                <p>Reptile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="nav-icon fas fa-crow"></i>
                                <p>Păsări
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                <i class="nav-icon fas fa-fish"></i>
                                <p>Pești
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Deconectare, apare doar cand userul e conectat -->
                <?php if (isset($_SESSION['userId'])): ?>
                <li class="nav-item">
                    <a href="deconectare.php" class="nav-link">
                        <i class="nav-icon fal fa-sign-out-alt"></i>
                        <p>Deconectare</p>
                    </a>
                </li>
                <?php endif; ?>
                <!-- Final deconectare -->

            </ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>