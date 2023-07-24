<?php include 'head.php';?>
<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="../images/site/fayeed.png" alt="">
                <img class="logo-compact" src="../images/site/fayeed.png" alt="">
                <h4 class="brand-title"><?php echo $branchde['city']?></h4>
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
                            <h4>Hi, welcome back!</h4>
                            <p class="mb-0"><h4><?php echo $formattedDate; ?></h4></p>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="d-inline-flex flex-wrap">
                                    <i class="bx bxs-bar-chart-square display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-text pt-3 pl-2">Performance</div>
                                </div>
                                <div class="stat-content">
                                    <!-- Add a placeholder for the Morris.js chart -->
                                    <div id="morris-line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 d-inline-flex flex-wrap">
                        <div class="col-lg-12 col-sm-6">
                            <div class="card" onclick="window.location.href='assemblylist.php'; return false;">
                                <div class="stat-widget-one card-body"><!-- change color light orange-->
                                    <i class="fi fi-rr-list display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Assembly</div>
                                        <div class="stat-digit"><?php if($Assembly['Total'] == 0){ echo "0";}else{ echo $Assembly['Total'];}?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6">
                            <div class="card">
                                <div class="stat-widget-one card-body">
                                    <i class="fi fi-rr-layers display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Inventory</div>
                                        <div class="stat-digit"><?php echo $innventory['total']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6">
                            <div class="card" onclick="window.location.href='alertproduct.php'; return false;">
                                <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-engine-warning display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Inventory Alert</div>
                                        <div class="stat-digit"><?php echo $alertprd['alert']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Latest Inventory</h4>
                                <?php if ($count < 5): ?>
                                    <p class="">Showing <strong><?php echo $count; ?></strong> Alerts</p>
                                <?php else: ?>
                                    <p class="">Showing <strong>5</strong> of <strong><?php echo $count; ?></strong> Alerts</p>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20">
                                    <thead>
                                            <tr>
                                                <th>Branch Name</th>
                                                <th>Product Code</th>
                                                <th>Inventory Name</th>
                                                <th>Inventory Quantity</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($inventorylist = mysqli_fetch_array($lllllls)){ ?>
                                                <tr>
                                                <td><?php echo $inventorylist['Branch_Name'] ?></td>
                                                <td><?php echo $inventorylist['product_code'] ?></td>
                                                <td><?php echo $inventorylist['inventoryName'] ?></td>
                                                <td><p class="bg-danger text-light text-center"><?php echo $inventorylist['inventoryQty'] ?></td>


                                            </tr>
                                            <?php }?>


                                        </tbody>
                                    </table>
                                    <a href="alertproduct.php" class="btn btn-primary">View all Inventory Alerts</a>
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
    <script src="../vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="../vendor/jqvmap/js/jquery.vmap.usa.js"></script>

    <script>
        var dataCombined = <?php echo $jsonDataCombined; ?>;
        console.log(dataCombined);
        dataCombined.forEach(function(point) {
            var monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            var monthNumber = parseInt(point.month); // Ensure the month number is an integer
            point.month = monthNames[monthNumber - 1];
        });

        Morris.Line({
            element: 'morris-line-chart',
            data: dataCombined,
            xLabelFormat: function (x) {
                var year = x.getFullYear();
                var month = x.getMonth() + 1; // Months are zero-based, so add 1.
                return month + '/' + year;
            },
            xkey: 'month',
            ykeys: ['finished_assemblies', 'absences'],
            labels: ['Finished Assemblies', 'Absences'],
            lineColors: ['#D97604', '#0E0E0E'],
            continuousLine: false,
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['#242423'], 
        });
    </script>

</body>
</html>