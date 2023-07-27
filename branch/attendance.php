<?php include 'head.php';
$emp = mysqli_query($con,"SELECT users.usersFirstName, users.usersLastName, users.email ,users.profile,users.usersID,  branch_staff.roles, branch_staff.staffID, branches.Branch_Name from branch_staff join users on  branch_staff.usersID = users.usersID join branches on branches.branchID = branch_staff.branchID where branches.branchID = $desigbranch")?>
<style>
   .continue-application {
  --color: #fff;
  --background: #404660;
  --background-hover: #3A4059;
  --background-left: #2B3044;
  --folder: #F3E9CB;
  --folder-inner: #BEB393;
  --paper: #FFFFFF;
  --paper-lines: #BBC1E1;
  --paper-behind: #E1E6F9;
  --pencil-cap: #fff;
  --pencil-top: #275EFE;
  --pencil-middle: #fff;
  --pencil-bottom: #5C86FF;
  --shadow: rgba(13, 15, 25, .2);
  border: none;
  outline: none;
  cursor: pointer;
  position: relative;
  border-radius: 5px;
  font-size: 14px;
  font-weight: 500;
  line-height: 19px;
  -webkit-appearance: none;
  -webkit-tap-highlight-color: transparent;
  padding: 17px 29px 17px 69px;
  transition: background 0.3s;
  color: var(--color);
  background: var(--bg, var(--background));
  width: 100%;
}


.continue-applications {
  --color: #fff;
  --background: #404660;
  --background-hover: #3A4059;
  --background-left: #2B3044;

  --shadow: rgba(13, 15, 25, .2);
  border: none;
  outline: none;
  cursor: pointer;
  border-radius: 5px;
  font-size: 14px;
  font-weight: 500;
  line-height: 19px;

  padding: 17px 29px 17px 17px;
  transition: background 0.3s;
  color: var(--color);
  background: var(--bg, var(--background));
  width: 100%;

}

.continue-application > div {
  top: 0;
  left: 0;
  bottom: 0;
  width: 53px;
  position: absolute;
  overflow: hidden;
  border-radius: 5px 0 0 5px;
  background: var(--background-left);
}

.continue-application > div .folder {
  width: 23px;
  height: 27px;
  position: absolute;
  left: 15px;
  top: 13px;
}

.continue-application > div .folder .top {
  left: 0;
  top: 0;
  z-index: 2;
  position: absolute;
  transform: translateX(var(--fx, 0));
  transition: transform 0.4s ease var(--fd, 0.3s);
}

.continue-application > div .folder .top svg {
  width: 24px;
  height: 27px;
  display: block;
  fill: var(--folder);
  transform-origin: 0 50%;
  transition: transform 0.3s ease var(--fds, 0.45s);
  transform: perspective(120px) rotateY(var(--fr, 0deg));
}

.continue-application > div .folder:before, .continue-application > div .folder:after,
.continue-application > div .folder .paper {
  content: "";
  position: absolute;
  left: var(--l, 0);
  top: var(--t, 0);
  width: var(--w, 100%);
  height: var(--h, 100%);
  border-radius: 1px;
  background: var(--b, var(--folder-inner));
}

.continue-application > div .folder:before {
  box-shadow: 0 1.5px 3px var(--shadow), 0 2.5px 5px var(--shadow), 0 3.5px 7px var(--shadow);
  transform: translateX(var(--fx, 0));
  transition: transform 0.4s ease var(--fd, 0.3s);
}

.continue-application > div .folder:after,
.continue-application > div .folder .paper {
  --l: 1px;
  --t: 1px;
  --w: 21px;
  --h: 25px;
  --b: var(--paper-behind);
}

.continue-application > div .folder:after {
  transform: translate(var(--pbx, 0), var(--pby, 0));
  transition: transform 0.4s ease var(--pbd, 0s);
}

.continue-application > div .folder .paper {
  z-index: 1;
  --b: var(--paper);
}

.continue-application > div .folder .paper:before, .continue-application > div .folder .paper:after {
  content: "";
  width: var(--wp, 14px);
  height: 2px;
  border-radius: 1px;
  transform: scaleY(0.5);
  left: 3px;
  top: var(--tp, 3px);
  position: absolute;
  background: var(--paper-lines);
  box-shadow: 0 12px 0 0 var(--paper-lines), 0 24px 0 0 var(--paper-lines);
}

.continue-application > div .folder .paper:after {
  --tp: 6px;
  --wp: 10px;
}

.continue-application > div .pencil {
  height: 2px;
  width: 3px;
  border-radius: 1px 1px 0 0;
  top: 8px;
  left: 105%;
  position: absolute;
  z-index: 3;
  transform-origin: 50% 19px;
  background: var(--pencil-cap);
  transform: translateX(var(--pex, 0)) rotate(35deg);
  transition: transform 0.4s ease var(--pbd, 0s);
}

