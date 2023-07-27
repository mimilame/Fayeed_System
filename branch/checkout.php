<?php include 'head.php'?>
<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="../images/site/fayeed.png" alt="">
                <img class="logo-compact" src="../images/site/fayeed.png" alt="">
                <h4 class="brand-title"><?php echo $settings['System_Name']?></h4>
            </a>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <?php include 'header.php'; include 'sidebar.php'?>

        <div class="content-body">
            <div class="container-fluid">
            <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">

                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php if(isset($edit['assemblyName'])){ echo "Update Assembly <b>".$edit['assemblyName']."'s</b> Details";}else{echo "Checkout Pannel";} ?></h4> <a href="assemblylist.php" class="btn btn-primary">Back</a>
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
                    if(isset($info)){ ?>
                        <div class="alert alert-danger">
                            <?php
                            echo  $info;
                            ?>
                        </div>
                    <?php }
                    ?>

                                <div class="basic-form">
                                <form action="" method="post" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Check Inventory</label>
                                                <select class="chosen form-control" name="invenID">
                                                        <?php if(isset($edit['inventoryId'])) { ?> <option class="btn-danger" value="<?php echo $edit['inventoryId']?>"><?php echo $edit['inventoryName']?></option> <?php }else{ ?>    <option value="#">Choose Inventory</option><?php } ?>
                                                        <?php while($branch = mysqli_fetch_array($inventori)){ ?>
                                                            <option value="<?php echo $branch['inventoryId']?>" ><?php echo $branch['inventoryName']." - ".$branch['product_code']?></option>
                                                        <?php }?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Date Transaction</label>
                                                <input type="text" name="date" class="form-control" value="<?php echo $currentDatetransaction?>" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Time Transaction</label>
                                                <input type="text" name="time" class="form-control"  value="<?php echo $currentDateTimetrasaction?>" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Client Name</label>
                                                <input type="text" name="name" class="form-control"  required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Inventory Quantity</label>
                                                <input type="number" name="quanty" class="form-control" value="1"  required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Mode of Payment</label>
                                                <select name="mop" class="form-control" id="">
                                                    <option value="#">Choose ...</option>
                                                    <option value="Gcash">Gcash</option>
                                                    <option value="Remittance">Remittance</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="BankTransfer">Bank Transfer</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Contact Number</label>
                                                <input type="number" name="contact" class="form-control"  required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>City Address</label>
                                                <input type="text" name="city" class="form-control"  required>
                                            </div>
                                            <div class="form-group col-md-6">
                                            <button type="submit" name="checkout" class="btn btn-primary">Submit</button>
                                            </div>

                                    </form>
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
</body>
</html>