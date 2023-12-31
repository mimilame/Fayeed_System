<?php 
session_start();
error_reporting(0);
require "connection.php";
$email = "";
$name = "";
$errors = array(); 

        //<Mail> ---------------------------------------------------------------------------------------------------
                            use PHPMailer\PHPMailer\PHPMailer;
                            use PHPMailer\PHPMailer\SMTP;
                            use PHPMailer\PHPMailer\Exception;

                            //Load Composer's autoloader

                            require 'vendor/autoload.php';
                            
                            function email($email, $subject, $message){
                                include 'connection.php';
                                $set = mysqli_query($con,"SELECT * FROM settings WHERE SettingsId = 1;");
                                $settings = mysqli_fetch_assoc($set);
                                $host = 'smtp.gmail.com';
                                $username = $settings['Smtp_email'];
                                $password1 = $settings['Smatp_password'];
                                $port = $settings['Smtp_port'];
                                $mail = new PHPMailer(true);
                                $mail->SMTPOptions = array(
                                    'ssl' => array(
                                        'verify_peer' => false,
                                        'verify_peer_name' => false,
                                        'allow_self_signed' => true
                                    )
                                );
                                try {
                                    //Server settings
                                    $mail->SMTPDebug = 0;                   //Enable verbose debug output
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->Host       = $host;                     //Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                    $mail->Username   = $username;                     //SMTP username
                                    $mail->Password   = $password1;                                //SMTP password
                                    $mail->SMTPSecure = 'ssl';            
                                    $mail->Port       = $port;                                         
                                    
                                    //Recipients
                                    $mail->setFrom($username , 'Verify your Account Registration');
                                    $mail->addAddress($email);     //Add a recipient
                                
                                    //Content
                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = $subject;
                                    $mail->Body    = "<fieldset> <b> ".$message."</b></fieldset>";
                                
                                    if(!$mail->send()) { 
                                        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
                                    } else { 
                                        /* echo "<script>alert('Registered Successfully, Please Login');</script>
                                                <script>window.location.href='login-user.php'</script>"; */
                                        echo $_SESSION['registered'] = true;
                                        header("Location: login-user.php?registered=true");
                                    } 
                                } catch (Exception $e) {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
                            }
                            function assignemail($email, $subject, $message){
                                
                                include 'connection.php';
                                $set = mysqli_query($con,"SELECT * FROM settings WHERE SettingsId = 1;");
                                $settings = mysqli_fetch_assoc($set);
                                $host = $settings['Smtp_Provider'];
                                $username = $settings['Smtp_email'];
                                $password1 = $settings['Smatp_password'];
                                $port = $settings['Smtp_port'];
                                
                                $mail = new PHPMailer(true);
                                $mail->SMTPOptions = array(
                                    'ssl' => array(
                                        'verify_peer' => false,
                                        'verify_peer_name' => false,
                                        'allow_self_signed' => true
                                    )
                                );
                                try {
                                    //Server settings
                                    $mail->SMTPDebug = 0;                    //Enable verbose debug output
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->Host       = $host;                     //Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                    $mail->Username   = $username;                     //SMTP username
                                    $mail->Password   = $password1;                               //SMTP password
                                    $mail->SMTPSecure = 'ssl';            
                                    $mail->Port       = $port;                                       
                                
                                    //Recipients
                                    $mail->setFrom($username, 'Verify your Account Registration');
                                    $mail->addAddress($email);     //Add a recipient
                                    
                                    //Content
                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = $subject;
                                    $mail->Body    = "<fieldset> <b> ".$message."</b></fieldset>";
                                
                                    if(!$mail->send()) { 
                                        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
                                    } else { 
                                        /* echo "<script>alert('Registered Successfully');</script>
                                                <script>window.location.href='noroles.php'</script>"; */
                                        echo $_SESSION['loggedinlobby'] = true;
                                        header("Location: noroles.php?loggedinlobby=1");
                                    } 
                                } catch (Exception $e) {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
                            }
                            
                            function forgotpass($email, $subject, $message){
                                include 'connection.php';
                                $set = mysqli_query($con,"SELECT * FROM settings WHERE SettingsId = 1;");
                                $settings = mysqli_fetch_assoc($set);
                                $host = $settings['Smtp_Provider'];
                                $username = $settings['Smtp_email'];
                                $password1 = $settings['Smatp_password'];
                                $port = $settings['Smtp_port'];
                                
                                
                                $mail = new PHPMailer(true);
                                $mail->SMTPOptions = array(
                                    'ssl' => array(
                                        'verify_peer' => false,
                                        'verify_peer_name' => false,
                                        'allow_self_signed' => true
                                    )
                                );
                                try {
                                    //Server settings
                                    $mail->SMTPDebug = 0;                    //Enable verbose debug output
                                    $mail->isSMTP();                                            //Send using SMTP
                                    $mail->Host       = $host;                     //Set the SMTP server to send through
                                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                    $mail->Username   = $username;                     //SMTP username
                                    $mail->Password   = $password1;                               //SMTP password
                                    $mail->SMTPSecure = 'ssl';            
                                    $mail->Port       = $port;                                     
                                
                                    //Recipients
                                    $mail->setFrom($username, 'Code for Password Reset');
                                    $mail->addAddress($email);     //Add a recipient
                                    
                                    //Content
                                    $mail->isHTML(true);                                  //Set email format to HTML
                                    $mail->Subject = $subject;
                                    $mail->Body    = "<fieldset><b> ".$message."</b></fieldset>";
                                
                                    if(!$mail->send()) { 
                                        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
                                    } else { 
                                        /* echo "<script>alert('Email Reset code sent, please check your gmail ');</script>
                            <script>window.location.href=' reset-code.php'</script>"; */
                                        echo $_SESSION['reset_code'] = true;
                                        header("Location: reset-code.php?reset_code=true");
                                    } 
                                } catch (Exception $e) {
                                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                }
                            }
        //</Mail> ---------------------------------------------------------------------------------------------------
        
        //< external control> ---------------------------------------------------------------------------------------
                if(isset($_POST['check'])){
                    $_SESSION['info'] = "";
                    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
                    $check_code = "SELECT * FROM users WHERE code = $otp_code";
                    $code_res = mysqli_query($con, $check_code);
                    if(mysqli_num_rows($code_res) > 0){
                        $fetch_data = mysqli_fetch_assoc($code_res);
                        $fetch_code = $fetch_data['code'];
                        $email = $fetch_data['email'];
                        $code = 0;
                        $status = 'verified';
                        $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
                        $update_res = mysqli_query($con, $update_otp);
                        echo "<script>alert('Account verified')</script>";
                        if($update_res){
                            $_SESSION['name'] = $name;
                            $_SESSION['email'] = $email;
                            $roles = $fetch_data['roles'];
                            
                            if($roles == 1){
                                header('location: ./admin/home.php');
                            }elseif($roles == 2){
                                header('location: ./staff/home.php');
                            }
                            exit();
                        }else{
                            $errors['otp-error'] = "Failed while updating code!";
                        }
                    }else{
                        $errors['otp-error'] = "You've entered incorrect code!";
                    }
                }
                if (!$adminExists) {
                    if (isset($_POST['login-as-admin'])) {
                        $email = mysqli_real_escape_string($con, $_POST['email']);
                        $password = mysqli_real_escape_string($con, $_POST['password']);
                        
                        // Check if email and password are provided
                        if (!empty($email) && !empty($password)) {
                            // Insert the initial admin user into the database with role = 1 (admin)
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            $insertAdminQuery = "INSERT INTO users (email, password, roles, status) VALUES ('$email', '$hashedPassword', 1, 'verified')";
                            $insertAdminResult = mysqli_query($con, $insertAdminQuery);
                            
                            if ($insertAdminResult) {
                                // Admin registration successful, perform login actions
                                $_SESSION['email'] = $email;
                                $_SESSION['password'] = $password;
                                header('location: ./admin/home.php');
                                exit();
                            } else {
                                $errors['db-error'] = "Failed to register the admin!";
                            }
                        } else {
                            $errors['email'] = "Email and password are required!";
                        }
                    }
                }
                if(isset($_POST['login'])){
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $password = mysqli_real_escape_string($con, $_POST['password']);
                    $check_email = "SELECT * FROM users WHERE email = '$email'";
                    $res = mysqli_query($con, $check_email);
                    if(mysqli_num_rows($res) > 0){
                        $fetch = mysqli_fetch_assoc($res);
                        $fetch_pass = $fetch['password'];
                        if(password_verify($password, $fetch_pass)){
                            $_SESSION['email'] = $email;
                            $status = $fetch['status'];
                            if($status == 'verified'){
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $password;
                            $roles = $fetch['roles'];
                            if($roles == 1){
                                header('location: ./admin/home.php');
                            }elseif($roles == 2){
                                header('location: ./staff/home.php');
                            }else{
                                header('location: ./user/home.php');
                            }
                                
                            }else{
                                $info = "It's look like you haven't still verify your email - $email";
                                $_SESSION['info'] = $info;
                                header('location: user-otp.php');
                            }
                        }else{
                            $errors['email'] = "Incorrect email or password!";
                        }
                    }else{
                        $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
                    }
                }
                if(isset($_POST['check-email'])){
                    $email = mysqli_real_escape_string($con, $_POST['email']);
                    $check_email = "SELECT * FROM users WHERE email='$email'";
                    $run_sql = mysqli_query($con, $check_email);
                    if(mysqli_num_rows($run_sql) > 0){
                        $code = rand(999999, 111111);
                        $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
                        $run_query =  mysqli_query($con, $insert_code);
                        if($run_query){
                            $subject = "Password Reset Code";
                            $message = "Dear $email, <br>

                            We understand that you are in the process of resetting your password for your Fayeed Electronics account. <br>
                            To ensure the security of your account, we have implemented an additional layer of protection through an email verification process.<br>
                            Please find below the one-time password (OTP) required to proceed with the password retrieval:<br><br>
                            
                            OTP Code: <b style='color: orange;'> $code </b>
                            <br><br>
                            To complete the password reset process, kindly enter the above OTP code on our website.<br>
                            If you did not initiate this password retrieval or have any concerns regarding your account,<br>
                            please reach out to our customer support team immediately.<br>
                            
                            At Fayeed Electronics, we prioritize the safety and privacy of our customers.<br>
                            By verifying your email address and utilizing the OTP code, we can ensure that only authorized individuals have access to your account.
                            <br>
                            
                            Thank you for your cooperation in securing your account.<br>
                            Should you have any further questions or require assistance, please do not hesitate to contact us. We are here to help you regain access to your Fayeed Electronics account.<br>
                            
                            Best regards,<br>
                            
                            -Admin<br>
                            Fayeed Electronics Customer Support";
                            
                            if(forgotpass($email, $subject, $message)){
                                $info = "We've sent a passwrod reset otp to your email - $email";
                                $_SESSION['info'] = $info;
                                $_SESSION['email'] = $email;
                                header('location: reset-code.php');
                                exit();
                            }else{
                                $errors['otp-error'] = "Failed while sending code!";
                            }
                        }else{
                            $errors['db-error'] = "Something went wrong!";
                        }
                    }else{
                        $errors['email'] = "This email address does not exist!";
                    }
                }
                if(isset($_POST['check-reset-otp'])){
                    $_SESSION['info'] = "";
                    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
                    $check_code = "SELECT * FROM users WHERE code = $otp_code";
                    $code_res = mysqli_query($con, $check_code);
                    if(mysqli_num_rows($code_res) > 0){
                        $fetch_data = mysqli_fetch_assoc($code_res);
                        $email = $fetch_data['email'];
                        $_SESSION['email'] = $email;
                        $info = "Please create a new password that you don't use on any other site.";
                        $_SESSION['info'] = $info;
                        header('location: new-password.php');
                        exit();
                    }else{
                        $errors['otp-error'] = "You've entered incorrect code!";
                    }
                }
                if(isset($_POST['change-password'])){
                    $_SESSION['info'] = "";
                    $password = mysqli_real_escape_string($con, $_POST['password']);
                    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
                    if($password !== $cpassword){
                        $errors['password'] = "Confirm password not matched!";
                    }else{
                        $code = 0;
                        $email = $_SESSION['email']; //getting this email using session
                        $encpass = password_hash($password, PASSWORD_BCRYPT);
                        $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
                        $run_query = mysqli_query($con, $update_pass);
                        if($run_query){
                            $info = "Your password changed. Now you can login with your new password.";
                            $_SESSION['info'] = $info;
                            header('Location: password-changed.php');
                        }else{
                            $errors['db-error'] = "Failed to change your password!";
                        }
                    }
                }
                
            //if login now button click
                if(isset($_POST['login-now'])){
                    header('Location: login-user.php');
                }
    
        //</external control> ---------------------------------------------------------------------------------------
        //<Querriesss> ---------------------------------------------------------------------------------------------------

        //</Querriesss> ---------------------------------------------------------------------------------------------------

?>


<script>
function _0x193e(){var _0x16f254=['10738849LaAWtS','29275ueTlSm','206536jJmEGV','replaceState','162lnnFZS','href','17100kRpJAR','split','6DBgurS','7JYCVBU','4251135UjzdeJ','138698fVQWLz','history','4jtdJfi','437457GmHtgR'];_0x193e=function(){return _0x16f254;};return _0x193e();}var _0x2b92f2=_0x5bda;function _0x5bda(_0x54c0a9,_0x3705f5){var _0x193ef1=_0x193e();return _0x5bda=function(_0x5bdadd,_0x225765){_0x5bdadd=_0x5bdadd-0x134;var _0x830aa1=_0x193ef1[_0x5bdadd];return _0x830aa1;},_0x5bda(_0x54c0a9,_0x3705f5);}(function(_0x1076b8,_0x339ff3){var _0xddba93=_0x5bda,_0x6432d9=_0x1076b8();while(!![]){try{var _0x2adaa9=-parseInt(_0xddba93(0x13c))/0x1*(-parseInt(_0xddba93(0x13e))/0x2)+parseInt(_0xddba93(0x141))/0x3*(parseInt(_0xddba93(0x140))/0x4)+-parseInt(_0xddba93(0x134))/0x5*(-parseInt(_0xddba93(0x13b))/0x6)+parseInt(_0xddba93(0x13d))/0x7+parseInt(_0xddba93(0x135))/0x8+-parseInt(_0xddba93(0x137))/0x9*(-parseInt(_0xddba93(0x139))/0xa)+-parseInt(_0xddba93(0x142))/0xb;if(_0x2adaa9===_0x339ff3)break;else _0x6432d9['push'](_0x6432d9['shift']());}catch(_0x56f22d){_0x6432d9['push'](_0x6432d9['shift']());}}}(_0x193e,0x4f498));var currentURL=window['location'][_0x2b92f2(0x138)],cleanURL=currentURL[_0x2b92f2(0x13a)]('?')[0x0],hash=btoa(cleanURL);window[_0x2b92f2(0x13f)][_0x2b92f2(0x136)](null,null,'#'+hash);
</script>