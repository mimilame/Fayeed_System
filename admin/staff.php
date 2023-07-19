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
        <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
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
                                <h4>Companies List of Staff</h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
                                                <th>Branch</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($administratorss = mysqli_fetch_array($staf)){ ?>
                                                <tr>
                                                <td><?php if($administratorss['usersFirstName']==""){ echo ".........";}else{echo $administratorss['usersFirstName'];}?></td>
                                                <td><?php if($administratorss['usersLastName']==""){ echo ".........";}else{echo $administratorss['usersLastName'];}?></td>
                                                <td><?php if($administratorss['Address']==""){ echo ".........";}else{echo $administratorss['Address'];}?></td>
                                                <td><?php if($administratorss['email']==""){ echo ".........";}else{echo $administratorss['email'];}?></td>
                                                <td><?php if($administratorss['CellNumber']==""){ echo ".........";}else{echo $administratorss['CellNumber'];}?></td>
                                                <td><?php if($administratorss['Branch_Name']==""){ echo ".........";}else{ ?> <a href="detail-branch.php?branch=<?php echo $administratorss['branchID']?>"><?php echo $administratorss['Branch_Name']?></a><?php } ?></td>
                                                <td><a href="check-profile.php?profile=<?php echo $administratorss['usersID']?>"><i class="fi fi-rr-user btn btn-primary"></i></a> <a href="staff.php?disrole=<?php echo $administratorss['staffID']?>"><i class="fi fi-rr-replace btn btn-secondary"></i></a></td>
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
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../js/plugins-init/datatables.init.js"></script>
</body>
</html>