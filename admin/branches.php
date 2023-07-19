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
                <div class="row page-titles mx-0">
                   
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Store Branch</h4> <a class="btn btn-primary" href="add-branches.php"><i class="fi fi-rr-add"></i> Add Branch</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Branch Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($branch = mysqli_fetch_array($brc)){ ?>
                                                <tr>
                                                <td><?php echo $branch['Branch_Name'] ?></td>
                                                <td><?php echo $branch['Branch_Address'] ?></td>
                                                <td><?php echo $branch['city'] ?></td>
                                                <td><?php echo $branch['branch_email'] ?></td>
                                                <td><?php echo $branch['Branch_Contact_number'] ?></td>
                                                <td>
                                                <a class="btn btn-primary" href="assign-branch.php?branch=<?php echo $branch['branchID']?>"><i class="fi fi-rr-users-alt"></i></a>
                                                <a class="btn btn-primary" href="detail-branch.php?branch=<?php echo $branch['branchID']?>"><i class="fi fi-rr-info"></i></a>
                                                <a class="btn btn-success" href="add-branches.php?branch=<?php echo $branch['branchID']?>"><i class="fi fi-rr-pen-square"></i></a>
                                                <a class="btn btn-danger" href="check-profile.php?delete=<?php echo $branch['branchID']?>"><i class="fi fi-rr-trash-list"></i></a></td>
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
    <script>
        $('.js-data-example-ajax').select2({
  ajax: {
    url: 'https://api.github.com/search/repositories',
    dataType: 'json'
    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
  }
});
    </script>
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