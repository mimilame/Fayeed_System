<?php $do = 1; include 'head.php';?>
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
        <?php include 'header.php'; include 'sidebar.php'?>

     <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4><?php echo $formattedDate; ?></h4>
                            <p class="mb-0">Users Profile </p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="administrators.php">Back</a></li>
                            <li class="breadcrumb-item active"><?php if(empty($ckprofile['usersFirstName']) || empty($ckprofile['usersLastName'])){ echo $ckprofile['username'];}else{ echo $ckprofile['usersFirstName'];}  ?>'s Profile</li>
                        </ol>
                    </div>
                    
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile">
                            <div class="profile-head">
                                <div class="photo-content" style=" background: url(<?php if($ckprofile['cover_photo'] == "fayeedcover.png"){ echo "../images/site/".$ckprofile['cover_photo']; }else{ echo $ckprofile['cover_photo']; }?>); background-size: cover;
    background-position: center;
    min-height: 250px;
    width: 100%;">
                                    <div class="cover-photo"></div>
                                    <div class="profile-photo">
                                        <img id="defaultImage" src="../images/users/<?php echo $ckprofile['profile']?>" class="img-fluid rounded-circle" alt="">
                                        <img id="imagePreview"  width="200px" hieght="200px" > 
                                    </div>
                                </div>
                                <div class="profile-info">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="row">
                                                <div class="col-xl-4 col-sm-4 border-right-1 prf-col mt-5">
                                                    <div class="profile-name">
                                                        <h4 class="text-primary"><?php if(empty($ckprofile['usersFirstName']) || empty($ckprofile['usersLastName'])){ echo $ckprofile['username'];}else{ echo $ckprofile['usersFirstName']." ".$ckprofile['usersLastName'];}  ?></h4>
                                                        <p>Role</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                                    <div class="profile-email">
                                                        <h5 class="text-muted"><?php echo $ckprofile['email']?></h5>
                                                        <p>Email</p>
                                                    </div>
                                                </div>
                                                 <div class="col-xl-4 col-sm-4 prf-col">
                                                    <div class="profile-call">
                                                        <h5 class="text-muted"><?php echo $ckprofile['CellNumber']?></h5>
                                                        <p>Phone No.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                        <div class="card-body">
                                    
                                </div>
                                        </div>
                                    </div>
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
    <script>
const defaultImage = document.getElementById('defaultImage');
const imageInput = document.getElementById('imageInput');
const imagePreview = document.getElementById('imagePreview');

imageInput.addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      imagePreview.src = e.target.result;
      defaultImage.style.display = 'none'; // Hide the default image
    };
    reader.readAsDataURL(file);
  } else {
    imagePreview.src = '#';
    defaultImage.style.display = 'inline-block'; // Show the default image
  }
});


</script>
    <script src="../vendor/global/global.min.js"></script>
    <script src="../js/quixnav-init.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morris/morris.min.js"></script>
    <script src="../vendor/circle-progress/circle-progress.min.js"></script>
    <script src="../vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="../vendor/gaugeJS/dist/gauge.min.js"></script>
    <script src="../vendor/flot/jquery.flot.js"></script>
    <script src="../vendor/flot/jquery.flot.resize.js"></script>
    <script src="../vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="../vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="../vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="../vendor/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="../js/dashboard/dashboard-1.js"></script>
</body>
</html>