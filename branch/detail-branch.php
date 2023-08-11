<?php include 'head.php';
$emp = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles, branch_staff.staffID, branches.Branch_Name from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branches.branchID = $desigbranch")?>
<body>
<?php
    if (isset($_GET['appointuser']) && $_GET['appointuser'] == '1' && isset($_SESSION['appointuser'])) {
        echo <<<EOL
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Appoint Successfully',
                    showConfirmButton: false,
                    position: 'top-end',
                    timerProgressBar: true,
                    timer: 5000
                }).then(() => {
                    // Get the branchID from the URL using URLSearchParams
                    const urlParams = new URLSearchParams(window.location.search);
                    const branchID = urlParams.get('branch');
                    // Redirect to detail-branch.php with the branchID
                    window.location.href = 'detail-branch.php?branch=' + encodeURIComponent(branchID);
                });
            </script>
        EOL;
        unset($_SESSION['appointuser']);
    } if (isset($_GET['changuser']) && $_GET['changuser'] == '2' && isset($_SESSION['changuser'])) {
        echo <<<EOL
            <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Role Set to Staff',
                showConfirmButton: false,
                position: 'top-end',
                timerProgressBar: true,
                timer: 5000
            }).then(() => {
                const urlParams = new URLSearchParams(window.location.search);
                const branchID = urlParams.get('branch');
                window.location.href = 'detail-branch.php?branch=' + encodeURIComponent(branchID);
            });
            </script>
        EOL;
        unset($_SESSION['changuser']);
    } if (isset($_GET['changuser']) && $_GET['changuser'] == '3' && isset($_SESSION['changuser'])) {
        echo <<<EOL
            <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Role Set to Inventory Admin',
                showConfirmButton: false,
                position: 'top-end',
                timerProgressBar: true,
                timer: 5000
            }).then(() => {
                const urlParams = new URLSearchParams(window.location.search);
                const branchID = urlParams.get('branch');
                window.location.href = 'detail-branch.php?branch=' + encodeURIComponent(branchID);
            });
            </script>
        EOL;
        unset($_SESSION['changuser']);
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>

        <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
        <?php include 'header.php'; include 'sidebar.php'?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Branch Details</h4>
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
                                                <input type="text"  class="form-control" value="<?php echo $branchde['Branch_Name']?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Branch Address</label>
                                                <input type="text" class="form-control" value="<?php echo $branchde['Branch_Address']?>" disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>City</label>
                                                <input type="text" class="form-control" value="<?php echo $branchde['city']?>" disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Contact Number</label>
                                                <input type="number" class="form-control" value="<?php echo $branchde['Branch_Contact_number']?>" disabled>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Email</label>
                                                <input type="email"class="form-control" value="<?php echo $branchde['branch_email']?>" disabled>
                                            </div>
                                        </div>

                                </div><hr>
                                <h4 class="card-title">List of Working Personnel </h4><br><a class="btn btn-primary" href="assign-branch.php?branch=<?php echo $desigbranch?>">Add Personnel</a>
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Contact Number</th>
                                                <th>Roles</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($administratorss = mysqli_fetch_array($emp)){ ?>
                                                <tr>
                                                <td></td>
                                                <td><?php if($administratorss['usersFirstName']==""){ echo ".........";}else{echo $administratorss['usersFirstName'];}?></td>
                                                <td><?php if($administratorss['usersLastName']==""){ echo ".........";}else{echo $administratorss['usersLastName'];}?></td>
                                                <td><?php if($administratorss['Address']==""){ echo ".........";}else{echo $administratorss['Address'];}?></td>
                                                <td><?php if($administratorss['email']==""){ echo ".........";}else{echo $administratorss['email'];}?></td>
                                                <td><?php if($administratorss['CellNumber']==""){ echo ".........";}else{echo $administratorss['CellNumber'];}?></td>
                                                <td><?php if($administratorss['roles']==1){ echo " Branch Manager ";}elseif($administratorss['roles']==2) { echo " Inventory Admin ";}else{ echo "Branch Staff";}?></td>
                                                <td><a href="check-profile.php?profile=<?php echo $administratorss['usersID']?>"><i class="fi fi-rr-user btn btn-primary"></i></a> <?php if($administratorss['usersID'] != $id){ ?> <a href="detail-branch.php?branch=<?php echo $desigbranch; ?>&changerole=<?php echo $administratorss['staffID']; ?>"><i class="fi fi-rr-shuffle btn btn-secondary"></i></a> <?php }?> </td>
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