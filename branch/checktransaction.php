<?php include 'head.php'?>
<body>
<?php
if (isset($_GET['checkout_items']) && $_GET['checkout_items'] == '1' && isset($_SESSION['checkout_items'])) {
    echo <<<EOL
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Successfully Checked Out Items for $name !!!',
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-end',
                timer: 5000
            }).then(() => {
                window.location.href = 'checktransaction.php';
            });
        </script>
    EOL;
    unset($_SESSION['checkout_items']);
}
?>
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
        <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
        <?php include 'header.php'; include 'sidebar.php'?>

     <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                        <h4><?php echo $formattedDate; ?></h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">

                    </div>

                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Checkout Transactions</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Trasaction Code </th>
                                                <th>Inventory Name</th>
                                                <th>Quantity</th>
                                                <th>Amount Payment</th>
                                                <th>Mode of Payment</th>
                                                <th>Transaction Time</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($checkout = mysqli_fetch_array($checj)){ ?>
                                                <tr>
                                                <td></td>
                                                <td><?php echo $checkout['Transaction_code'] ?></td>
                                                <td><?php echo $checkout['inventoryName'] ?></td>
                                                <td><?php echo $checkout['quantity'] ?></td>
                                                <td><?php echo "₱ ".$checkout['amount_payment'] ?></td>
                                                <td><?php echo $checkout['mop'] ?></td>
                                                <td><?php echo $checkout['time']." - ".$checkout['date'] ?></td>

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