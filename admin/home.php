<?php include 'head.php';
$tranv = mysqli_query($con,"SELECT checkout.Transaction_code , inventory.inventoryName ,checkout.quantity ,branches.Branch_Name ,checkout.amount_payment ,checkout.mop ,checkout.date ,checkout.time from checkout join inventory on inventory.inventoryId = checkout.inventoryId join branches on branches.branchID = checkout.branchID ORDER BY checkout.checkoutID DESC LIMIT 5");
$clisttrans = mysqli_num_rows($tranv);
?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

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
                                        <div class="stat-digit"><?php echo $absencesCount?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="card">
                                <div class="stat-widget-one card-body">
                                <i class="bx bx-alarm-exclamation display-5" style="color:#ff6a00;"></i>
                                    <div class="stat-content d-inline-block">
                                        <div class="stat-text">Late</div>
                                        <div class="stat-digit"><?php echo $latesCount?></div>
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

                                <?php if ($clisttrans < 5): ?>
                                    <p class="">Showing <strong><?php echo $clisttrans; ?></strong> Transactions</p>
                                <?php else: ?>
                                    <p class="">Showing <strong>5</strong> of <strong><?php echo $clisttrans; ?></strong> Transactions</p>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="notable" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th></th>
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
                                                    <td></td>
                                                    <td><?php echo $transaction['Transaction_code'] ?></td>
                                                    <td><?php echo $transaction['inventoryName'] ?></td>
                                                    <td><?php echo $transaction['quantity'] ?></td>
                                                    <td><?php echo $transaction['Branch_Name'] ?></td>
                                                    <td>&#8369; <?php echo $transaction['amount_payment'] ?></td>
                                                    <td><?php echo $transaction['mop'] ?></td>
                                                    <td><?php echo $transaction['time']." - ".$transaction['date'] ?></td>

                                                </tr>
                                            <?php }?>


                                        </tbody>
                                    </table>
                                    <a href="checktransaction.php" class="btn btn-primary mt-3">View all Trasactions</a>
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
    <script src="../vendor/datatables/js/jquery-3.7.0.js"></script>
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/js/dataTables.responsive.min.js"></script>
    <script src="../js/plugins-init/datatables-api-init.js"></script>
    <script src="../js/plugins-init/datatables.init.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.19/sweetalert2.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script>
        var customCSS = document.createElement('style');
        customCSS.innerHTML = '.morris-hover.morris-default-style { position: absolute; z-index: 0!important; }';
        document.head.appendChild(customCSS);
    </script>

    <script>
        var dataCombined = <?php echo $jsonDataCombined; ?>;
        console.log(dataCombined);

        Morris.Area({
            element: 'morris-line-chart',
            data: dataCombined,
            xkey: 'date_group',
            ykeys: ['finished_assemblies', 'yearly_income', 'absences'],
            labels: ['Finished Assemblies', 'Yearly Income', 'Absences'],
            lineColors: ['#D97604', '#FF4C00', '#0E0E0E'],
            continuousLine: false,
            yMin: 0,
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['#242423'],
            xLabelAngle: 45,
        });


    </script>
</body>
</html>