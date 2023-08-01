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
           $desigbranch = $chroles['branchID'];
           if($designated == 1){
            $title = "Branch Manager";
           }elseif($designated == 2){
            header('Location: ../inventory/home.php');
           }elseif($designated == 3){
            header('Location: ../staffs/home.php');
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
$transaday = date('j');
$transayear = date('Y');
$currentDatetransaction = date('F j, Y');
$currentDateTimetrasaction = date('g:i a');
$mmmmnthh = date('F');
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');
$dateString = $currentDate." ".$currentTime;
$timestamp = strtotime($dateString);
$formattedDate = date('l - F d Y, g:i A', $timestamp);
$inventori = mysqli_query($con,"SELECT * FROM inventory WHERE branchID = $desigbranch");
$adm = mysqli_query($con,"SELECT * FROM users WHERE roles = 1");
$bra = mysqli_query($con,"select users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles, branch_staff.staffID, branches.Branch_Name, branches.branchID from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branch_staff.roles = 1");
$inv = mysqli_query($con,"select users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles, branch_staff.staffID, branches.Branch_Name, branches.branchID from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branch_staff.roles = 2");
$staf = mysqli_query($con,"select users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles,branch_staff.staffID, branches.Branch_Name, branches.branchID  from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branch_staff.roles = 3");
$n_roles = mysqli_query($con,"SELECT * FROM users WHERE roles = 2");
$brc = mysqli_query($con,"SELECT * FROM branches WHERE branchID = $desigbranch");
$branchde = mysqli_fetch_assoc($brc);
$stt = mysqli_query($con," select * from settings where SettingsId =1;");
$settings = mysqli_fetch_assoc($stt);
$assemlist = mysqli_query($con,"SELECT assembly.assemblyName,assembly.assemblyStatus,inventory.inventoryName,assembly.branchID,  assembly.assemblyID,assembly.assemblyQuatty, users.usersFirstName, users.usersLastName from assembly join users on users.usersID = assembly.usersID join inventory on inventory.inventoryId = assembly.inventoryId WHERE assembly.branchID = $desigbranch;");
$cardin = mysqli_query($con,"select count(inventory.branchID) as number,inventory.branchID, branches.Branch_Name from inventory  join branches on branches.branchID = inventory.branchID group by branchID");
$inlist = mysqli_query($con,"SELECT inventory.price, inventory.product_code,inventory.inventoryName, inventory.inventoryDesc,inventory.inventoryId, inventory.inventoryQty, branches.Branch_Name ,users.usersFirstName, users.usersLastName from inventory join branches on branches.branchID = inventory.branchID join users on users.usersID = inventory.usersID WHERE branches.branchID = $desigbranch ");
$checj = mysqli_query($con,"SELECT checkout.Transaction_code , inventory.inventoryName ,checkout.quantity ,checkout.branchID ,checkout.amount_payment ,checkout.mop ,checkout.date ,checkout.time from checkout join inventory on inventory.inventoryId = checkout.inventoryId WHERE checkout.branchID = $desigbranch ORDER BY checkout.checkoutID DESC");

$brcc = mysqli_query($con,"SELECT count(branchID) branch from branches");
$bbranch = mysqli_fetch_assoc($brcc);

$sttaf = mysqli_query($con,"SELECT COUNT(usersID) staffs FROM branch_staff WHERE branchID = $desigbranch");
$sttafss = mysqli_fetch_assoc($sttaf);

$imvto = mysqli_query($con," SELECT count(*) total FROM inventory WHERE branchID = $desigbranch");
$innventory = mysqli_fetch_assoc($imvto);

$assm = mysqli_query($con,"SELECT SUM(assemblyQuatty) Total FROM assembly WHERE assemblyStatus = 'Standby' AND branchID = $desigbranch");
$Assembly = mysqli_fetch_assoc($assm);

$invc = mysqli_query($con,"SELECT SUM(amount_payment) total FROM checkout WHERE branchID = $desigbranch AND date LIKE '$mmmmnthh %'");
$income = mysqli_fetch_assoc($invc);

$avbc = mysqli_query($con,"SELECT count(absent) absent from attendance WHERE absent = 1 AND dtrdate = '$currentDatetransaction';");
$absent = mysqli_fetch_assoc($avbc);

$afsent = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, branches.Branch_Name FROM attendance join users on users.usersID = attendance.usersID join branches on branches.branchID = attendance.branchID  WHERE attendance.absent =1 and dtrdate = '$currentDatetransaction';");

$logss = mysqli_query($con,"SELECT users.usersFirstName,users.usersLastName, branches.Branch_Name ,Logs.Activity ,Logs.date,Logs.time FROM Logs join users on users.usersID = Logs.usersID join branches on branches.branchID = Logs.branchID WHERE Logs.branchID = $desigbranch ORDER BY Logs.LogsID DESC ");
$logg = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, branches.Branch_Name, Logs.Activity, Logs.date, Logs.time
FROM Logs
JOIN users ON users.usersID = Logs.usersID
JOIN branches ON branches.branchID = Logs.branchID
WHERE (Logs.Activity LIKE '%transaction%' OR Logs.Activity LIKE '%create%' OR Logs.Activity LIKE '%finished%')
ORDER BY Logs.LogsID DESC;
");

$cprocontrol = $settings['product_control'];
$llllll = mysqli_query($con,"SELECT COUNT(*) alert FROM inventory WHERE inventoryQty < $cprocontrol AND branchID = $desigbranch;");
$alertprd = mysqli_fetch_assoc($llllll);

$lllllls = mysqli_query($con,"SELECT branches.Branch_Name, inventory.product_code,inventory.inventoryName,inventory.inventoryQty from inventory join branches on branches.branchID = inventory.branchID WHERE inventory.inventoryQty < $cprocontrol AND inventory.branchID =$desigbranch");
$tranv = mysqli_query($con,"SELECT checkout.Transaction_code , inventory.inventoryName ,checkout.quantity ,branches.Branch_Name ,checkout.amount_payment ,checkout.mop ,checkout.date ,checkout.time from checkout join inventory on inventory.inventoryId = checkout.inventoryId join branches on branches.branchID = checkout.branchID WHERE checkout.branchID = $desigbranch ORDER BY checkout.time DESC LIMIT 5");

$count = mysqli_num_rows($tranv);


$pols = mysqli_query($con,"SELECT confirm from attendance where usersID = $id AND STR_TO_DATE(dtrdate, '%M %e, %Y') ='$currentDatetransaction'");
$pulse = mysqli_fetch_assoc($pols);

if(isset($_POST['signin'])){
    echo "<script>alert('sddsasd')</script>";
}
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

            $logdetail ="Add New Branch Staff with specific role of code $roles - Branch Manager";
            $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                $insert = mysqli_query($con,"INSERT INTO  branch_staff(branchID,usersID,roles,assigndby) VALUES('$editbranch','$userids','$roles','$id')");
                echo $_SESSION['appointuser'] = true;
                header("Location: detail-branch.php?branch=" . urlencode($desigbranch) . "&appointuser=1");
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

            $logdetail ="The One Item Has been Deleted  - Branch Manager";
            $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
            $sh = mysqli_query($con,"DELETE FROM inventory WHERE inventoryId = $delin");
            echo $_SESSION['InventoryDel'] = true;
            header("Location: inventorylist.php?InventoryDel=1");
        }
        if(isset($_POST['addinventory'])){

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
                $errors['quanty'] = "Please Insert a Inventory Quantity";
            }

            if(isset($_POST['price'])){
                $price = $_POST['price'];
            }else{
                $errors['price'] = "Please Insert a Inventory Price";
            }

            if(isset($_POST['description'])){
                $description = $_POST['description'];
            }else{
                $errors['description'] = "Please Insert a inventory description";
            }

            if(count($errors) === 0){
                if($invenID == ""){

                    $logdetail ="Created New inventory Name :<b>$inventoryname</b> with Product code of <b>$code</b> and Price tag of <b>₱ $price</b>  - Branch Manager";
                    $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                    $insert = mysqli_query($con,"INSERT INTO inventory(usersID,branchID,inventoryName,inventoryDesc,inventoryQty,product_code,price) VALUES ('$id','$desigbranch','$inventoryname','$description','$quanty','$code','$price')");
                    echo $_SESSION['InventoryAdd'] = true;
                    header("Location: inventorylist.php?InventoryAdd=1");
                }else{
                    $logdetail ="Updated Details of  inventory Name :<b>$inventoryname</b> with Product code :<b>$code</b>  - Branch Manager";
                    $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                    $insert = mysqli_query($con,"UPDATE inventory SET inventoryName = '$inventoryname', inventoryDesc = '$description', inventoryQty = '$quanty', product_code = '$code' , price = '$price'  WHERE inventoryId = $invenID");
                    if($insert){
                        echo $_SESSION['InventoryUpdate'] = true;
                        header("Location: inventorylist.php?InventoryUpdate=1");
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
           if($change['roles'] == 2){
                $logdetail ="Modify New Branch Staff with specific role of code 2 - Branch Manager";
                $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                $update = mysqli_query($con,"UPDATE branch_staff SET roles = 3  WHERE staffID = $rolechange");
                echo $_SESSION['changuser'] = true;
                header("Location: detail-branch.php?branch=" . urlencode($desigbranch) . "&changuser=2");
            }elseif($change['roles'] == 3){
                $logdetail ="Modify New Branch Staff with specific role of code 3 - Branch Manager";
                $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                $update = mysqli_query($con,"UPDATE branch_staff SET roles = 2  WHERE staffID = $rolechange");
                echo $_SESSION['changuser'] = true;
                header("Location: detail-branch.php?branch=" . urlencode($desigbranch) . "&changuser=3");
            }

        }


        if(isset($_POST['checkout'])){
            do {
                $Transaction_code =  $transamont."".rand(111, 999) . "-" . rand(111, 999) . "-" . rand(111, 999);
                $chkcn = mysqli_query($con, "SELECT Transaction_code FROM checkout WHERE Transaction_code = '$random_number'");
            } while (mysqli_num_rows($chkcn) > 0);

           if($_POST['invenID'] != '#'){
                $invenID = $_POST['invenID'];
           }else{
                $errors['invenID'] = "Please Provide Choose Inventory to Checkout";
           }
           if(isset($_POST['date'])){
                $date = $_POST['date'];
           }else{
                $errors['date'] = "Please Provide Details For date";
           }
           if(isset($_POST['time'])){
                $time = $_POST['time'];
           }else{
                $errors['time'] = "Please Provide Details For time";
           }
           if(isset($_POST['name'])){
                $name = $_POST['name'];
           }else{
                $errors['name'] = "Please Provide Details For name";
           }
           if(isset($_POST['quanty'])){
                $quanty = $_POST['quanty'];
           }else{
                $errors['quanty'] = "Please Provide Details For ";
           }

           if($_POST['mop'] != '#'){
                $mop = $_POST['mop'];
           }else{
                $errors['mop'] = "Please Provide Details For Mode of Payment";
           }
           if(isset($_POST['contact'])){
                $contact = $_POST['contact'];
           }else{
                $errors['contact'] = "Please Provide Details For contact";
           }
           if(isset($_POST['city'])){
                $city = $_POST['city'];
           }else{
                $errors['city'] = "Please Provide Details For ";
           }
           if(count($errors)===0){
                $selectinv = mysqli_query($con,"SELECT * FROM inventory WHERE inventoryId = $invenID");
                $inventdetail = mysqli_fetch_array($selectinv);
                $prixe = $inventdetail['price'];
                $payment = $prixe * $quanty;
                $minus = mysqli_query($con,"UPDATE inventory SET inventoryQty = inventoryQty - $quanty WHERE inventoryId = $invenID");
                if($minus){
                    $logdetail ="Item Transaction Code <b><u>:$Transaction_code </u></b> Sold <b>$quanty</b> x in amount of <b>₱ $payment</b> by using <b>$mop</b> from customer : <b>$name</b>,  Contact # : <b>$contact</b> . <br> - Branch Manager";
                    $insertlog = mysqli_query($con,"INSERT INTO Logs(usersID,branchID,Activity,date,time) VALUES('$id','$desigbranch','$logdetail','$currentDatetransaction','$currentDateTimetrasaction')");
                    $insert = mysqli_query($con,"INSERT INTO checkout(branchID,usersID,inventoryId,Transaction_code,quantity,cleint_name,cleint_number,amount_payment,mop,date,time,month,day,year) VALUES ('$desigbranch','$id','$invenID','$Transaction_code','$quanty','$name','$contact','$payment','$mop','$date','$time','$transamont','$transaday','$transayear')");
                    if ($insert) {
                        $_SESSION['checkout_items'] = true;
                        header("Location: checktransaction.php?checkout_items=1");
                    } else {
                        $errors['errr'] = " Error Checking Out ";
                    }
                }else{
                    $errors['err'] = " Error Inventory Connection";
                }


           }


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


        //-------Line Graph for branch manager------------------------

        $sql = "SELECT
            CONCAT(YEAR(added), '-', MONTH(added)) AS date_group,
            SUM(finished_count) AS finished_count,
            SUM(monthly_income) AS monthly_income,
            SUM(absences_count) AS absences_count
        FROM
            (
                SELECT
                    added,
                    COUNT(*) AS finished_count,
                    0 AS monthly_income,
                    0 AS absences_count
                FROM assembly
                WHERE assemblyStatus = 'Finished' AND branchID = $desigbranch
                GROUP BY YEAR(added), MONTH(added)

                UNION ALL

                SELECT
                    STR_TO_DATE(date, '%M %e, %Y') AS added,
                    0 AS finished_count,
                    SUM(amount_payment) AS monthly_income,
                    0 AS absences_count
                FROM checkout
                WHERE branchID = $desigbranch
                GROUP BY YEAR(STR_TO_DATE(date, '%M %e, %Y')), MONTH(STR_TO_DATE(date, '%M %e, %Y'))

                UNION ALL

                SELECT
                    STR_TO_DATE(dtrdate, '%M %e, %Y') AS added,
                    COUNT(*) AS finished_count, -- Use 0 if you want the zero values to be included
                    0 AS monthly_income,
                    0 AS absences_count
                FROM attendance
                WHERE absent = 1 AND branchID = $desigbranch
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
                'finished_assemblies' => $row['finished_count'],
                'monthly_income' => $row['monthly_income'],
                'absences' => $row['absences_count'],
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
