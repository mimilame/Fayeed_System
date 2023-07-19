<?php include 'head.php';
$tranv = mysqli_query($con,"SELECT checkout.Transaction_code , inventory.inventoryName ,checkout.quantity ,branches.Branch_Name ,checkout.amount_payment ,checkout.mop ,checkout.date ,checkout.time from checkout join inventory on inventory.inventoryId = checkout.inventoryId join branches on branches.branchID = checkout.branchID ORDER BY checkout.checkoutID DESC LIMIT 10");
$clisttrans = mysqli_num_rows($tranv);
?>
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
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <p class="mb-0"><h4><?php echo $formattedDate; ?></h4></p>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-5 col-sm-12">
                        <div class="card">
                            <div class="stat-widget-one card-body">
                                <div class="d-inline-flex flex-wrap">
                                    <i class="bx bxs-bar-chart-square display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-text pt-3 pl-2">Gross Sales</div>
                                </div>
                                <div class="stat-content">
                                    <!-- Add a placeholder for the Morris.js chart -->
                                    <div id="morris-line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-12 d-inline-flex flex-wrap">
                        <div class="col-lg-6 col-sm-6">
                            <div class="card" onclick="window.location.href='statistic.php'; return false;">
                                <div class="stat-widget-one card-body"> <!-- change color light orange-->
                                    <i class="fi fi-rr-coins display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Monthly Entry</div>
                                        <div class="stat-digit"><?php if($income['Total'] == 0){ echo "₱ 0";}else{ echo "₱ ".$income['Total'];}?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card" onclick="window.location.href='assemblylist.php'; return false;">
                                <div class="stat-widget-one card-body">
                                    <i class="fi fi-rr-list display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Assembly</div>
                                        <div class="stat-digit"><?php if($Assembly['Assemble_Total'] == 0){ echo "0";}else{ echo $Assembly['Assemble_Total'];}?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card" onclick="window.location.href='branches.php'; return false;">
                                <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-code-branch display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Branch</div>
                                        <div class="stat-digit"><?php echo $bbranch['branch']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-circle-user display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Personel</div>
                                        <div class="stat-digit"><?php echo $sttafss['staffs']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card" onclick="window.location.href='absent.php'; return false;">
                                <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-delete-user display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Absent</div>
                                        <div class="stat-digit"><?php echo $absent['absent']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-check-circle display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Present</div>
                                        <div class="stat-digit"><?php echo $present['present']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="stat-widget-one card-body">
                                    <i class="fi fi-rr-layers display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Inventory</div>
                                        <div class="stat-digit"><?php echo $innventory['inventory']?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card" onclick="window.location.href='alertproduct.php'; return false;">
                                <div class="stat-widget-one card-body">
                                <i class="fi fi-rr-engine-warning display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Inventory Alert</div>
                                        <div class="stat-digit"><?php echo $alertprd['total_arlert']?></div>
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
                                <h4 class="card-title">Latest Transactions</h4>

                                <?php if ($clisttrans < 10): ?>
                                    <p class="">Showing <strong><?php echo $clisttrans; ?></strong> Transactions</p>
                                <?php else: ?>
                                    <p class="">Showing <strong>10</strong> of <strong><?php echo $clisttrans; ?></strong> Transactions</p>
                                <?php endif; ?>
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
                                                    <td><?php echo $transaction['amount_payment'] ?></td>
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
            // Chart data records for all data series ("Finished Assemblies," "Absences," and yearly income).
            data: dataCombined,
            // The name of the data record attribute that contains x-values.
            xkey: 'year',
            // A list of names of data record attributes that contain y-values for all data series.
            ykeys: ['finished_assemblies', 'absences', 'yearly_income'],
            // Labels for the ykeys -- will be displayed when you hover over the chart for all data series.
            labels: ['Finished Assemblies', 'Absences', 'Yearly Income'],
            // Line colors for all data series.
            lineColors: ['#ff6a00', '#00cc99', '#428bca'],
        });


    </script>
</body>
</html>