<?php
if (!isset($_COOKIE['farzad_admin']) || $_COOKIE['farzad_admin'] == "") {
    header("Location: ../login");
    die();
}
if (isset($_POST["submit"])) {
    setcookie("farzad_admin", "", time() - 3600, "/");
    header("Location: ../login");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Farzad Nosrati | Activity log</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>

<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <!-- <a class="navbar-brand brand-logo me-5" href="../../index.html"><img src="../assets/images/logo.svg"
                        class="me-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="../../index.html"><img
                        src="../assets/images/logo-mini.svg" alt="logo" /></a> -->
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <img src="../assets/images/profile.png" alt="profile" />
                    </a>
                    <form method="post" >
                        <div class="dropdown-menu p-2 dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <button style="border:none; outline: none; background-color:transparent;" class="btn" name="submit" type="submit">
                            <i class="ti-power-off text-primary"></i> Logout </a>
                        </button>
                    </form>
                    </div>
                </li>
                <li class="nav-item nav-settings d-none d-lg-flex">
                    <a class="nav-link" href="#">
                    <i class="icon-ellipsis"></i>
                    </a>
                </li>
            </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    <li class="nav-item">
                        <a class="nav-link" href="../create/">
                            <i class="mdi mdi-border-color menu-icon"></i>
                            <span class="menu-title">New Post</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../activity/">
                            <i class="mdi mdi-border-color mdi-chart-line menu-icon"></i>
                            <span class="menu-title">Activity</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper p-4">
                    <div class="row">
                        <h4 class="card-title">ACTIVITY LOG</h4>
                        <div class="row activity-dash bg-white rounded rounded-5 my-4 py-3 mx-lg-2">
                            <!-- <h2 class="activity card-title"><b>Activity</b></h2> -->
                            <ul id="activity">
                            </ul>
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn border-1 border rounded border-black opacity-0 disabled"
                                    id="prevBtn">Previous</button><button
                                    class="btn border-1 border rounded border-black" id="nextBtn">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                     </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/activity.js" type="module"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
</body>

</html>