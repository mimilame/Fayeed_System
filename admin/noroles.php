<?php include 'head.php';
    if(isset($_GET['deletexx'])){
        $del = $_GET['deletexx'];
        $dell = mysqli_query($con,"DELETE from users WHERE usersID = $del");
        echo $_SESSION['delete_user'] = true;
        header("Location: noroles.php?delete_user=1");
    }

    if (isset($_GET['delete_user']) && $_GET['delete_user'] == '1' && isset($_SESSION['delete_user'])) {
        echo <<<EOL
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Deleted Successfully!',
                    showConfirmButton: false,
                    position: 'top-end',
                    timerProgressBar: true,
                    timer: 5000
                }).then(() => {
                    window.location.href = 'noroles.php';
                });
            </script>
        EOL;
        unset($_SESSION['delete_user']);
    } if (isset($_GET['add_user']) && $_GET['add_user'] == '2' && isset($_SESSION['add_user'])) {
        echo <<<EOL
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Deleted Successfully!',
                    showConfirmButton: false,
                    position: 'top-end',
                    timerProgressBar: true,
                    timer: 5000
                }).then(() => {
                    window.location.href = 'noroles.php';
                });
            </script>
        EOL;
        unset($_SESSION['add_user']);
    }
    if ($deletionSuccessful) {
        $_SESSION['disrole'] = true;

        echo <<<EOL
            <script>
                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'User successfully Disroled!',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    position: 'top-end',
                    timer: 5000
                }).then(() => {
                    // Redirect back to the appropriate page based on the 'page' parameter
                    const urlParams = new URLSearchParams(window.location.search);
                    const page = urlParams.get('page');
                    window.location.href = page;
                });
            </script>
        EOL;
        unset($_SESSION['disrole']);
    }


?>

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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>No Roles</h4> <a href="add-branchmaniger.php" class="btn btn-primary">Add User</a>
                            </div>
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php while($administratorss = mysqli_fetch_array($n_roles)){
                                                $chjk = mysqli_query($con,"select usersID from branch_staff where usersID = '".$administratorss['usersID']."'");
                                                $checksss = mysqli_fetch_assoc($chjk);
                                                if($checksss['usersID'] != $administratorss['usersID']){ ?>
                                            <tr>
                                                <td></td>
                                                <td><?php if($administratorss['usersFirstName']==""){ echo ".........";}else{echo $administratorss['usersFirstName'];}?></td>
                                                <td><?php if($administratorss['usersLastName']==""){ echo ".........";}else{echo $administratorss['usersLastName'];}?></td>
                                                <td><?php if($administratorss['Address']==""){ echo ".........";}else{echo $administratorss['Address'];}?></td>
                                                <td><?php if($administratorss['email']==""){ echo ".........";}else{echo $administratorss['email'];}?></td>
                                                <td><?php if($administratorss['CellNumber']==""){ echo ".........";}else{echo $administratorss['CellNumber'];}?></td>
                                                <td><a href="check-profile.php?profile=<?php echo $administratorss['usersID']?>"><i class="fi fi-rr-user btn btn-primary"></i></a> <a href="#" onclick="showDeleteConfirmation(<?php echo $administratorss['usersID']; ?>)">
                                                    <i class="fi fi-rr-trash-xmark btn btn-danger"></i>
                                                </a></td>
                                            </tr>
                                                <?php }
                                            }
                                            ?>


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


    <script>
    function showDeleteConfirmation(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this. Are you sure you want to delete this user?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, redirect to the delete page
                window.location.href = `noroles.php?deletexx=${userId}`;
            }
        });
    }
    </script>
</body>
</html>