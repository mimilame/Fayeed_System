<div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                        <div class="search_bar dropdown mt-3">
                               
                                    <h4><?php echo $title?></h4>
                             
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="fi fi-rr-badge-check"></i>
                                    <?php if($pulse['total'] > 0){ ?> <div class="pulse-css"></div> <?php }?>
                                    
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <a class="all-notification btn" href="attandance.php">Check Attendance<i
                                            class="fi fi-rr-badge-check"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="fi fi-rr-user-crown"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="profile.php" class="dropdown-item">
                                        <i class="fi fi-rr-circle-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    
                                    <a href="../logout-user.php" class="dropdown-item">
                                        <i class="fi fi-rr-power"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

        <script>        
            var customCSS = document.createElement('style');
            customCSS.innerHTML = '.morris-hover.morris-default-style { position: absolute; z-index: 0!important; }';
            document.head.appendChild(customCSS);
        </script>
                                              