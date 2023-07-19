<?php 
require_once "../controllerUserData.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        $roles = $fetch_info['roles'];
        $id = $fetch_info['usersID'];
        if($status == "verified"){
            if($code != 0){
                header('Location: ../reset-code.php');
            }
        }else{
            header('Location: ../user-otp.php');
        }
        if($roles == 1 ){
            header('Location: ../admin/home.php');
           
        }
        if($roles == 2){
           $rlss = mysqli_query($con,"SELECT * FROM branch_staff WHERE usersID = $id");
           $chroles = mysqli_fetch_array($rlss);
           $designated = $chroles['roles'];
           if($designated == 1){
            header('Location: ../branch/home.php');
           }elseif($designated == 2){
            header('Location: ../inventory/home.php');
           }elseif($designated == 3){
            header('Location: ../staffs/home.php');
           }else{
            $title = "Staff";
           }
        }
    }
}else{
    header('Location: ../login-user.php');
}

//<queries> ----------------------------------------------------------------------------------------------------------
$pr = mysqli_query($con,"SELECT * FROM users WHERE usersID = $id");
$profile = mysqli_fetch_assoc($pr);
if($do != 1){
    if(empty($profile['usersFirstName']) || empty($profile['usersLastName']) || empty($profile['age']) || empty($profile['Address']) || empty($profile['username']) || empty($profile['CellNumber'])){
        echo "<script>alert('Please update your account credentials');window.location.href='profile.php'</script>";
        }
}
date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');
$dateString = $currentDate." ".$currentTime;
$timestamp = strtotime($dateString);
$formattedDate = date('l - F d Y, g:i A', $timestamp);

