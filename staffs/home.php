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
                                    <p class="">Showing <strong>5</strong> of <strong><?php echo $clisttrans; ?></strong> Alerts</p>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script>
        // Decode the JSON data to use in JavaScript
        var data = <?php echo $jsonDataCombined; ?>;

        Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'morris-line-chart',
            // Chart data records for both data series ("Finished Assemblies" and "Absences").
            data: data,
            // The name of the data record attribute that contains x-values.
            xkey: 'year',
            // A list of names of data record attributes that contain y-values for both data series.
            ykeys: ['finished_assemblies', 'absences'],
            // Labels for the ykeys -- will be displayed when you hover over the chart for both data series.
            labels: ['Finished Assemblies', 'Absences'],
            // Line colors for both data series.
            lineColors: ['#ff6a00', '#00cc99'],
        });


    </script>

</body>
</html>