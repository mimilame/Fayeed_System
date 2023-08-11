<div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                        <div class="search_bar dropdown mt-4">
                                    <h4><?php echo $title?></h4>

                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" role="button" data-toggle="dropdown">
                                    <i class="fi fi-rr-badge-check"></i>
                                    <?php if($pulse['confirm'] == 1){ ?> <div class="pulse-css"></div> <?php }?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">

                                <a class="all-notification btn" href="attendance.php">Attendance<i
                                        class="fi fi-rr-badge-check"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="attendance.php" role="button" data-toggle="dropdown">
                                    <i class="fi fi-rr-user-crown"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="profile.php" class="dropdown-item">
                                        <i class="fi fi-rr-circle-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>

                                    <a href="#" id="logout-btn" class="dropdown-item" onclick="showLogoutConfirmation()">
                                        <i class="fi fi-rr-power"></i>
                                        <span class="ml-2">Logout</span>
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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css">


        <script>
            function showLogoutConfirmation() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this. Are you sure you want to logout?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, logout',
                    cancelButtonText: 'No, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, redirect to the logout page
                        window.location.href = '../logout-user.php'; // Replace with the actual URL of your logout page
                    }
                });
            }
        </script>
