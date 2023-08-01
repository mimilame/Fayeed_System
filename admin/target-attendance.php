<?php include 'head.php'?>
<body>
<?php
if (isset($_GET['val_photo']) && $_GET['val_photo'] == '1' && isset($_SESSION['val_photo'])) {
    echo <<<EOL
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Validated Attendance!',
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-end',
                timer: 5000
            }).then(() => {
                // Get the attendanceID from the URL using URLSearchParams
                const urlParams = new URLSearchParams(window.location.search);
                const attenID = urlParams.get('check_attendance');
                window.location.href = 'target-attendance.php?check_attendance=' + encodeURIComponent(attenID);
            });
        </script>
    EOL;
    unset($_SESSION['val_photo']);
}
?>
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

        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Attendance Check : <?php echo $formattedDate; ?></h4> <a href="attandance.php" class="btn btn-primary">Back</a>
                            </div>
                            <div class="card-body"><?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                                <div class="basic-form">
                                <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-4">

                                        <img  src="../images/attendance/<?php echo $attendance['enrtypic']?>" alt="" width="300px" height="250px"><br>

                                    </div>
                                    <div class="form-group col-md-8">
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>Name</label>
                                                <input class="form-control" value="<?php echo $attendance['usersFirstName']." ".$attendance['usersLastName']?>" readonly>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Branch Name</label>
                                                <input class="form-control" value="<?php echo $attendance['Branch_Name']?>" readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Morning in </label>
                                                <input  class="form-control" value="<?php echo $attendance['morning_in']?>" readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Morning out</label>
                                                <input class="form-control" value="<?php echo $attendance['morning_out']?>" readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Afternoon in</label>
                                                <input class="form-control" value="<?php echo $attendance['afternoon_in']?>" readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>Afternoon Out</label>
                                                <input  class="form-control" value="<?php echo $attendance['afternoon_out']?>" readonly>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Actions</label><br>
                                                <?php if( $attendance['enrtypic'] == 'face.gif'){ ?> <a class="btn btn-warning">The Attendance has not valid photo , can't make any actions, please try again later</a> <?php }else{ ?> <?php if($attendance['confirm'] == 1){ ?> <a href="target-attendance.php?validate_attendance=<?php echo $attendance['attendanceID']?>" class="btn btn-<?php if($attendance['confirm'] == 1){ echo "success";} ?>">Attendance Validated</a> <?php ;}else{ ?> <a href="target-attendance.php?validate_attendance=<?php echo $attendance['attendanceID']?>" class="btn btn-primary">Not Validated</a> <?php ;}?> <?php }?>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

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