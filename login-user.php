<?php require_once "controllerUserData.php";
$set =mysqli_query($con,"SELECT * FROM settings;");
$settings = mysqli_fetch_assoc($set); 
// Check if there are any admin users
$adminCheckQuery = "SELECT * FROM users WHERE roles = 1";
$adminCheckResult = mysqli_query($con, $adminCheckQuery);
$adminExists = mysqli_num_rows($adminCheckResult) > 0;
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $settings['System_Name']?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="./images/site/fayeed.png">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css">
</head>

<body class="h-100">
<?php
if (isset($_GET['registered']) && $_GET['registered'] == 'true' && isset($_SESSION['registered'])) {
    echo <<<EOL
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
                title: 'Registered Successfully, Please Login!',
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-end',
                timer: 3500
            }).then(() => {
                window.location.href = 'login-user.php';
            });
        </script>
    EOL;
    unset($_SESSION['registered']);
}
?>
    <div class="authincation h-100">
        <div class="container-fluid h-100 bg-dark">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                <h2 class="text-center"><?php echo $settings['System_Name']?></h2>
                                <?php if (!$adminExists) { ?>
                                    <h4 class="text-center mb-4"><b>Login</b> as New Administrator</h4>

                                    <?php if(count($errors) > 0){ ?>
                                            <div class="alert alert-danger text-center">
                                                <?php foreach($errors as $showerror){
                                                            echo $showerror;
                                                    }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    <form action="login-user.php" method="POST" autocomplete="">
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">

                                            <div class="form-group">
                                                <a href="forgot-password.php">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block fs-100" name="login-as-admin">Register Admin</button>
                                        </div>
                                    </form>
                                <?php } else { ?>
                                    <p class="text-center mb-4"><b>Login</b> with your registered credentials</p>

                                    <?php if(count($errors) > 0){ ?>
                                            <div class="alert alert-danger text-center">
                                                <?php foreach($errors as $showerror){
                                                            echo $showerror;
                                                    }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                    ?>
                                    <form action="login-user.php" method="POST" autocomplete="">
                                        <div class="form-group">
                                            <label><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">

                                            <div class="form-group">
                                                <a href="forgot-password.php">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block fs-100" name="login" value="Login">Sign me in</button>
                                        </div>
                                    </form>
                                
                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.20/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
</body>

</html>