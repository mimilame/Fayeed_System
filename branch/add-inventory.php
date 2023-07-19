<?php include 'head.php';?>
<body>
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="../images/site/fayeed.png" alt="">
                <img class="logo-compact" src="../images/site/fayeed.png" alt="">
                <h4 class="brand-title"><?php echo $branchde['city']?></h4>
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
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php if(isset($branch['Branch_Name'])){ echo "Update Branch <b>".$branch['Branch_Name']."'s</b> Details";}else{echo "Add New inventory";} ?></h4> <a href="inventorylist.php" class="btn btn-primary">Back</a>
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
                                           
                                            <div class="form-group col-md-4">
                                                <label>Inventory Name</label>
                                                <input type="text" name="inventoryname" class="form-control" value="<?php echo $show_ivent['inventoryName']?>" required>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Inventory Quantity</label>
                                                <input type="number" name="quanty" class="form-control" value="<?php echo $show_ivent['inventoryQty']?>" required>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>Inventory Price</label>
                                                <input type="number" name="price" placeholder="₱ " class="form-control" value="<?php echo $show_ivent['price']?>" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Inventory Code </label>
                                                <input type="text" name="code" class="form-control" value="<?php echo $show_ivent['product_code']?>" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Inventory Description</label>
                                                <textarea name="description" class="form-control" id="" cols="30" rows="5"><?php echo  $show_ivent['inventoryDesc']?></textarea>
                                                </div>
                                           
                                        </div>
                                        <button type="submit" name="addinventory" class="btn btn-primary"><?php if(isset($show_ivent['inventoryName'])){ echo "Update Inventory Details";}else{echo "Create New inventory";} ?></button>
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