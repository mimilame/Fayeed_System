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
            $title = "System Administrator";
        }
        if($roles == 2){
            $rlss = mysqli_query($con,"SELECT * FROM branch_staff WHERE usersID = $id");
           $chroles = mysqli_fetch_array($rlss);
           $designated = $chroles['roles'];
           $desigbranch = $chroles['branchID'];
           if($designated == 1){
            header('Location: ../branch/home.php');
           }elseif($designated == 2){
            header('Location: ../inventory/home.php');
           }elseif($designated == 3){
            header('Location: ../staffs/home.php');
           }else{
            header('Location: ../staff/home.php');
           }
        }
        if($roles == 3){
            header('Location: ../user/home.php');
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
$currentDatetransaction = date('F j, Y');
$currentDate = date('Y-m-d');
$mmmmnthh = date('F');
$transayear = date('Y');
$currentTime = date('H:i:s');
$dateString = $currentDate." ".$currentTime;
$timestamp = strtotime($dateString);
$formattedDate = date('l - F d Y, g:i A', $timestamp);
$adm = mysqli_query($con,"SELECT * FROM users WHERE roles = 1");
$bra = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles, branch_staff.staffID, branches.Branch_Name, branches.branchID from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branch_staff.roles = 1");
$inv = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles, branch_staff.staffID, branches.Branch_Name, branches.branchID from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branch_staff.roles = 2");
$staf = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles,branch_staff.staffID, branches.Branch_Name, branches.branchID  from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branch_staff.roles = 3");
$n_roles = mysqli_query($con,"SELECT * FROM users WHERE roles = 2");
$brc = mysqli_query($con,"SELECT * FROM branches;");
$stt = mysqli_query($con,"SELECT * from settings where SettingsId = 1");
$settings = mysqli_fetch_array($stt);
$cardin = mysqli_query($con,"SELECT count(inventory.branchID) as number,inventory.branchID, branches.Branch_Name from inventory  join branches on branches.branchID = inventory.branchID group by branchID");
$inlist = mysqli_query($con," SELECT inventory.price,inventory.product_code,inventory.inventoryName, inventory.inventoryDesc,inventory.inventoryId, inventory.inventoryQty, branches.Branch_Name ,users.usersFirstName, users.usersLastName from inventory join branches on branches.branchID = inventory.branchID join users on users.usersID = inventory.usersID order by 5;");
$assemlist = mysqli_query($con,"SELECT assembly.assemblyName,assembly.assemblyStatus,inventory.inventoryName,branches.Branch_Name,assembly.assemblyQuatty ,assembly.assemblyID from assembly join inventory on inventory.inventoryId = assembly.inventoryId join branches on branches.branchID = assembly.branchID;");
$imvto = mysqli_query($con,"SELECT COUNT(inventoryId) inventory FROM inventory;");
$innventory = mysqli_fetch_assoc($imvto);
$currentDatetransaction = date('F j, Y');
$ckatt = mysqli_query($con,"SELECT attendance.confirm,attendance.attendanceID,attendance.enrtypic, attendance.dtrdate,users.usersFirstName, users.usersLastName, branches.Branch_Name, attendance.morning_in, attendance.morning_out, attendance.afternoon_in, attendance.afternoon_out from attendance join users on users.usersID = attendance.usersID join branches on branches.branchID = attendance.branchID WHERE attendance.enrtypic != 'hourglass.gif'  AND attendance.dtrdate = '$currentDatetransaction'");
$pols = mysqli_query($con,"SELECT count(*) total from attendance WHERE confirm = 0 AND dtrdate ='$currentDatetransaction'");
$pulse = mysqli_fetch_assoc($pols);
$brcc = mysqli_query($con,"SELECT count(branchID) branch from branches");
$bbranch = mysqli_fetch_assoc($brcc);

$tres = mysqli_query($con,"SELECT COUNT(*) present FROM Attendance WHERE morning_in != '0' and morning_in != 'Absent' AND dtrdate  = '$currentDatetransaction '");
$present = mysqli_fetch_assoc($tres);

$sttaf = mysqli_query($con,"SELECT COUNT(usersID) staffs FROM branch_staff");
$sttafss = mysqli_fetch_assoc($sttaf);

$assm = mysqli_query($con,"SELECT SUM(assemblyQuatty) Assemble_Total FROM assembly WHERE assemblyStatus = 'Finished'");
$Assembly = mysqli_fetch_assoc($assm);

$invc = mysqli_query($con,"SELECT SUM(amount_payment) Total FROM checkout WHERE date like '$mmmmnthh %'  AND year = '$transayear'");
$income = mysqli_fetch_assoc($invc);


$absencesQuery = mysqli_query($con, "SELECT COUNT(absent) AS absences FROM attendance WHERE absent = 1 AND
MONTH(STR_TO_DATE(dtrdate, '%M %e, %Y')) <= DATE_SUB(CURDATE(), INTERVAL 3 MONTH);");

// Fetch the result as an associative array
$absencesResult = mysqli_fetch_assoc($absencesQuery);

// Get the count of absences
$absencesCount = $absencesResult['absences'];

$latesQuery = mysqli_query($con, "SELECT COUNT(*) AS lates FROM attendance WHERE 
(morning_in LIKE '%Late%' OR morning_out LIKE '%Late%' OR afternoon_in LIKE '%Late%' OR afternoon_out LIKE '%Late%')
AND dtrdate <= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)");

// Fetch the result as an associative array
$latesResult = mysqli_fetch_assoc($latesQuery);

// Get the count of lates
$latesCount = $latesResult['lates'];

$afsent = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, branches.Branch_Name FROM attendance join users on users.usersID = attendance.usersID join branches on branches.branchID = attendance.branchID  WHERE attendance.absent =1 and dtrdate = '$currentDatetransaction'");

$cprocontrol = $settings['product_control'];
$alertprof = mysqli_query($con,"SELECT COUNT(*) total_arlert FROM inventory WHERE inventoryQty < $cprocontrol;");
$alertprd = mysqli_fetch_assoc($alertprof);
$logss = mysqli_query($con,"SELECT users.usersFirstName,users.usersLastName, branches.Branch_Name ,Logs.Activity ,Logs.date,Logs.time FROM Logs join users on users.usersID = Logs.usersID join branches on branches.branchID = Logs.branchID ORDER BY Logs.LogsID DESC ");
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
                    System Link to Log in: <a style='color: orange;' href='".$settings['System_link']."/login-user.php'>".$settings['System_link']."/login-user.php</a><br>
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


        if (isset($_POST['set1'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $update = mysqli_query($con, "UPDATE Settings SET System_Name='$name', System_Email='$email', System_number='$number' WHERE SettingsId = 1");
            if ($update) {
               echo "<script>alert('System Update Successfully');window.location.href = 'settings.php'</script>";
            } else {
               echo "<script>alert('Error Database');window.location.href = 'settings.php'</script>";
            }
        }

        if(isset($_POST['set2'])){
            $smtp = $_POST['smtp'];
            $pass = $_POST['pass'];
            $prov = $_POST['prov'];
            $port = $_POST['port'];
            $System_link = $_POST['System_link'];
            $update = mysqli_query($con,"UPDATE Settings SET Smtp_email='$smtp',Smatp_password='$pass', Smtp_Provider='$prov',Smtp_port='$port', System_link = '$System_link' WHERE SettingsId = 1");
            echo "<script>alert('Settings Updated');window.location.href = 'settings.php'</script>";
        }
        if(isset($_POST['set3'])){
            $limit = $_POST['limit'];
            $update = mysqli_query($con,"UPDATE Settings SET product_control='$limit' WHERE SettingsId = 1");
            echo "<script>alert('Settings Updated');window.location.href = 'settings.php'</script>";
        }

        if(isset($_POST['set4'])){
            $morning = $_POST['morning'];
            $afternoon = $_POST['afternoon'];
            $update = mysqli_query($con,"UPDATE Settings SET latetimein_morning='$morning', latetimein_afternoon='$afternoon' WHERE SettingsId = 1");
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
            if(isset($_POST['code'])){
                $codex = strtoupper($_POST['code']);
                if($show_ivent['product_code'] == $codex){
                    $code = strtoupper($_POST['code']);
                }else{
                    $chkprojk = mysqli_query($con,"SELECT * FROM inventory WHERE product_code = '$codex'");
                    if(mysqli_num_rows($chkprojk) > 0){
                        $errors['code'] = "The Code \" $codex \" is Already Used by other Inventory. <br> Please insert another code.";
                    }else{
                        $code = strtoupper($_POST['code']);
                    }
                }

            }else{
                $errors['code'] = "Please Insert a inventory code";
            }

            if(isset($_POST['quanty'])){
                $quanty = $_POST['quanty'];
            }else{
                $errors['quanty'] = "Please Insert a inventory quantity";
            }

            if(isset($_POST['prize'])){
                $prize = $_POST['prize'];
            }else{
                $errors['prize'] = "Please Insert a Inventory Prize";
            }

            if(isset($_POST['description'])){
                $description = $_POST['description'];
            }else{
                $errors['description'] = "Please Insert a inventory description";
            }

            if(count($errors) === 0){
                if($invenID == ""){
                    $insert = mysqli_query($con,"INSERT INTO inventory(usersID,branchID,inventoryName,inventoryDesc,inventoryQty, product_code,price) VALUES ('$id','$branchID','$inventoryname','$description','$quanty','$code','$prize')");
                    echo "<script>alert('Done Save');window.location.href='add-inventory.php'</script>";
                }else{
                    $insert = mysqli_query($con,"UPDATE inventory SET inventoryName = '$inventoryname', inventoryDesc = '$description', inventoryQty = '$quanty', product_code='$code', price = '$prize' WHERE inventoryId = $invenID");
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

        $attengg = mysqli_query($con,"SELECT users.usersFirstName ,users.usersLastName,users.email,users.usersID,users.CellNumber,branches.Branch_Name from attendance join users on attendance.usersID = users.usersID join branches on branches.branchID = attendance.branchID GROUP BY 4;");

        if(isset($_GET['dtr'])){
            $dtrID = $_GET['dtr'];
            $dtttrr = mysqli_query($con,"SELECT users.usersFirstName ,users.usersLastName,users.email,users.CellNumber,branches.Branch_Name,attendance.dtrdate,attendance.morning_in , attendance.morning_out , attendance.afternoon_in ,attendance.afternoon_out from attendance join users on attendance.usersID = users.usersID join branches on branches.branchID = attendance.branchID WHERE attendance.usersID = $dtrID;");
            $mysqli = mysqli_query($con,"SELECT users.usersFirstName ,users.usersLastName,users.email,users.usersID,users.CellNumber,branches.Branch_Name from attendance join users on attendance.usersID = users.usersID join branches on branches.branchID = attendance.branchID WHERE attendance.usersID = $dtrID GROUP BY 4;");
            $titll = mysqli_fetch_assoc($mysqli);

            $titlesssss = "Name : ".$titll['usersFirstName']." ".$titll['usersLastName']." - Branch : ".$titll['Branch_Name']." - Contact : ".$titll['CellNumber']." - Email : ".$titll['email'];

        }

        if(isset($_GET['check_attendance'])){
            $attenID = $_GET['check_attendance'];
            $atyt = mysqli_query($con,"SELECT attendance.attendanceID,attendance.enrtypic, attendance.dtrdate,attendance.confirm,users.usersFirstName, users.usersLastName, branches.Branch_Name, attendance.morning_in, attendance.morning_out, attendance.afternoon_in, attendance.afternoon_out from attendance join users on users.usersID = attendance.usersID join branches on branches.branchID = attendance.branchID WHERE attendance.attendanceID = $attenID");
            $attendance = mysqli_fetch_assoc($atyt);
        }

        if(isset($_GET['validate_attendance'])){
            $attenID = $_GET['validate_attendance'];
            $attval = mysqli_query($con,"UPDATE attendance SET confirm = 1 WHERE attendanceID = $attenID");
            if($attval){
                echo "<script>alert('Validate Attendance');window.location.href='target-attendance.php?check_attendance=$attenID'</script>";
            }else{
                $errors['att'] = "Can't Validate that Attendance, Please Try Again Later";
            }

        }

        if(isset($_GET['setzero'])){
            $update1 = mysqli_query($con,"UPDATE attendance SET morning_in  = 'Absent' WHERE morning_in = 0");
            $update2 = mysqli_query($con,"UPDATE attendance SET morning_out  = 'Absent' WHERE morning_out = 0");
            $update3 = mysqli_query($con,"UPDATE attendance SET afternoon_in  = 'Absent' WHERE afternoon_in = 0");
            $update4 = mysqli_query($con,"UPDATE attendance SET afternoon_out  = 'Absent' WHERE afternoon_out = 0");
            $update5 = mysqli_query($con,"UPDATE attendance SET absent = 1 WHERE morning_in = 'Absent' AND morning_out = 'Absent'  AND afternoon_in = 'Absent' AND afternoon_out = 'Absent'");
            echo "<script>alert('All Set');;window.location.href='attandance.php'</script>";
        }


        if(isset($_POST['shoyear'])){
            $transayear = $_POST['yearc'];
            $sql = "SELECT month, SUM(amount_payment) AS Total FROM checkout WHERE year = '$transayear' GROUP BY month";
        }else{
            $sql = "SELECT month, SUM(amount_payment) AS Total FROM checkout WHERE year = '$transayear' GROUP BY month";
        }


        //-------Line Graph for admin
        $assemqYearly = mysqli_query($con, "SELECT YEAR(added) AS date_group, COUNT(*) AS finished_count FROM assembly WHERE assemblyStatus = 'Finished' GROUP BY YEAR(added) ORDER BY YEAR(added)");

        $dataFinishedAssembliesYearly = array();

        while ($rowYearly = mysqli_fetch_assoc($assemqYearly)) {
            $dataFinishedAssembliesYearly[] = array('date_group' => $rowYearly['date_group'], 'finished_assemblies' => $rowYearly['finished_count']);
        }

        $invcYearly = mysqli_query($con, "SELECT year(STR_TO_DATE(date, '%M %e, %Y')) AS date_group, SUM(amount_payment) AS yearly_income FROM checkout GROUP BY year(STR_TO_DATE(date, '%M %e, %Y')) ORDER BY year(STR_TO_DATE(date, '%M %e, %Y'));");

        $dataYearlyIncome = array();

        while ($rowYearly = mysqli_fetch_assoc($invcYearly)) {
            $dataYearlyIncome[] = array('date_group' => $rowYearly['date_group'], 'yearly_income' => $rowYearly['yearly_income']);
        }

        $absenqYearly = mysqli_query($con, "SELECT YEAR(STR_TO_DATE(dtrdate, '%M %e, %Y')) AS date_group, COUNT(*) AS absences_count
        FROM attendance
        WHERE absent = 1
        GROUP BY YEAR(STR_TO_DATE(dtrdate, '%M %e, %Y'))
        ORDER BY YEAR(STR_TO_DATE(dtrdate, '%M %e, %Y'))");

        $dataAbsencesYearly = array();

        while ($rowAbsences = mysqli_fetch_assoc($absenqYearly)) {
            $dataAbsencesYearly[] = array('date_group' => $rowAbsences['date_group'], 'absences' => $rowAbsences['absences_count']);
        }

        // Create a master list of all date_groups from all datasets
        $allDateGroups = array();

        foreach ($dataFinishedAssembliesYearly as $item) {
            if (!in_array($incm['date_group'], $allDateGroups)) {
            $allDateGroups[] = $item['date_group'];
            }
        }

        foreach ($dataYearlyIncome as $incm) {
            if (!in_array($incm['date_group'], $allDateGroups)) {
                $allDateGroups[] = $incm['date_group'];
            }
        }

        foreach ($dataAbsencesYearly as $absence) {
            if (!in_array($absence['date_group'], $allDateGroups)) {
                $allDateGroups[] = $absence['date_group'];
            }
        }

        $dataCombined = array();

        // Loop through the master list of date_groups
        foreach ($allDateGroups as $dateGroup) {
            // Find the matching data for Yearly Assemblies
            $finishedAssemblies = 0;
            foreach ($dataFinishedAssembliesYearly as $item) {
                if ($item['date_group'] === $dateGroup) {
                    $finishedAssemblies = $item['finished_assemblies'];
                    break;
                }
            }

            // Find the matching data for Yearly Income
            $yearlyIncome = 0;
            foreach ($dataYearlyIncome as $incm) {
                if ($incm['date_group'] === $dateGroup) {
                    $yearlyIncome = $incm['yearly_income'];
                    break;
                }
            }

            // Find the matching data for Number of Absences
            $absences = 0;
            foreach ($dataAbsencesYearly as $absence) {
                if ($absence['date_group'] === $dateGroup) {
                    $absences = $absence['absences'];
                    break;
                }
            }

            // Add the combined data to the array
            $dataCombined[] = array(
                'date_group' => $dateGroup,
                'finished_assemblies' => $finishedAssemblies,
                'yearly_income' => $yearlyIncome,
                'absences' => $absences,
            );

            // Debug output for each date group
            /* echo  "Date Group: " . $dateGroup . ", Finished Assemblies: " . $finishedAssemblies . ", Yearly Income: " . $yearlyIncome . ", Absences: " . $absences . "<br>"; */

        }
        

        // Encode the combined data into JSON format
        $jsonDataCombined = json_encode($dataCombined);
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
    <link href="../vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


    <script src="../js/plugins-init/sweetalert2.min.js"></script>
    <script scr="../js/plugins-init/sweetalert.init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.19/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    

</head>
<div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
