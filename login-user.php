<?php require_once "controllerUserData.php";
$set =mysqli_query($con,"SELECT * FROM settings;");
$settings = mysqli_fetch_assoc($set); ?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $settings['System_Name']?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="./images/site/fayeed.png">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container-fluid h-100 bg-dark">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                <h2 class="text-center"><?php echo $settings['System_Name']?></h2>
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

</body>

</html>