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
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php if(count($errors) == 0){ ?><?php if(isset($edit['assemblyName'])){ echo "Update Assembly <b>".$edit['assemblyName']."'s</b> Details";}else{echo "Add New Assembly";} ?> <?php  }?></h4> <a class="btn btn-danger" href="assembyqtyedit.php?cancelssembly=<?php echo $edit['assemblyID'] ?>">Cancel Procedure</a>
                            </div>
                            <div class="card-body">
                                <?php
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

                                <div class="basic-form"> <?php if(count($errors) == 0){ ?>
                                    <form action="" method="post" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-3" style="display: <?php if($editassembly != ""){ echo "None";}?>;">
                                                <label>Select Inventory</label>
                                                <select class="chosen form-control" name="invenID">
                                                    <?php if(isset($edit['inventoryId'])) { ?> <option class="btn-danger" value="<?php echo $edit['inventoryId']?>"><?php echo $edit['inventoryName']?></option> <?php }else{ ?>    <option value="#">Choose Inventory</option><?php } ?>

                                                        <?php while($branch = mysqli_fetch_array($inventori)){ ?>
                                                            <option value="<?php echo $branch['inventoryId']?>" ><?php echo $branch['inventoryName']?></option>
                                                        <?php }?>
                                                    </select>
                                            </div>
                                            <div class="form-group col-md-5" style="display: <?php if($editassembly != ""){ echo "None";}?>;">
                                                <label>Assembly Name</label>
                                                <input type="text" name="Assemblyname" class="form-control" value="<?php echo $edit['assemblyName']?>" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Assembly Quantity</label>
                                                <input type="number" name="quanty" min="1" max="5" class="form-control" <?php if(isset($edit['assemblyQuatty'])){ ?> value="<?php echo $edit['assemblyQuatty']?>" <?php }else{ ?> value="1" <?php }?> required> <br>
                                                <br>
                                                <button type="submit" name="assembly" class="btn btn-primary"><?php if(isset($edit['assemblyName'])){ echo "Update Assembly Details and Proceed";}else{echo "Create Assembly inventory";} ?></button>
                                            </div>


                                    </form>
                                    <?php  }?>
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