$adm = mysqli_query($con,"SELECT * FROM users WHERE roles = 1");
$bra = mysqli_query($con,"select users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles, branch_staff.staffID, branches.Branch_Name, branches.branchID from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branch_staff.roles = 1");
$inv = mysqli_query($con,"select users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles, branch_staff.staffID, branches.Branch_Name, branches.branchID from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branch_staff.roles = 2");
$staf = mysqli_query($con,"select users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles,branch_staff.staffID, branches.Branch_Name, branches.branchID  from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branch_staff.roles = 3");
$n_roles = mysqli_query($con,"SELECT * FROM users WHERE roles = 2");
$brc = mysqli_query($con,"SELECT * FROM branches;");
$stt = mysqli_query($con," select * from Settings where SettingsId =1;");
$settings = mysqli_fetch_assoc($stt);
$cardin = mysqli_query($con,"select count(inventory.branchID) as number,inventory.branchID, branches.Branch_Name from inventory  join branches on branches.branchID = inventory.branchID group by branchID");
$inlist = mysqli_query($con," select inventory.inventoryName, inventory.inventoryDesc,inventory.inventoryId, inventory.inventoryQty, branches.Branch_Name ,users.usersFirstName, users.usersLastName from inventory join branches on branches.branchID = inventory.branchID join users on users.usersID = inventory.usersID order by 5;");
        // ->Profile.php ---------------------------------------------------------------------------------------------------
                if(empty($profile['usersFirstName'])){
                $fn = "invalid";
                }else{
                $fn = "valid";
                }
                if(empty($profile['usersLastName'])){
                    $ln = "invalid";
                }else{
                    $ln = "valid";
                }
                if(empty($profile['age'])){
                    $age = "invalid";
                }else{
                    $age = "valid";
                }
                if(empty($profile['Address'])){
                    $add = "invalid";
                }else{
                    $add = "valid";
                }
                if(empty($profile['username'])){
                    $usr = "invalid";
                }else{
                    $usr = "valid";
                }
                if(empty($profile['CellNumber'])){
                    $cln = "invalid";
                }else{
                    $cln = "valid";
                }
                if(isset($_POST['profile'])){
                    if($_FILES['lis_img0']['name']!=''){
                        $lis_img0 = $_FILES['lis_img0']['name'];
                        }
                        else{
                          $lis_img0 = $profile['profile'];
                        }
                        $tempname = $_FILES['lis_img0']['tmp_name'];
                        $folder = "../images/users/".$lis_img0;
                        if(empty($_POST['cover'])){
                            $cover = $profile['cover_photo'];
                        }else{
                            $cover = $_POST['cover'];
                        }
                        
                        $first = $_POST['firstname'];
                        $last = $_POST['lastname'];
                        $age = $_POST['ages'];
                        $address = $_POST['address'];
                        $username = $_POST['username'];
                        $contact = $_POST['controlnumber'];
                            move_uploaded_file($tempname, $folder);
                            $update = mysqli_query($con,"UPDATE users SET profile='$lis_img0',cover_photo = '$cover', usersFirstName='$first', username='$username', usersLastName='$last', age='$age' , Address='$address', CellNumber='$contact' WHERE usersID =$id ");  
                            echo "<script>alert('Update Successfully');window.location.href='profile.php'</script>";
                }
        // Profile.php ---------------------------------------------------------------------------------------------------
        // Check-Profile.php ---------------------------------------------------------------------------------------------------
                        if(isset($_GET['profile'])){
                            $profileid = $_GET['profile'];
                            $s = mysqli_query($con,"SELECT * FROM users WHERE usersID = $profileid");
                            $ckprofile =mysqli_fetch_assoc($s);
                        }
        
        
        // Check-Profile.php ---------------------------------------------------------------------------------------------------
        // Branches.php ---------------------------------------------------------------------------------------------------
        if(isset($_GET['delete'])){
            $delete = $_GET['delete'];
            $brans = mysqli_query($con,"DELETE FROM branches WHERE branchID = $delete");
            echo "<script>alert('Successfully Deleted');window.location.href='branches.php'</script>";
           }
        if(isset($_GET['branch'])){
        $editbranch = $_GET['branch'];
        $brans = mysqli_query($con,"SELECT * FROM branches WHERE branchID = $editbranch");
        $branch = mysqli_fetch_assoc($brans);
        $branchIDD = $branch['branchID'];
       }
        
        if(isset($_POST['createbranch'])){
            if(empty($_POST['branch_name'])){
                $errors['branch_name'] = "Please Provide a Branch Name";
            }else{
                $branch_name = $_POST['branch_name'];
            }

            if(empty($_POST['branch_address'])){
                $errors['branch_address'] = "Please Provide branch address";
            }else{
                $branch_address = $_POST['branch_address'];
            }
            if(empty($_POST['branch_city'])){
                $errors['branch_city'] = "Please Provide branch city";
            }else{
                $branch_city = $_POST['branch_city'];
            }
            if(empty($_POST['branch_number'])){
                $errors['branch_number'] = "Please Provide branch number";
            }else{
                $branch_number = $_POST['branch_number'];
            }
            if(empty($_POST['branch_email'])){
                $errors['branch_email'] = "Please Provide branch email";
            }else{
                $branch_email = $_POST['branch_email'];
            }
            if($editbranch == ""){
                if(count($errors) === 0){
                    $insert = mysqli_query($con,"INSERT INTO branches (usersID, Branch_Name, Branch_Address, city, Branch_Contact_number, branch_email, DateCreated) VALUES($id,'$branch_name','$branch_address','$branch_city','$branch_number','$branch_email','$currentDate')");
                    if($insert){
                        echo "<script>alert('Branch $branch_name Successfully Created');window.location.href='branches.php'</script>";
                    }else {
                        $errors['cant'] = "Cant Save to Database $branch_name";
                    }
                }
            }else{
                if(count($errors) === 0){
                    $insert = mysqli_query($con,"UPDATE branches SET usersID='$id', Branch_Name = '$branch_name', Branch_Address = '$branch_address', city = '$branch_city', Branch_Contact_number = '$branch_number', branch_email  = '$branch_email' WHERE branchID = $editbranch");
                    if($insert){
                        echo "<script>alert('Branch $branch_name Successfully Updated');window.location.href='branches.php'</script>";
                    }else {
                        $errors['cant'] = "Cant Save to Database $branch_name";
                    }
                }
            }
            
        }
        // Branches.php ---------------------------------------------------------------------------------------------------

        if(isset($_POST['addstaff'])){
            $name = mysqli_real_escape_string($con, $_POST['username']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
            if($password !== $cpassword){
                $errors['password'] = "Confirm password not matched!";
            }
            $email_check = "SELECT * FROM users WHERE email = '$email'";
            $res = mysqli_query($con, $email_check);
            if(mysqli_num_rows($res) > 0){
                $errors['email'] = "Email that you have entered is already exist!";
            }
            $usernameck = "SELECT * FROM users WHERE username = '$name'";
            $ress= mysqli_query($con, $usernameck);
            if(mysqli_num_rows($ress) > 0){
                $errors['username'] = "User Name that you have entered is not Available, please create another user name";
            }
            if(count($errors) === 0){
                $encpass = password_hash($password, PASSWORD_BCRYPT);
                $code = rand(999999, 111111);
                $status = "notverified";
                $insert_data = "INSERT INTO users (username, email, password, code, status) values('$name', '$email', '$encpass', '$code', '$status')";
                $data_check = mysqli_query($con, $insert_data);
                if($data_check){
                    $subject = "Congratulations on Becoming the Staff of Fayeed Electronics";
                    $message = "Dear $email, <br>

                    Congratulations on your work @ Fayeed Electronics! We are thrilled to have you as one of the key member of our team.

                    To ensure the security of your account, we have implemented an email verification process. Please find below your one-time password (OTP) code for verification:
                    <hr>
                    OTP Code: <b style='color: orange;'>$code</b><br>
                    Assign Email: <b style='color: orange;'>$email</b><br>
                    Assign Password: <b style='color: orange;'>$password</b><br>
                    <hr>
                    To complete the email verification process, kindly enter the above OTP code on our website. If you did not request this verification or have any concerns, please contact our customer support team immediately.
                    
                    At Fayeed Electronics, we prioritize the safety and privacy of our customers. By verifying your email address, we can enhance the security of your account and provide you with a seamless browsing experience.
                    
                    Thank you for your cooperation.
                    
                    Best regards";
                    if(assignemail($email, $subject, $message)){
                        $info = "We've sent a verification code to your email - $email";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: noroles.php');
                        exit();
                    }else{
                        $errors['otp-error'] = "Failed while sending code!";
                    }
                }else{
                    $errors['db-error'] = "Failed while inserting data into database!";
                }
            }

        }


        if(isset($_POST['addroles'])){

            
            if($_POST['userid'] =="#"){
                $errors['userroles'] = "Please Select user appoint";
            }else{
                $userids = $_POST['userid'];
            }
            if(!isset($_POST['roles'])){
                $errors['ersssror'] = "Please roles to appoint ";
            }else{
                $roles = $_POST['roles'];
            }
            if(count($errors) === 0){

                $insert = mysqli_query($con,"INSERT INTO  branch_staff(branchID,usersID,roles,assigndby) VALUES('$editbranch','$userids','$roles','$id')");
            echo "<script>alert('Appoint Successfully');window.location.href = 'assign-branch.php?branch=$editbranch'</script>";
            }
            
        }


        if(isset($_POST['set1'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $update = mysqli_query($con,"UPDATE Settings SET System_Name='$name', System_Email='$email', System_number='$number' WHERE SettingsId = 1");
            echo "<script>alert('Settings Updated');window.location.href = 'settings.php'</script>";
        }
        if(isset($_POST['set2'])){
            $smtp = $_POST['smtp'];
            $pass = $_POST['pass'];
            $prov = $_POST['prov'];
            $port = $_POST['port'];
            $update = mysqli_query($con,"UPDATE Settings SET Smtp_email='$smtp',Smatp_password='$pass', Smtp_Provider='$prov',Smtp_port='$port' WHERE SettingsId = 1");
            echo "<script>alert('Settings Updated');window.location.href = 'settings.php'</script>";
        }

        if(isset($_GET['editinventory'])){
            $invenID = $_GET['editinventory'];
            $sh = mysqli_query($con,"SELECT * FROM inventory WHERE inventoryId = $invenID");
            $show_ivent = mysqli_fetch_assoc($sh);
        }
        if(isset($_GET['delnventory'])){
            $delin = $_GET['delnventory'];
            $sh = mysqli_query($con,"DELETE FROM inventory WHERE inventoryId = $delin");
            echo "<script>alert('Deleted Inventory Successfully');window.location.href = 'inventorylist.php'</script>";
        }
        if(isset($_POST['addinventory'])){

            if(isset($_POST['branchID'])){
                $branchID = $_POST['branchID'];
            }else{
                if(isset($show_ivent['branchID'])){
                    $branchID = $show_ivent['branchID'];
                }else{
                    $errors['branchID'] = "Please Select Branch for the Item";
                }
                
            }
            
            if(isset($_POST['inventoryname'])){
                $inventoryname = $_POST['inventoryname'];
            }else{
                $errors['inventoryname'] = "Please Insert a inventory Name";
            }

            if(isset($_POST['quanty'])){
                $quanty = $_POST['quanty'];
            }else{
                $errors['quanty'] = "Please Insert a inventory quanty";
            }

            if(isset($_POST['description'])){
                $description = $_POST['description'];
            }else{
                $errors['description'] = "Please Insert a inventory description";
            }

            if(count($errors) === 0){
                if($invenID == ""){
                    $insert = mysqli_query($con,"INSERT INTO inventory(usersID,branchID,inventoryName,inventoryDesc,inventoryQty) VALUES ('$id','$branchID','$inventoryname','$description','$quanty')");
                    echo "<script>alert('Done Save');window.location.href='add-inventory.php'</script>";
                }else{
                    $insert = mysqli_query($con,"UPDATE inventory SET inventoryName = '$inventoryname', inventoryDesc = '$description', inventoryQty = '$quanty' WHERE inventoryId = $invenID");
                    if($insert){
                        echo "<script>alert('Update Successfully');window.location.href='inventorylist.php'</script>";
                    }else{
                        echo "<script>alert('No Update');window.location.href='inventorylist.php'</script>";
                    }
                    
                }
                
            }
        }

        if(isset($_GET['disrole'])){
            $disroleId = $_GET['disrole'];
            $derole = mysqli_query($con,"DELETE FROM branch_staff WHERE staffID = $disroleId ;");
            echo "<script>alert('The User Disrole Succesfully');window.location.href='noroles.php'</script>";
        }

        if(isset($_GET['changerole'])){
            $rolechange = $_GET['changerole'];
            $chang = mysqli_query($con,"SELECT * FROM branch_staff WHERE staffID = $rolechange");
            $change = mysqli_fetch_assoc($chang);
            $brnjID = $change['branchID'];
            if($change['roles'] == 1){
                $update = mysqli_query($con,"UPDATE branch_staff SET roles = 2  WHERE staffID = $rolechange");
                echo "<script>alert('Role Set to Inventory Admin');window.location.href='detail-branch.php?branch=$brnjID'</script>";
            }elseif($change['roles'] == 2){
                $update = mysqli_query($con,"UPDATE branch_staff SET roles = 3  WHERE staffID = $rolechange");
                echo "<script>alert('Role Set to Staff');window.location.href='detail-branch.php?branch=$brnjID'</script>";
            }elseif($change['roles'] == 3){
                $update = mysqli_query($con,"UPDATE branch_staff SET roles = 1  WHERE staffID = $rolechange");
                echo "<script>alert('Role Set to Branch Maniger');window.location.href='detail-branch.php?branch=$brnjID'</script>";
            }
            
        }

        //</queries> ----------------------------------------------------------------------------------------------------------



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $settings['System_Name']?></title>
   
    <link rel="icon" type="image/png" sizes="16x16" href="../images/site/fayeed.png">
    <link rel="stylesheet" href="../vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="../vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
