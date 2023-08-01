<?php include 'head.php'?>
<body>
<?php
if (isset($_GET['add_assemblycompo']) && $_GET['add_assemblycompo'] == '1' && isset($_SESSION['add_assemblycompo'])) {

    echo <<<EOL
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Add Component Success!',
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-end',
                timer: 5000
            }).then(() => {
                const urlParams = new URLSearchParams(window.location.search);
                const inventoryID = urlParams.get('components');
                window.location.href = 'add_assemblycompo.php?components=' + encodeURIComponent(inventoryID);
            });
        </script>
    EOL;
    unset($_SESSION['add_assemblycompo']); // Unset the session variable

}

if (isset($_GET['delete_assemblycompo']) && $_GET['delete_assemblycompo'] == '1' && isset($_SESSION['delete_assemblycompo'])) {
    echo <<<EOL
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Deleted Successfully!',
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-end',
                timer: 5000
            }).then(() => {
                const urlParams = new URLSearchParams(window.location.search);
                const inventoryID = urlParams.get('components');
                // Redirect to add_assemblycompo.php with the inventoryID
                window.location.href = 'add_assemblycompo.php?components=' + encodeURIComponent(inventoryID);
            });
        </script>
    EOL;
    unset($_SESSION['delete_assemblycompo']);
}


?>
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
    <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
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
                                <h4 class="card-title"><?php if(isset($edit['assemblyName'])){ echo "Update Assembly <b>".$edit['assemblyName']."'s</b> Details";}else{echo "Add Assembly Components of <b>".$aseble['assemblyName']."</b>";} ?></h4> <a href="assemblycompo.php" class="btn btn-primary">Back</a>
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
                                            <div class="form-group col-md-6" >
                                                <label>Select Inventory</label>
                                                <select class="chosen form-control" name="inventory">
                                                    <?php if(isset($edit['inventoryId'])) { ?> <option class="btn-danger" value="<?php echo $edit['inventoryId']?>"><?php echo $edit['inventoryName']?></option> <?php }else{ ?>    <option value="#">Choose Inventory</option><?php } ?>

                                                        <?php while($branch = mysqli_fetch_array($inventoriis)){ $brID = $branch['inventoryId'];?>
                                                            <?php $ckinbnn= mysqli_query($con,"select count(*) itnm from assembly_inventory where inventory_list = $brID && assemblyID = $assembleID ");
                                                            $ckinv = mysqli_fetch_assoc($ckinbnn);
                                                            if($ckinv['itnm'] == 0 ){ ?>
                                                                <option value="<?php echo $branch['inventoryId']?>" ><?php echo $branch['inventoryName']." - ".$branch['product_code']?></option>
                                                            <?php }

                                                            ?>

                                                        <?php }?>
                                                    </select>
                                            </div>

                                            <div class="form-group col-md-5 ml-5">
                                                <label>Assembly Quantity</label>
                                                <input type="number" name="quanty" class="form-control" <?php if(isset($edit['assemblyQuatty'])){ ?> value="<?php echo $edit['assemblyQuatty']?>" <?php }else{ ?> value="1" <?php }?> required>
                                            </div>

                                        <button type="submit" name="compoassembly" class="btn btn-primary"><?php if(isset($edit['assemblyName'])){ echo "Update Assembly Details";}else{echo "Add Assembly Components";} ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Assembly Components</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Inventory Name</th>
                                                <th>Quantity in Assembly</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($inventorylist = mysqli_fetch_array($asscompo)){ ?>
                                                <tr>
                                                <td></td>
                                               <td><?php echo $inventorylist['inventoryName'] ?></td>
                                               <td><?php echo $inventorylist['inventory_qty'] ?></td>
                                                <td>
                                                    <?php if($inventorylist['assemblyStatus']!="Assemble"){?>
                                                    <a href="#"onclick="showInventoryDeleteConfirmation(<?php echo $inventorylist['assembly_inventoryID']; ?>)"><i class="fi fi-rr-trash btn btn-danger"></i></a>
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
        </div>

    </div>
    <script type="text/javascript">
      $(".chosen").chosen();
</script>
<script>
        function showInventoryDeleteConfirmation(assembly_inventoryID) {
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
                    window.location.href = `add-assemblycompo.php?delets==${assembly_inventoryID}`;
                }
            });
        }
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