.continue-application > div .pencil:before, .continue-application > div .pencil:after {
  content: "";
  position: absolute;
  display: block;
  background: var(--b, linear-gradient(var(--pencil-top) 55%, var(--pencil-middle) 55.1%, var(--pencil-middle) 60%, var(--pencil-bottom) 60.1%));
  width: var(--w, 5px);
  height: var(--h, 20px);
  border-radius: var(--br, 2px 2px 0 0);
  top: var(--t, 2px);
  left: var(--l, -1px);
}

.continue-application > div .pencil:before {
  -webkit-clip-path: polygon(0 5%, 5px 5%, 5px 17px, 50% 20px, 0 17px);
  clip-path: polygon(0 5%, 5px 5%, 5px 17px, 50% 20px, 0 17px);
}

.continue-application > div .pencil:after {
  --b: none;
  --w: 3px;
  --h: 6px;
  --br: 0 2px 1px 0;
  --t: 3px;
  --l: 3px;
  border-top: 1px solid var(--pencil-top);
  border-right: 1px solid var(--pencil-top);
}

.continue-application:before, .continue-application:after {
  content: "";
  position: absolute;
  width: 10px;
  height: 2px;
  border-radius: 1px;
  background: var(--color);
  transform-origin: 9px 1px;
  transform: translateX(var(--cx, 0)) scale(0.5) rotate(var(--r, -45deg));
  top: 26px;
  right: 16px;
  transition: transform 0.3s;
}

.continue-application:after {
  --r: 45deg;
}

.continue-application:hover {
  --cx: 2px;
  --bg: var(--background-hover);
  --fx: -40px;
  --fr: -60deg;
  --fd: .15s;
  --fds: 0s;
  --pbx: 3px;
  --pby: -3px;
  --pbd: .15s;
  --pex: -24px;
}




</style>

