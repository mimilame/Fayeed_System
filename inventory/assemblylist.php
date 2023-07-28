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
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="add-assembly.php" class="btn btn-secondary text-light">Add Assembly Item</a></li>
                        </ol>
                    </div>

                </div>
                <!-- row -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>List of Assembly Inventory</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Assembly Name</th>
                                                <th>Status</th>
                                                <th>Target Inventory</th>
                                                <th>Target Number</th>
                                                <th>Added by</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($inventorylist = mysqli_fetch_array($assemlist)){ ?>
                                                <tr>
                                                <td></td>
                                                <td><?php echo $inventorylist['assemblyName'] ?></td>
                                                <td>
                                                <?php $butch = mysqli_query($con,"SELECT count(assemblyID) idchej from assembly_inventory where assemblyID = '".$inventorylist['assemblyID']."'");
                                                          $displays= mysqli_fetch_assoc($butch);
                                                          if($displays['idchej'] > 1){ ?>
                                                         <p class="bg-<?php if($inventorylist['assemblyStatus']=="Assemble"){ echo "warning";}else{ echo "success";}?> text-light text-center"><?php echo $inventorylist['assemblyStatus'] ?></p>
                                                          <?php }else{
                                                            echo "No Component inventories";
                                                          } ?></td>
                                                <td><?php echo $inventorylist['inventoryName'] ?></td>
                                                <td><?php echo $inventorylist['assemblyQuatty'] ?></td>
                                                <td><?php echo $inventorylist['usersFirstName']." ".$inventorylist['usersLastName'] ?></td>
                                                <td>
                                                    <?php if($inventorylist['assemblyStatus']!="Assemble"){?>
                                                    <a href="add-assembly.php?editassembly=<?php echo $inventorylist['assemblyID'] ?>"><i class="fi fi-rr-pencil btn btn-primary"></i></a>
                                                <a href="add-assembly.php?delassembly=<?php echo $inventorylist['assemblyID'] ?>"><i class="fi fi-rr-trash btn btn-danger"></i></a>
                                                <?php }else{ ?> No Action Available<?php } ?>

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