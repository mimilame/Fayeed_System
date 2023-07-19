<?php include 'head.php'?>
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
                    
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-coins display-5" style="color:#ff0d00;"></i>
                                <div class="stat-content d-inline-block">
                                    <div class="stat-text">Monthly Entry</div>
                                    <div class="stat-digit"><?php if($income['total'] == 0){ echo "₱ 0";}else{ echo "₱ ".$income['total'];}?></div>
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
                                    <div class="stat-digit"><?php if($Assembly['Total'] == 0){ echo "0";}else{ echo $Assembly['Total'];}?></div>
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
                                    <div class="stat-digit"><?php echo $innventory['total']?></div>
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
                                    <div class="stat-digit"><?php echo $alertprd['alert']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Latest Trasactions 10 Trasactions</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table student-data-table m-t-20">
                                        <thead>
                                            <tr>
                                                <th>Transction Code</th>
                                                <th>Inventory Name</th>
                                                <th>Quantity</th>
                                                <th>Branch Name</th>
                                                <th>Amount Payed</th>
                                                <th>Mode of Payment</th>
                                                <th>Transaction Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($transaction = mysqli_fetch_array($tranv)){   ?>
                                                <tr>
                                                    <td><?php echo $transaction['Transaction_code'] ?></td>
                                                    <td><?php echo $transaction['inventoryName'] ?></td>
                                                    <td><?php echo $transaction['quantity'] ?></td>
                                                    <td><?php echo $transaction['Branch_Name'] ?></td>
                                                    <td><?php echo "₱ ".$transaction['amount_payment'] ?></td>
                                                    <td><?php echo $transaction['mop'] ?></td>
                                                    <td><?php echo $transaction['time']." - ".$transaction['date'] ?></td>
                                                
                                                </tr>
                                            <?php }?>
                                            
                                            
                                        </tbody>
                                    </table>
                                    <a href="checktransaction.php" class="btn btn-primary">View all Trasactions</a>
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
</body>
</html>