<body>
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

        <link href="../vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../vendor/datatables/css/responsive.dataTables.min.css" rel="stylesheet">
        <?php include 'header.php'; include 'sidebar.php'?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">

                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Attendance Pannel > Date : <?php echo $currentDatetransaction?> > Time : <?php echo $currentDateTimetrasaction?></h2>
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

                                            <div class="form-group col-md-3">

                                                <h5>Attendance Photo</h5><br>
                                                <img src="../images/attendance/<?php echo $selec3['enrtypic']?>" alt="" width="90%" height="300px">
                                                <?php if($selec3['enrtypic'] == 'face.gif'){ ?><input type="file"  class="form-control" name="lis_img0"><br>
                                                     <button type="submit" name="morningpic" class="continue-applications"><i class="fi fi-rr-aperture" style="font-size:20px" ></i> Attendance Shot </button> <?php }elseif($selec3['enrtypic'] == 'hourglass.gif'){ echo "<br><br> <h4 class='ml-1' style='color:red;'>Absent Date : ".$currentDatetransaction."</h4>"; } else{ echo " <br><br> <h4 class='ml-1' style='color:red;'>Have a Good Work!! </h4>";}?>

                                            </div>
                                            <div class="form-group col-md-9">
                                                    <div class="table-responsive">
                                                        <h4>Daily Time Record</h4>
                                                            <table id="example" class="display" style="min-width: 100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>Date</th>
                                                                        <th>Morning Time-in </th>
                                                                        <th>Morning Time-out</th>
                                                                        <th>Afternoon Time-in </th>
                                                                        <th>Afternoon Time-out</th>

                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <?php while($attendance = mysqli_fetch_array($allatt)){ ?>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td><p class="<?php if($attendance['dtrdate'] == "$currentDatetransaction"){ echo "bg-warning";}?>"><?php echo $attendance['dtrdate']; ?></p></td>
                                                                            <td><?php echo $attendance['morning_in']; ?></td>
                                                                            <td><?php echo $attendance['morning_out']; ?></td>
                                                                            <td><?php echo $attendance['afternoon_in']; ?></td>
                                                                            <td><?php echo $attendance['afternoon_out']; ?></td>
                                                                        </tr>
                                                                    <?php }?>


                                                                </tbody>

                                                            </table>
                                                        </div>



                                            </div>
                                        </div>
                                        <hr>
                                        <h3>Time inputs</h3>
                                        <div class="form-row">

                                            <div class="form-group col-md-3">

                                                <button name="morningsignin" class="continue-application" <?php if($selec3['morning_in'] != 0 ){ echo "disabled";}else{  echo $disabled;}?>>
                                                    <div>
                                                        <div class="pencil"></div>
                                                        <div class="folder">
                                                            <div class="top">
                                                                <svg viewBox="0 0 24 27">
                                                                    <path d="M1,0 L23,0 C23.5522847,-1.01453063e-16 24,0.44771525 24,1 L24,8.17157288 C24,8.70200585 23.7892863,9.21071368 23.4142136,9.58578644 L20.5857864,12.4142136 C20.2107137,12.7892863 20,13.2979941 20,13.8284271 L20,26 C20,26.5522847 19.5522847,27 19,27 L1,27 C0.44771525,27 6.76353751e-17,26.5522847 0,26 L0,1 C-6.76353751e-17,0.44771525 0.44771525,1.01453063e-16 1,0 Z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="paper"></div>
                                                        </div>
                                                    </div>

                                                   <?php if($selec3['morning_in'] != 0){ echo "Morning Time in ".$selec3['morning_in'];}else{ echo " Morning Sign In";}?>
                                                </button>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <button name="morningout" class="continue-application" <?php if($selec3['morning_out'] != 0 ){ echo "disabled";}else{  echo $disabled;}?>>
                                                    <div>
                                                        <div class="pencil"></div>
                                                        <div class="folder">
                                                            <div class="top">
                                                                <svg viewBox="0 0 24 27">
                                                                    <path d="M1,0 L23,0 C23.5522847,-1.01453063e-16 24,0.44771525 24,1 L24,8.17157288 C24,8.70200585 23.7892863,9.21071368 23.4142136,9.58578644 L20.5857864,12.4142136 C20.2107137,12.7892863 20,13.2979941 20,13.8284271 L20,26 C20,26.5522847 19.5522847,27 19,27 L1,27 C0.44771525,27 6.76353751e-17,26.5522847 0,26 L0,1 C-6.76353751e-17,0.44771525 0.44771525,1.01453063e-16 1,0 Z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="paper"></div>
                                                        </div>
                                                    </div>
                                                    <?php if($selec3['morning_out'] != 0){ echo "Morning Time out ".$selec3['morning_out'];}else{ echo " Morning Sign out";}?>
                                                </button>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <button name="afternoonsignin" class="continue-application"  <?php if($selec3['afternoon_in'] != 0 ){ echo "disabled";}else{  echo $disabled;}?>>
                                                    <div>
                                                        <div class="pencil"></div>
                                                        <div class="folder">
                                                            <div class="top">
                                                                <svg viewBox="0 0 24 27">
                                                                    <path d="M1,0 L23,0 C23.5522847,-1.01453063e-16 24,0.44771525 24,1 L24,8.17157288 C24,8.70200585 23.7892863,9.21071368 23.4142136,9.58578644 L20.5857864,12.4142136 C20.2107137,12.7892863 20,13.2979941 20,13.8284271 L20,26 C20,26.5522847 19.5522847,27 19,27 L1,27 C0.44771525,27 6.76353751e-17,26.5522847 0,26 L0,1 C-6.76353751e-17,0.44771525 0.44771525,1.01453063e-16 1,0 Z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="paper"></div>
                                                        </div>
                                                    </div>
                                                    <?php if($selec3['afternoon_in'] != 0){ echo "Afternoon Time in ".$selec3['afternoon_in'];}else{ echo " Afternoon Sign In";}?>
                                                </button>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <button name="afternoonout" class="continue-application"  <?php if($selec3['afternoon_out'] != 0 ){ echo "disabled";}else{  echo $disabled;}?> >
                                                    <div>
                                                        <div class="pencil"></div>
                                                        <div class="folder">
                                                            <div class="top">
                                                                <svg viewBox="0 0 24 27">
                                                                    <path d="M1,0 L23,0 C23.5522847,-1.01453063e-16 24,0.44771525 24,1 L24,8.17157288 C24,8.70200585 23.7892863,9.21071368 23.4142136,9.58578644 L20.5857864,12.4142136 C20.2107137,12.7892863 20,13.2979941 20,13.8284271 L20,26 C20,26.5522847 19.5522847,27 19,27 L1,27 C0.44771525,27 6.76353751e-17,26.5522847 0,26 L0,1 C-6.76353751e-17,0.44771525 0.44771525,1.01453063e-16 1,0 Z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="paper"></div>
                                                        </div>
                                                    </div>
                                                    <?php if($selec3['afternoon_out'] != 0){ echo "Afternoon Time out ".$selec3['afternoon_out'];}else{ echo " Afternoon Sign out";}?>
                                                </button>
                                            </div>
                                            <div class="form-group col-md-3">
                                            <?php if($selec3['morning_in'] == 0){ ?> <button type="submit" name="absent" class="form-control btn btn-danger"><i class="fi fi-rr-user-slash"></i> Set to Absent</button> <?php }?>

                                            </div>
                                        </div>

                                </div><hr>

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