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
           $desigID = $chroles['usersID'];
           $desigbranch = $chroles['branchID'];
           if($designated == 1){
            header('Location: ../branch/home.php');
           }elseif($designated == 2){
            header('Location: ../inventory/home.php');
           }elseif($designated == 3){
            $title = "Branch Staffs";
           }else{
            header('Location: ../staff/home.php');
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
        echo $_SESSION['loggedin_success'] = true;
        header("Location: profile.php?log_success=1");
        }
}
date_default_timezone_set('Asia/Manila');
$transamont = date('F');
$currentDatetransaction = date('F j, Y');
$currentDateTimetrasaction = date('g:i a');

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
$inventori = mysqli_query($con,"SELECT * FROM inventory;");
$stt = mysqli_query($con,"SELECT * from settings where SettingsId = 1;");
$settings = mysqli_fetch_assoc($stt);
$cardin = mysqli_query($con,"select count(inventory.branchID) as number,inventory.branchID, branches.Branch_Name from inventory  join branches on branches.branchID = inventory.branchID group by branchID");
$assemlist = mysqli_query($con,"SELECT assembly.assemblyName, assembly.editor,assembly.assemblyStatus,inventory.inventoryName,assembly.branchID,  assembly.assemblyID,assembly.assemblyQuatty, users.usersFirstName, users.usersLastName from assembly join users on users.usersID = assembly.usersID join inventory on inventory.inventoryId = assembly.inventoryId WHERE assembly.branchID = $desigbranch;");
$inlist = mysqli_query($con,"SELECT inventory.product_code,inventory.inventoryName, inventory.inventoryDesc,inventory.inventoryId, inventory.inventoryQty, branches.Branch_Name ,users.usersFirstName, users.usersLastName from inventory join branches on branches.branchID = inventory.branchID join users on users.usersID = inventory.usersID WHERE branches.branchID = $desigbranch  order by 5;");

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
                            echo $_SESSION['update_success'] = true;
                            header("Location: profile.php?update_success=1");
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
                echo "<script>alert('Role Set to Branch Manager');window.location.href='detail-branch.php?branch=$brnjID'</script>";
            }

        }

        if(isset($_GET['editassembly'])){
            $editassembly =  $_GET['editassembly'];
            $ed = mysqli_query($con,"SELECT inventory.inventoryName,assembly.inventoryId,assembly.assemblyName, assembly.assemblyQuatty,  assembly.assemblyID from assembly join inventory on inventory.inventoryId = assembly.inventoryId WHERE assemblyID = $editassembly;");
            $edit = mysqli_fetch_assoc($ed);
        }
        if(isset($_GET['qty'])){
            $editassembly =  $_GET['qty'];
            $ed = mysqli_query($con,"SELECT inventory.inventoryName,assembly.inventoryId,assembly.assemblyName, assembly.assemblyQuatty,  assembly.assemblyID from assembly join inventory on inventory.inventoryId = assembly.inventoryId WHERE assemblyID = $editassembly;");
            $edit = mysqli_fetch_assoc($ed);
        }

        if(isset($_POST['assembly'])){

            if($invenID == "#"){
                $errors['quanty'] = "Please Select Inventory";
            }else{
                $invenID = $_POST['invenID'];
            }
            if(empty($_POST['Assemblyname'])){
                $errors['Assembly'] = "Please Insert Assembly Name";
            }else{
                $Assemblyname = $_POST['Assemblyname'];
            }
            if(empty($_POST['quanty'])){
                $errors['quanty'] = "Please Insert qQuanty Name";
            }else{
                $quanty = $_POST['quanty'];
            }

            if(count($errors) === 0){
                if($editassembly == ''){
                    $insert = mysqli_query($con,"INSERT INTO assembly(inventoryId,branchID,usersID,assemblyName,assemblyQuatty) VALUES ('$invenID','$desigbranch','$desigID','$Assemblyname','$quanty')");
                    if($insert){
                        echo "<script>alert('Assembly $Assemblyname Successfully Created');window.location.href='assemblylist.php'</script>";
                    }else{
                        echo "<script>alert('Assembly $Assemblyname Error');window.location.href='add-assembly.php'</script>";
                    }
                }else{
                    $update = mysqli_query($con,"UPDATE assembly set inventoryId ='$invenID', assemblyName = '$Assemblyname', assemblyQuatty = '$quanty', editor= '$id' WHERE assemblyID = $editassembly;");
                    echo "<script>alert('Assembly $Assemblyname Successfully Updated');window.location.href='assemblylist.php'</script>";
                }
            }
        }
        if(isset($_GET['delassembly'])){
            $deid =$_GET['delassembly'];
            $logdetail ="1 Assembly Procedures has been Deleted - Branch Staff";
            $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
            $del = mysqli_query($con,"DELETE from assembly WHERE assemblyID = $deid");
            if($del){
                echo "<script>alert('Successfully Deleted');window.location.href='assemblylist.php'</script>";
            }else{
                echo "<script>alert('Error Action ');window.location.href='assemblylist.php'</script>";
            }
        }
        if(isset($_GET['statassembly'])){
            $assid = $_GET['statassembly'];
            $chekass = mysqli_query($con,"SELECT * from assembly WHERE assemblyID = $assid");
            $checka = mysqli_fetch_assoc($chekass);
            $checkstat = $checka['assemblyStatus'];
            $checkname = $checka['assemblyName'];
            $asslop = $checka['assemblyQuatty'];
            $inbentorID = $checka['inventoryId'];
           if($checkstat == 'Assemble'){
                    $seleckz = mysqli_query($con,"SELECT * From assembly_inventory WHERE assemblyID = $assid");
                    $frr = 1;
                    while ($jkchek = mysqli_fetch_array($seleckz)) {
                        $inmbentID = $jkchek['inventory_list'];
                        $qtylist = $jkchek['inventory_qty'] * $asslop;
                        $invbt = mysqli_query($con,"SELECT * FROM inventory WHERE inventoryId = $inmbentID ");
                        $numbch = mysqli_fetch_assoc($invbt);
                        if($qtylist > $numbch['inventoryQty']){
                            $minusstok = $qtylist - $numbch['inventoryQty'];
                            $logdetail ="The Inventory <b>\"".$numbch['inventoryName']."\"</b> is at short state of $qtylist / ".$numbch['inventoryQty']." . <br> please notify the inventory admin that the stock is short about <b> $minusstok </b> - Branch Staff";
                            $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                            $errors[$frr++] = "The Inventory <b>\"".$numbch['inventoryName']."\"</b> is at short state of $qtylist / ".$numbch['inventoryQty']." . <br> please notify the inventory admin that the stock is short about <b> $minusstok </b>";
                        }elseif ($numbch['inventoryQty'] == 0) {
                            $errors[$frr++] = "The Inventory <b>\"".$checkInventory['inventoryName']."\"</b> is out of Stock. <br> please notify the inventory admin about the stock quantity is empty.";

                        }
                    }
                    if(count($errors)===0){
                        for ($i=0; $i < $asslop; $i++) {
                            $sele = mysqli_query($con,"SELECT * From assembly_inventory WHERE assemblyID = $assid");
                            while ($invemtory = mysqli_fetch_array($sele)) {
                                $inventoryList = $invemtory['inventory_list'];
                                $inventoryQty = $invemtory['inventory_qty'];
                                $updateInventoryQuery = mysqli_query($con, "UPDATE inventory SET inventoryQty = inventoryQty - $inventoryQty WHERE inventoryId = $inventoryList");
                            }
                        }
                        $logdetail =" Inventory \"$checkname\" Finished Succesfully and Produced $asslop x - Branch Staff";
                        $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                        $updateprd = mysqli_query($con,"UPDATE inventory SET inventoryQty = inventoryQty + $asslop WHERE inventoryId = $inbentorID");
                        $update = mysqli_query($con,"UPDATE assembly SET assemblyStatus = 'Finished', editor = 0 Where assemblyID = $assid");
                        echo "<script>alert('Congratulations, $checkname set to Finished');window.location.href='assemblylist.php'</script>";

                    }
           }elseif ($checkstat == 'Finished') {
            $seleckz = mysqli_query($con,"SELECT * From assembly_inventory WHERE assemblyID = $assid");
            $frr = 1;
            while ($jkchek = mysqli_fetch_array($seleckz)) {
                $inmbentID = $jkchek['inventory_list'];
                $qtylist = $jkchek['inventory_qty'] * $asslop;
                $invbt = mysqli_query($con,"SELECT * FROM inventory WHERE inventoryId = $inmbentID ");
                $numbch = mysqli_fetch_assoc($invbt);
                if($qtylist > $numbch['inventoryQty']){
                    $minusstok = $qtylist - $numbch['inventoryQty'];
                    $logdetail ="<p class='bg-danger'>ALERT<p> \t The Inventory <b>\"".$numbch['inventoryName']."\"</b> is at short state of $qtylist / ".$numbch['inventoryQty']." . <br> please notify the inventory admin that the stock is short about <b> $minusstok </b>";
                    $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                    $errors[$frr++] = "The Inventory <b>\"".$numbch['inventoryName']."\"</b> is at short state of $qtylist / ".$numbch['inventoryQty']." . <br> please notify the inventory admin that the stock is short about <b> $minusstok </b>";

                }elseif ($numbch['inventoryQty'] == 0) {
                    $errors[$frr++] = "The Inventory <b>\"".$checkInventory['inventoryName']."\"</b> is out of Stock. <br> please notify the inventory admin that the stock quantity is empty.";

                }
            }

                 if (count($errors) === 0) {
                    $logdetail = "Inventory \"$checkname\" is Set to Assemble and Performing Procedures - Branch Staff";
                    $insertlog = mysqli_query($con, "INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                    $update = mysqli_query($con, "UPDATE assembly SET assemblyStatus = 'Assemble' WHERE assemblyID = $assid");
                    echo "<script>alert('$checkname Has Set to Assemble, Please Modify the Number or Just leave it');window.location.href='assembyqtyedit.php?qty=$assid'</script>";
                }



           }elseif ($checkstat == 'Standby') {
            $seleckz = mysqli_query($con,"SELECT * From assembly_inventory WHERE assemblyID = $assid");
            $frr = 1;
            while ($jkchek = mysqli_fetch_array($seleckz)) {
                $inmbentID = $jkchek['inventory_list'];
                $qtylist = $jkchek['inventory_qty'] * $asslop;
                $invbt = mysqli_query($con,"SELECT * FROM inventory WHERE inventoryId = $inmbentID ");
                $numbch = mysqli_fetch_assoc($invbt);
                if($qtylist > $numbch['inventoryQty']){
                    $minusstok = $qtylist - $numbch['inventoryQty'];
                    $errors[$frr++] = "The Inventory <b>\"".$numbch['inventoryName']."\"</b> is at short state of $qtylist / ".$numbch['inventoryQty']." . <br> please notify the inventory admin about na stock is short about <b> $minusstok </b>";
                }elseif ($numbch['inventoryQty'] == 0) {
                    $errors[$frr++] = "The Inventory <b>\"".$checkInventory['inventoryName']."\"</b> is out of Stock. <br> please notify the inventory admin about na stock quantity is empty.";

                }
            }
                if(count($errors)===0){
                    $logdetail ="Inventory \"$checkname\" is Set to Asembly and Performing Procedures  - Branch Staff";
                    $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                    $update = mysqli_query($con,"UPDATE assembly SET assemblyStatus = 'Assemble' Where assemblyID = $assid");
                    echo "<script>alert('$checkname Has Set to Assemble, Please Modify the Number or Just leave it');window.location.href='assembyqtyedit.php?qty=$assid'</script>";
                }


           }
        }
        if(isset($_GET['cancelssembly'])){
            $assiad = $_GET['cancelssembly'];
            $logdetail ="Inventory is Set to Standby and Ready to perform procedures  - Branch Staff";
            $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
            $update = mysqli_query($con,"UPDATE assembly SET assemblyStatus = 'Standby' Where assemblyID = $assiad");
                echo "<script>window.location.href='assemblylist.php'</script>";
        }







        $mtime = $settings['latetimein_morning'];
        $ftime = $settings['latetimein_afternoon'];

        $att = mysqli_query($con,"SELECT * FROM attendance WHERE branchID = $desigbranch && usersID =$id && dtrdate = '$currentDatetransaction'");
        if(mysqli_num_rows($att) > 0){
                $select = mysqli_query($con,"SELECT * FROM attendance WHERE branchID = $desigbranch && usersID =$id && dtrdate = '$currentDatetransaction'");
                $selecy = mysqli_fetch_assoc($select);
                $attendanceID = $selecy['attendanceID'];
                $select2x = mysqli_query($con,"SELECT * FROM attendance WHERE attendanceID = $attendanceID");
                $selec3 = mysqli_fetch_assoc($select2x);

                if($selec3['enrtypic'] == 'face.gif'){
                    $disabled = "disabled";
                }else{
                    $disabled = "";
                }

                $xdatetime = DateTime::createFromFormat('g:i a', $currentDateTimetrasaction);
                $formattedTime = $xdatetime->format('H:i');
                if($formattedTime >= $ftime){
                    $morrningin = $selec3['morning_in'];
                    $morrningout = $selec3['morning_out'];
                    if($morrningin == 0 && $morrningout == 0){
                        $update = mysqli_query($con,"UPDATE attendance SET morning_in = 'Absent', morning_out = 'Absent' WHERE attendanceID = $attendanceID");
                        echo "<script>window.location.href='attendance.php'</script>";
                    }else{

                    }
                }
        }else{
             $insert = mysqli_query($con,"INSERT INTO attendance (branchID,usersID,dtrdate) VALUES('$desigbranch','$id','$currentDatetransaction')");
             echo  "<script>window.location.href='attendance.php'</script>";
        }
        $allatt = mysqli_query($con,"SELECT * FROM attendance WHERE usersID = $id ORDER BY attendanceID DESC");
        if(isset($_POST['morningpic'])){
            if($_FILES['lis_img0']['name']!=''){
                $lis_img0 = $_FILES['lis_img0']['name'];
                   }
                else{
                 $lis_img0 = $selec3["enrtypic"];
                }
                $tempname = $_FILES['lis_img0']['tmp_name'];
                $folder = "../images/attendance/".$lis_img0;
                move_uploaded_file($tempname, $folder);
                $update = mysqli_query($con,"UPDATE attendance SET enrtypic = '$lis_img0' WHERE attendanceID = $attendanceID");
                echo $_SESSION['photo_save'] = true;
                header("Location: attendance.php?photo_save=1");
        }

        if(isset($_POST['morningsignin'])){
            $xdatetime = DateTime::createFromFormat('g:i a', $currentDateTimetrasaction);
            $formattedTime = $xdatetime->format('H:i');
            if($formattedTime > $mtime){
                $update = mysqli_query($con,"UPDATE attendance SET morning_in = 'Late : $currentDateTimetrasaction' WHERE attendanceID = $attendanceID");
                echo "<script>alert('Morninng Time in $currentDateTimetrasaction');window.location.href='attendance.php'</script>";
            }else{
                $update = mysqli_query($con,"UPDATE attendance SET morning_in = '$currentDateTimetrasaction' WHERE attendanceID = $attendanceID");
                echo "<script>alert('Morninng Time in $currentDateTimetrasaction');window.location.href='attendance.php'</script>";
            }

        }

        if(isset($_POST['morningout'])){
            $update = mysqli_query($con,"UPDATE attendance SET morning_out = '$currentDateTimetrasaction' WHERE attendanceID = $attendanceID");
            echo "<script>alert('Morning time out $currentDateTimetrasaction');window.location.href='attendance.php'</script>";
        }

        if(isset($_POST['afternoonsignin'])){

            $xdatetime = DateTime::createFromFormat('g:i a', $currentDateTimetrasaction);
            $formattedTime = $xdatetime->format('H:i');
            if($formattedTime > $ftime){
                $update = mysqli_query($con,"UPDATE attendance SET afternoon_in = 'Late : $currentDateTimetrasaction' WHERE attendanceID = $attendanceID");
            echo "<script>alert('Afternoon Time in $currentDateTimetrasaction');window.location.href='attendance.php'</script>";
            }else{
                $update = mysqli_query($con,"UPDATE attendance SET afternoon_in = '$currentDateTimetrasaction' WHERE attendanceID = $attendanceID");
            echo "<script>alert('Afternoon Time in $currentDateTimetrasaction');window.location.href='attendance.php'</script>";
            }

        }
        if(isset($_POST['afternoonout'])){
            $update = mysqli_query($con,"UPDATE attendance SET afternoon_out = '$currentDateTimetrasaction' WHERE attendanceID = $attendanceID");
            echo "<script>alert('Afternoon Time out $currentDateTimetrasaction');window.location.href='attendance.php'</script>";
        }


        if(isset($_POST['absent'])){
            $update = mysqli_query($con,"UPDATE attendance SET enrtypic = 'hourglass.gif', morning_in = 'Absent', morning_out = 'Absent', afternoon_in = 'Absent',afternoon_out = 'Absent', absent = 1 WHERE attendanceID = $attendanceID");
            echo "<script>alert('Attendance is set to Absent');window.location.href='attendance.php'</script>";
        }
        $brc = mysqli_query($con,"SELECT * FROM branches WHERE branchID = $desigbranch");
        $branchde = mysqli_fetch_assoc($brc);


        $imvto = mysqli_query($con," SELECT count(*) total FROM inventory WHERE branchID = $desigbranch");
        $innventory = mysqli_fetch_assoc($imvto);

        $assm = mysqli_query($con,"SELECT SUM(assemblyQuatty) AS Total FROM assembly WHERE assemblyStatus = 'Standby' AND branchID = $desigbranch");
        $Assembly = mysqli_fetch_assoc($assm);

        $invc = mysqli_query($con,"SELECT SUM(amount_payment) total FROM checkout WHERE branchID = $desigbranch AND date LIKE '$mmmmnthh %'");
        $income = mysqli_fetch_assoc($invc);

        $avbc = mysqli_query($con,"SELECT count(absent) absent from attendance WHERE absent = 1 AND dtrdate = '$currentDatetransaction';");
        $absent = mysqli_fetch_assoc($avbc);

        $afsent = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, branches.Branch_Name FROM attendance join users on users.usersID = attendance.usersID join branches on branches.branchID = attendance.branchID  WHERE attendance.absent =1 and dtrdate = '$currentDatetransaction';");


        $cprocontrol = $settings['product_control'];
        $llllll = mysqli_query($con,"SELECT COUNT(*) alert FROM inventory WHERE inventoryQty < $cprocontrol AND branchID = $desigbranch;");
        $alertprd = mysqli_fetch_assoc($llllll);

        $lllllls = mysqli_query($con,"SELECT branches.Branch_Name, inventory.product_code,inventory.inventoryName,inventory.inventoryQty from inventory join branches on branches.branchID = inventory.branchID WHERE inventory.inventoryQty < $cprocontrol AND inventory.branchID =$desigbranch LIMIT 5;");
        $tranv = mysqli_query($con,"SELECT checkout.Transaction_code , inventory.inventoryName ,checkout.quantity ,branches.Branch_Name ,checkout.amount_payment ,checkout.mop ,checkout.date ,checkout.time from checkout join inventory on inventory.inventoryId = checkout.inventoryId join branches on branches.branchID = checkout.branchID WHERE checkout.branchID = $desigbranch ORDER BY checkout.time DESC LIMIT 10 ;");

        $pols = mysqli_query($con,"SELECT confirm from attendance where usersID = $id AND dtrdate ='$currentDatetransaction'");
        $pulse = mysqli_fetch_assoc($pols);
        $logss = mysqli_query($con,"SELECT users.usersFirstName,users.usersLastName, branches.Branch_Name ,Logs.Activity ,Logs.date,Logs.time FROM Logs join users on users.usersID = Logs.usersID join branches on branches.branchID = Logs.branchID WHERE Logs.usersID = $id ORDER BY Logs.LogsID DESC ");
        $logg = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, branches.Branch_Name, Logs.Activity, Logs.date, Logs.time
        FROM Logs
        JOIN users ON users.usersID = Logs.usersID
        JOIN branches ON branches.branchID = Logs.branchID
        WHERE Logs.usersID = $id AND Logs.Activity LIKE '%Branch Staff%'
        ORDER BY Logs.LogsID DESC");

        //-------Line Graph for branch staff --------------------------------
        $count = mysqli_num_rows($lllllls);

        $sql = "SELECT CONCAT(YEAR(added), '-', MONTH(added)) AS date_group,
        COUNT(*) AS finished_assemblies,
        SUM(absences_count) AS absences
        FROM (
            SELECT added, COUNT(*) AS finished_count, 0 AS absences_count
            FROM assembly
            INNER JOIN branch_staff ON assembly.usersID = branch_staff.usersID
            WHERE assembly.assemblyStatus = 'Finished' AND branch_staff.usersID = $id
            GROUP BY YEAR(added), MONTH(added)

            UNION ALL

            SELECT STR_TO_DATE(dtrdate, '%M %e, %Y') AS added, 0 AS finished_count, COUNT(*) AS absences_count
            FROM attendance
            INNER JOIN branch_staff ON attendance.usersID = branch_staff.usersID
            WHERE attendance.absent = 1 AND branch_staff.usersID = $id
            GROUP BY YEAR(STR_TO_DATE(dtrdate, '%M %e, %Y')), MONTH(STR_TO_DATE(dtrdate, '%M %e, %Y'))
        ) AS combined_data
        GROUP BY date_group
        ORDER BY added";

        // Execute the combined query
        $result = mysqli_query($con, $sql);

        $dataCombined = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $dataCombined[] = array(
                'date_group' => $row['date_group'],
                'finished_assemblies' => $row['finished_assemblies'],
                'absences' => $row['absences'],
            );
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
    <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">

    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>

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

    <style>
        .disabled-button {
            pointer-events: none;
            opacity: 0.6; /* Optional: reduce the opacity to visually indicate the disabled state */
            cursor: not-allowed; /* Optional: change the cursor to indicate that the button is disabled */
        }
    </style>

