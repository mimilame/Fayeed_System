<?php include 'head.php'?>
<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="../images/site/fayeed.png" alt="">
                <img class="logo-compact" src="../images/site/fayeed.png" alt="">
                <h4 class="brand-title"><?php echo $settings['System_Name']?></h4>
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
                <div class="row">
                    <?php while( $dtr = mysqli_fetch_array($attengg)){ ?>

                        <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                            <div class="card text-white bg-secondary">
                                <div class="card-header">
                                    <h5 class="card-title text-white">Daily Time Record Profile</h5>
                                </div>
                                <div class="card-body mb-0">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <p class="card-text">
                                                <strong>Email:</strong> <a class="text-light font-weight-bold" href="mailto:<?php echo $dtr['email']?>"><?php echo $dtr['email']?></a><br>
                                                <strong>Contact:</strong> <a class="text-light font-weight-bold" href="tel:<?php echo $dtr['CellNumber']?>"><?php echo $dtr['CellNumber']?></a><br>
                                                <strong>Branch:</strong> <?php echo $dtr['Branch_Name']?>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <?php if($dtrpic = mysqli_fetch_array($ckatt)) { ?>
                                                <img src="../images/attendance/<?php echo $dtrpic['enrtypic'] ?>" alt="Attendance Image" class="img-fluid img-thumbnail rounded float-md-right w-75 h-25 pb-2">
                                            <?php } else { ?>
                                                <img src="../images/attendance/default-image.png" alt="Default Image" class="img-fluid rounded float-md-right w-75 h-25 pb-2">
                                            <?php } ?>
                                            <a href="dtr-target.php?dtr=<?php echo $dtr['usersID']?>" class="btn btn-dark btn-card float-md-right">
                                                <h5 class="font-weight-bold mb-0">Name:</h5> <?php echo $dtr['usersFirstName']." ".$dtr['usersLastName']?>
                                            </a>
                                        </div>
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
</body>
</html>