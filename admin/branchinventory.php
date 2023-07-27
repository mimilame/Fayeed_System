<?php include 'head.php';
$invtyr = mysqli_query($con,"select inventory.price, inventory.inventoryName, inventory.inventoryDesc, inventory.inventoryId, inventory.inventoryQty, branches.Branch_Name ,users.usersFirstName, users.usersLastName from inventory join branches on branches.branchID = inventory.branchID join users on users.usersID = inventory.usersID where inventory.branchID = $branchIDD")?>
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
        <link href="../vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
        <?php include 'header.php'; include 'sidebar.php'?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Branch Details</h4> <a href="branches.php" class="btn btn-primary">Back</a>
                            </div>
                            <div class="card-body"><?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                                <div class="basic-form">
                                <form action="" method="post" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Branch Name</label>
                                                <input type="text"  class="form-control" value="<?php echo $branch['Branch_Name']?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Branch Address</label>
                                                <input type="text" class="form-control" value="<?php echo $branch['Branch_Address']?>" disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>City</label>
                                                <input type="text" class="form-control" value="<?php echo $branch['city']?>" disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Contact Number</label>
                                                <input type="number" class="form-control" value="<?php echo $branch['Branch_Contact_number']?>" disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Email</label>
                                                <input type="email"class="form-control" value="<?php echo $branch['branch_email']?>" disabled>
                                            </div>
                                        </div>

                                </div><hr>
                                <h4 class="card-title">Existing Inventories in this Branch</h4>
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Inventory Name</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Inventory Branch Name</th>
                                                <th>Added by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($inventorylist = mysqli_fetch_array($invtyr)){ ?>
                                                <tr>
                                                <td></td>
                                                <td><?php echo $inventorylist['inventoryName'] ?></td>
                                                <td><?php echo $inventorylist['inventoryQty'] ?> pcs</td>
                                                <td><?php echo $inventorylist['price'] ?></td>
                                                <td><?php echo $inventorylist['Branch_Name'] ?></td>
                                                <td><?php echo $inventorylist['usersFirstName']." ".$inventorylist['usersLastName'] ?></td>
                                                <td><a href="add-inventory.php?editinventory=<?php echo $inventorylist['inventoryId'] ?>"><i class="fi fi-rr-pencil btn btn-primary"></i></a></td>
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
        </div>

    </div>
    <script type="text/javascript">
      $(".chosen").chosen();
</script>
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