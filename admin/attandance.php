<?php include 'head.php';
$currentDateTimetrasaction = date('g:i a');
$xdatetime = DateTime::createFromFormat('g:i a', $currentDateTimetrasaction);
$formattedTime = $xdatetime->format('H:i');?>
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
        <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
        <?php include 'header.php'; include 'sidebar.php'?>

     <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Attendance : <?php echo $formattedDate; ?> </h4>  <?php if($formattedTime > '19:00'){ ?> <a href="attandance.php?setzero=true" class="btn btn-primary">Set All 0 to Absent</a> <?php }?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table id="example" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Staff Name</th>
                                                <th>Branch Name</th>
                                                <th>Morning In</th>
                                                <th>Morning Out</th>
                                                <th>Afternoon In</th>
                                                <th>Afternoon Out</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($attendance = mysqli_fetch_array($ckatt)){ ?>
                                                <tr>
                                                    <td></td>
                                                    <td><?php echo $attendance['usersFirstName']." ".$attendance['usersLastName '] ?></td>
                                                    <td><?php echo $attendance['Branch_Name'] ?></td>
                                                    <td><?php echo $attendance['morning_in'] ?></td>
                                                    <td><?php echo $attendance['morning_out'] ?></td>
                                                    <td><?php echo $attendance['afternoon_in'] ?></td>
                                                    <td><?php echo $attendance['afternoon_out'] ?></td>
                                                    <td><?php if($attendance['confirm'] == 1){ echo 'Validated';}else{ echo 'not validated';} ?></td>
                                                    <td>
                                                        <a href="target-attendance.php?check_attendance=<?php echo $attendance['attendanceID'] ?>" class="btn btn-primary">Check Attendance</a>
                                                    </td>

                                            </tr>
                                            <?php }?>


                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

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
    <script src="../vendor/gaugeJS/dist/gauge.min.js"></script>
    <script src="../vendor/flot/jquery.flot.js"></script>
    <script src="../vendor/flot/jquery.flot.resize.js"></script>
    <script src="../vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="../vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="../vendor/datatables/js/jquery-3.7.0.js"></script>
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/js/dataTables.responsive.min.js"></script>
    <script src="../js/plugins-init/datatables-api-init.js"></script>
    <script src="../js/plugins-init/datatables.init.js"></script>
</body>
</html>