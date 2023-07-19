<?php include 'head.php'?>
<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="../images/site/fayeed.png" alt="">
                <img class="logo-compact" src="../images/site/fayeed.png" alt="">
                <h4 class="brand-title"><?php echo $settings['System_Name']?></h4>
                <link href="../vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="../vendor/chartist/css/chartist.min.css" rel="stylesheet">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <?php include 'header.php'; include 'sidebar.php'?>

     <!--**********************************
            Content body start
        ***********************************-->

        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Inventory Overview Dashboard</h4>

                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="inventorylist.php" class="btn btn-secondary text-light">View by List</a></li>
                            <li class="breadcrumb-item"><a href="inventory.php" class="btn btn-secondary text-light">View by Cards</a></li>
                            <li class="breadcrumb-item"><a href="add-inventory.php" class="btn btn-secondary text-light">Add inventory</a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <?php while($overview = mysqli_fetch_array($cardin)){ ?>

                        <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                            <i class="fi fi-rr-layout-fluid display-5"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text"><a href="branchinventory.php?branch=<?php echo $overview['branchID']?>"><?php echo $overview['Branch_Name']?></a></div>
                                    <div class="stat-digit"><?php echo $overview['number']?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php }?>


                </div>

            </div>
        </div>

        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    <script src="../vendor/global/global.min.js"></script>
    <script src="../js/quixnav-init.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morris/morris.min.js"></script>
    <script src="../vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="../vendor/gaugeJS/dist/gauge.min.js"></script>
    <script src="../vendor/flot/jquery.flot.js"></script>
    <script src="../vendor/flot/jquery.flot.resize.js"></script>
    <script src="../vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="../vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="../vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="../vendor/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="../js/dashboard/dashboard-1.js"></script>
    <script src="../vendor/global/global.min.js"></script>
    <script src="../js/quixnav-init.js"></script>
    <script src="../js/custom.min.js"></script>

    <script src="../vendor/chartist/js/chartist.min.js"></script>

    <script src="../vendor/moment/moment.min.js"></script>
    <script src="../vendor/pg-calendar/js/pignose.calendar.min.js"></script>


    <script src="../js/dashboard/dashboard-2.js"></script>
</body>
</html>