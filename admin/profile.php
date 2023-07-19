<?php $do = 1; include 'head.php'?>
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
                            <p class="mb-0">Your Account Profile </p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile">
                            <div class="profile-head">
                                <div class="photo-content" style=" background: url(<?php if($profile['cover_photo'] == "fayeedcover.png"){ echo "../images/site/".$profile['cover_photo']; }else{ echo $profile['cover_photo']; }?>); background-size: cover;
    background-position: center;
    min-height: 250px;
    width: 100%;">
                                    <div class="cover-photo"></div>
                                    <div class="profile-photo">
                                        <img id="defaultImage" src="../images/users/<?php echo $profile['profile']?>" class="img-fluid rounded-circle" alt="">
                                        <img id="imagePreview"  width="200px" hieght="200px" > 
                                    </div>
                                </div>
                                <div class="profile-info">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-12">
                                            <div class="row">
                                                <div class="col-xl-4 col-sm-4 border-right-1 prf-col mt-5">
                                                    <div class="profile-name">
                                                        <h4 class="text-primary"><?php if(empty($fetch_info['usersFirstName']) || empty($fetch_info['usersLastName'])){ echo $fetch_info['username'];}else{ echo $fetch_info['usersFirstName']." ".$fetch_info['usersLastName'];}  ?></h4>
                                                        <p>Role</p>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 border-right-1 prf-col">
                                                    <div class="profile-email">
                                                        <h5 class="text-muted"><?php echo $fetch_info['email']?></h5>
                                                        <p>Email</p>
                                                    </div>
                                                </div>
                                                 <div class="col-xl-4 col-sm-4 prf-col">
                                                    <div class="profile-call">
                                                        <h5 class="text-muted"><?php echo $fetch_info['CellNumber']?></h5>
                                                        <p>Phone No.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                        <div class="card-body">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <div class="row">
                                                    <div class="col-md-6 mb-6">
                                                        <label for="validationServer02">Profile</label>
                                                        <input type="file" id="imageInput" class="form-control bg-primary text-light" name="lis_img0" accept="image/*">
                                                    </div>
                                                <div class="col-md-6 mb-6">
                                                    <label for="validationServer02">Cover Photo</label>
                                                        <select name="cover" class="form-control" id="">
                                                            <option value="">Choose Cover Photo</option>
                                                            <option value="fayeedcover.png">Default Cover</option>
                                                            <option value="https://c4.wallpaperflare.com/wallpaper/943/826/490/digital-digital-art-artwork-painting-drawing-hd-wallpaper-preview.jpg">Cover 1</option>
                                                            <option value="https://c4.wallpaperflare.com/wallpaper/767/612/930/nature-landscape-trees-digital-art-wallpaper-preview.jpg">Cover 2</option>
                                                            <option value="https://c4.wallpaperflare.com/wallpaper/533/163/784/digital-digital-art-artwork-illustration-minimalism-hd-wallpaper-preview.jpg">Cover 3</option>
                                                            <option value="https://c4.wallpaperflare.com/wallpaper/365/244/884/uchiha-itachi-naruto-shippuuden-anbu-silhouette-wallpaper-preview.jpg">Cover 4</option>
                                                            <option value="https://c4.wallpaperflare.com/wallpaper/203/203/693/sunset-drawing-animals-lake-wallpaper-preview.jpg">Cover 5</option>
                                                        </select>
                                                </div>
                                                </div>
                                        </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationServer02">First Name</label>
                                                    <input type="text" name="firstname" class="form-control is-<?php echo $fn?>" id="validationServer02" value="<?php echo $profile['usersFirstName']?>">
                                                        <?php if(empty($profile['usersFirstName'])){?><div class="<?php echo $fn?>-feedback">Please Update First Name</div>  <?php } else {?> <div class="<?php echo $fn?>-feedback">Looks good!</div> <?php }?>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationServer02">Last name</label>
                                                    <input type="text"  name="lastname" class="form-control is-<?php echo $ln?>" id="validationServer02" value="<?php echo $profile['usersLastName']?>">
                                                    <?php if(empty($profile['usersLastName'])){?><div class="<?php echo $ln?>-feedback">Please Update Last Name</div>  <?php } else {?> <div class="<?php echo $ln?>-feedback">Looks good!</div> <?php }?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="validationServer03">Address</label>
                                                    <input type="text" name="address" class="form-control is-<?php echo $add?>" id="validationServer03" value="<?php echo $profile['Address']?>">
                                                    <?php if(empty($profile['Address'])){?><div class="<?php echo $add?>-feedback">Please Update Address</div>  <?php } else {?> <div class="<?php echo $add?>-feedback">Looks good!</div> <?php }?>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="validationServer03">Age</label>
                                                    <input type="text" name="ages" class="form-control is-<?php echo $add?>" id="validationServer03" value="<?php echo $profile['age']?>">
                                                    <?php if(empty($profile['age'])){?><div class="<?php echo $age?>-feedback">Please Update Your Age</div>  <?php } else {?> <div class="<?php echo $age?>-feedback">Looks good!</div> <?php }?>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="validationServerUsername">Username</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-primary"  id="inputGroupPrepend3" >@</span>
                                                        <input type="text" name="username" class="form-control is-<?php echo $usr?>" id="validationServerUsername"  aria-describedby="inputGroupPrepend3" value="<?php echo $profile['username']?>">
                                                        <?php if(empty($profile['username'])){?><div class="<?php echo $usr?>-feedback">Please Update Your Username</div>  <?php } else {?> <div class="<?php echo $usr?>-feedback">Looks good!</div> <?php }?>
                                                    </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="validationServer04">Contact Number</label>
                                                    <input type="number" name="controlnumber" class="form-control is-<?php echo $cln?>" id="validationServer04" value="<?php echo $profile['CellNumber']?>">
                                                    <?php if(empty($profile['CellNumber'])){?><div class="<?php echo $cln?>-feedback">Please Update Your Contact Number</div>  <?php } else {?> <div class="<?php echo $cln?>-feedback">Looks good!</div> <?php }?>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" name="profile" type="submit">Update Profile</button>
                                    </form>
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