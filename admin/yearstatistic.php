<?php include 'head.php';
$tranv = mysqli_query($con,"SELECT checkout.Transaction_code , inventory.inventoryName ,checkout.quantity ,branches.Branch_Name ,checkout.amount_payment ,checkout.mop ,checkout.date ,checkout.time from checkout join inventory on inventory.inventoryId = checkout.inventoryId join branches on branches.branchID = checkout.branchID ORDER BY checkout.checkoutID DESC LIMIT 10");?>
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
        <?php include 'header.php'; include 'sidebar.php';
        $sql = "SELECT year, sum(amount_payment) Total from checkout GROUP BY year;";
        $result = $con->query($sql);
        $months = [];
        $totals = [];
        while ($row = $result->fetch_assoc()) {
            $months[] = $row["year"];
            $totals[] = $row["Total"];
        }
        $con->close();?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Custom CSS styling */
        #chartContainer {
            position: relative;
            width: 100%;
            height: 100%;
        }

        canvas {
            position: relative;
            width: 100% !important;
            height: 100% !important;
            background-color: #ccc;
        }
    </style>
        
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
                    
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-coins display-5" style="color:#ff0d00;"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Monthly Entry</div>
                                    <div class="stat-digit"><?php if($income['Total'] == 0){ echo "₱ 0";}else{ echo "₱ ".$income['Total'];}?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card" onclick="window.location.href='assemblylist.php'; return false;">
                            <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-list display-5" style="color:#ff0d00;"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Assembly</div>
                                    <div class="stat-digit"><?php if($Assembly['Assemble_Total'] == 0){ echo "0";}else{ echo $Assembly['Assemble_Total'];}?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card" onclick="window.location.href='branches.php'; return false;">
                            <div class="stat-widget-one card-body">
                            <i class="fi fi-rr-code-branch display-5" style="color:#ff0d00;"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Branch</div>
                                    <div class="stat-digit"><?php echo $bbranch['branch']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                            <i class="fi fi-rr-circle-user display-5" style="color:#ff0d00;"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Personel</div>
                                    <div class="stat-digit"><?php echo $sttafss['staffs']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card" onclick="window.location.href='absent.php'; return false;">
                            <div class="stat-widget-one card-body">
                            <i class="fi fi-rr-delete-user display-5" style="color:#ff0d00;"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Absent</div>
                                    <div class="stat-digit"><?php echo $absent['absent']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                            <i class="fi fi-rr-check-circle display-5" style="color:#ff0d00;"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Present</div>
                                    <div class="stat-digit"><?php echo $present['present']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-layers display-5" style="color:#ff0d00;"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Inventory</div>
                                    <div class="stat-digit"><?php echo $innventory['inventory']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card" onclick="window.location.href='alertproduct.php'; return false;">
                            <div class="stat-widget-one card-body">
                            <i class="fi fi-rr-engine-warning display-5" style="color:#ff0000;"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Inventory Alert</div>
                                    <div class="stat-digit"><?php echo $alertprd['total_arlert']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                            <h4 class="card-title">Yearly Statistic</h4>  <h4 class="card-title"><a href="statistic.php" class="btn" style="background-color: var( --primary-color); color : white;">Back</a></h4> 
                            </div>
                            <div class="card-body">
                                <canvas id="barChart"></canvas>
                       
                                    <script>
                                        var months = <?php echo json_encode($months); ?>;
                                        var totals = <?php echo json_encode($totals); ?>;
                                        var ctx = document.getElementById('barChart').getContext('2d');
                                        var barChart = new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: months,
                                                datasets: [{
                                                    label: 'Total income per Month of The Year <?php echo $transayear;?>',
                                                    data: totals,
                                                    backgroundColor: '#FF4500', // Set the bar color to orange
                                                    borderColor: 'White',
                                                    borderWidth: 1
                                                }]
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            }
                                        });
                                    </script>
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