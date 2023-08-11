<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css">

</head>
<body>
<?php
if (isset($_GET['reset_code']) && $_GET['reset_code'] == 'true' && isset($_SESSION['reset_code'])) {
    echo <<<EOL
        <script>
            Swal.fire({
                toast: true,
                icon: 'success',
            title: 'Email Reset code sent, please check your inbox!',
                showConfirmButton: false,
                timerProgressBar: true,
                position: 'top-end',
                timer: 3500
            }).then(() => {
                window.location.href = 'login-user.php';
            });
        </script>
    EOL;
    unset($_SESSION['reset_code']);
}
?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="reset-code.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-reset-otp" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.20/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>

</body>
</html>