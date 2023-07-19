<?php include 'head.php'?>
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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home">System Information</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile">Email Protocol</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#alert">Control Alert</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#attendance">Attendance Alert</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel">
                                            <div class="pt-4">
                                               <form action="" method="post">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="1">System Name</label>
                                                            <input type="text" name="name" id="" class="form-control" value="<?php echo $settings['System_Name']?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="1">System Email</label>
                                                            <input type="email" name="email" id="" class="form-control"  value="<?php echo $settings['System_Email']?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="1">System Contact Number</label>
                                                            <input type="number" name="number" id="" class="form-control"  value="<?php echo $settings['System_number']?>">
                                                           
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="submit" name="set1" class="btn btn-primary form-control mt-4">Save Details</button>
                                                        </div>
                                                    </div>
                                               </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <div class="pt-4">
                                            <form action="" method="post">
                                                    <div class="row"> 
                                                        <div class="col-6">
                                                            <label for="1">System Link</label>
                                                            <input type="text" name="System_link" id="" class="form-control"  value="<?php echo $settings['System_link']?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="1">Email</label>
                                                            <input type="email" name="smtp" id="" class="form-control"  value="<?php echo $settings['Smtp_email']?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="1">Password</label>
                                                            <input type="text" name="pass" id="" class="form-control"  value="<?php echo $settings['Smatp_password']?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="1">Provider</label>
                                                            <input type="text" name="prov" id="" class="form-control"  value="<?php echo $settings['Smtp_Provider']?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="1">Port</label>
                                                            <input type="number" name="port" id="" class="form-control"  value="<?php echo $settings['Smtp_port']?>">
                                                           
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="submit"  name="set2" class="btn btn-primary form-control mt-4">Save Details</button>
                                                        </div>
                                                    </div>
                                               </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="alert">
                                            <div class="pt-4">
                                            <form action="" method="post">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="1">Product Quantity Limit</label>
                                                            <input type="number" name="limit" id="" class="form-control"  value="<?php echo $settings['product_control']?>">
                                                        </div>
                                                        
                                                        <div class="col-6">
                                                            <button type="submit"  name="set3" class="btn btn-primary form-control mt-4">Save Details</button>
                                                        </div>
                                                    </div>
                                               </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="attendance">
                                            <div class="pt-4">
                                            <form action="" method="post">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="1">Time In Morning</label>
                                                            <input type="time" name="morning" id="" class="form-control"  value="<?php echo $settings['latetimein_morning']?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="1">Time in Afternoon</label>
                                                            <input type="time" name="afternoon" id="" class="form-control"  value="<?php echo $settings['latetimein_afternoon']?>">
                                                        </div>
                                                        
                                                        <div class="col-6">
                                                            <button type="submit"  name="set4" class="btn btn-primary form-control mt-4">Save Details</button>
                                                        </div>
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
            </div>
        </div>
        
        <!--**********************************
            Content body end
        ***********************************-->
        
    </div>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.16/dist/sweetalert2.all.min.js
"></script>
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