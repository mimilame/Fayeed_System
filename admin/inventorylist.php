<?php include 'head.php'?>
<body>
<?php
    if (isset($_GET['InventoryDel']) && $_GET['InventoryDel'] == '1' && isset($_SESSION['InventoryDel'])) {
        echo <<<EOL
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Deleted Inventory Successfully!',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    position: 'top-end',
                    timer: 5000
                }).then(() => {
                    window.location.href = 'inventorylist.php';
                });
            </script>
        EOL;
        unset($_SESSION['InventoryDel']);
    }if (isset($_GET['InventoryAdd']) && $_GET['InventoryAdd'] == '1' && isset($_SESSION['InventoryAdd'])) {
        echo <<<EOL
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Added Inventory Successfully!',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    position: 'top-end',
                    timer: 5000
                }).then(() => {
                    window.location.href = 'inventorylist.php';
                });
            </script>
        EOL;
        unset($_SESSION['InventoryAdd']);
    }if (isset($_GET['InventoryUpdate']) && $_GET['InventoryUpdate'] == '1' && isset($_SESSION['InventoryUpdate'])) {
        echo <<<EOL
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Updated Inventory Successfully!',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    position: 'top-end',
                    timer: 5000
                }).then(() => {
                    window.location.href = 'inventorylist.php';
                });
            </script>
        EOL;
        unset($_SESSION['InventoryUpdate']);
    }
?>
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
                        <h4><?php echo $formattedDate; ?></h4>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="inventorylist.php" class="btn btn-secondary text-light">View by List</a></li>
                            <li class="breadcrumb-item"><a href="inventory.php" class="btn btn-secondary text-light">View by Cards</a></li>
                            <li class="breadcrumb-item"><a href="add-inventory.php" class="btn btn-secondary text-light">Add inventory</a></li>
                        </ol>
                    </div>

                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List of Inventories</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Inventory Code</th>
                                                <th>Inventory Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Inventory Branch Name</th>
                                                <th>Added by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($inventorylist = mysqli_fetch_array($inlist)){ ?>
                                                <tr>
                                                <td></td>
                                                <td><?php echo $inventorylist['product_code'] ?></td>
                                                <td><?php echo $inventorylist['inventoryName'] ?></td>
                                                <td>
                                                    <p class="<?php if($settingss['product_control'] > $inventorylist['inventoryQty']){ echo "bg-danger text-light text-center";}?>">
                                                    <?php echo $inventorylist['inventoryQty']?>
                                                    </p>
                                                </td>
                                                <td><?php echo "₱ " . number_format($inventorylist['price'], 2, '.', ',');?></td>
                                                <td><?php echo $inventorylist['Branch_Name'] ?></td>
                                                <td><?php echo $inventorylist['usersFirstName']." ".$inventorylist['usersLastName'] ?></td>
                                                <td><a href="add-inventory.php?editinventory=<?php echo $inventorylist['inventoryId'] ?>"><i class="fi fi-rr-pencil btn btn-primary"></i></a>
                                                <a href="#" onclick="showInventoryDeleteConfirmation(<?php echo $inventorylist['inventoryId']; ?>)">
                                                    <i class="fi fi-rr-trash btn btn-danger"></i>
                                                </a>

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
    <script>
        function showInventoryDeleteConfirmation(inventoryId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this. Are you sure you want to delete this inventory?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, redirect to the delete page
                    window.location.href = `inventorylist.php?delnventory=${inventoryId}`;
                }
            });
        }
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
    <script src="../vendor/datatables/js/jquery-3.7.0.js"></script>
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/js/dataTables.responsive.min.js"></script>
    <script src="../js/plugins-init/datatables-api-init.js"></script>
    <script src="../js/plugins-init/datatables.init.js"></script>
</body>
</html>