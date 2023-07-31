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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.20/sweetalert2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>

        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css"> -->






