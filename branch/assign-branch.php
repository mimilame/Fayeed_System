<?php include 'head.php'?>
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
                                <h2 class="card-title">Branch Details</h2> 
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
                                <h4 class="card-title">Appoint Branch roles</h4><br>
                                        <form action="" method="GET" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="form-group col-md-5">
                                                    <label>Appoint User</label>
                                                    <select class="chosen form-control" name="userid">
                                                    <option value="#">Choose User....</option>
                                                        <?php while($administratorss = mysqli_fetch_array($n_roles)){ ?>
                                                            <?php $adminID = $administratorss['usersID'] ;
                                                              $chll = mysqli_query($con,"select count(usersID) as roles from branch_staff where usersID = $adminID;"); $chkk = mysqli_fetch_array($chll);
                                                                if($chkk['roles'] == 0){ ?> <option value="<?php echo $administratorss['usersID']?>" ><?php echo $administratorss['email']?></option><?php }?>
                                                            
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-5 ml-5">
                                                <label>Available Roles </label> <br>
                                                <?php $rck = mysqli_query($con,"select count(roles) as roles from branch_staff where branchID = $editbranch and roles =1 "); $ckrole = mysqli_fetch_assoc($rck);?>
                                                <?php $rck2 = mysqli_query($con,"select count(roles) as roless from branch_staff where branchID = $editbranch and roles =2 "); $ckrole2 = mysqli_fetch_assoc($rck2);?>
                                                        <?php if($ckrole['roles'] >= 1){ ?>
                                                              <?php }else{?> <input type="radio" name="roles" id="" value="1">Branch Manager <br><?php }?>
                                                              <?php if($ckrole2['roless'] >= 1){ ?>
                                                              <?php }else{?>  <input type="radio" name="roles" id="" value="2">Branch  Inventory  <br><?php }?>
                                                        
                                                       
                                                        <input type="radio" name="roles" id="" value="3">Branch Staff 
                                                    </div>
                                            </div>
                                        <button type="submit" name="addroles" class="btn btn-primary"><?php if(isset($branch['Branch_Name'])){ echo "Assign Branch Roles";}else{echo "Create New Branch";} ?></button>
                                    </form>
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