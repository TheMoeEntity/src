<?php

if (!isset($_COOKIE['farzad_admin']) || $_COOKIE['farzad_admin'] == "") {
    header("Location: ./login");
    die();
}

if (isset($_POST["submit"])) {
    setcookie("farzad_admin", "", time() - 3600, "/");
    header("Location: ./login");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Farzad Nosrati | Admin Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
  <link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.19.1/dist/bootstrap-table.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/admin.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="loading-overlay" id="loadingOverlay">
    <div class="spinner"></div>
  </div>
  <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deletePostModalLabel">Confirm Action</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="post-error">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-warning text-white d-none" id="updateActionBtn">Publish</button>
          <button id="adminDeleteAction" type="button" class="btn btn-danger text-white d-none">Delete</button>
        </div>
      </div>
    </div>
  </div>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <!-- <a class="navbar-brand brand-logo me-5" href="index.html"><img src="assets/images/logo.svg" class="me-2"
            alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
            alt="logo" /></a> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="assets/images/profile.png" alt="profile" />
            </a>
           <form method="post" >
              <div class="dropdown-menu p-2 dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <button style="border:none; outline: none; background-color:transparent;" class="btn" name="submit" type="submit">
                  <i class="ti-power-off text-primary"></i> Logout </a>
              </button>
            </form>
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
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="./">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          <li class="nav-item">
            <a class="nav-link" href="./create/">
              <i class="mdi mdi-border-color menu-icon"></i>
              <span class="menu-title">New Post</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./activity/">
              <i class="mdi mdi-border-color mdi-chart-line menu-icon"></i>
              <span class="menu-title">Activity</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome back Farzad,</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                      class="text-primary"><span id="totalDashboard"></span> pending actions!</span></h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-md-12 grid-margin transparent">
              <div class="row">
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Blog Posts</p>
                      <p id="totalPostsCount" class="fs-30 mb-2">0</p>
                      <p><span id="publishedPostsDashboard">0</span> (published)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Post Comments</p>
                      <p class="fs-30 mb-2" id="totalCommentsCount">0</p>
                      <p><span id="publishedCommentsDashboard">0</span> (approved)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Pending Actions</p>
                      <p class="fs-30 mb-2" id="totalPending">0</p>
                      <p><span id="pendingPostsDashboard">0</span> posts and <span
                          id="pendingCommentsDashboard">0</span> comments</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Order Details</p>
                  <p class="font-weight-500">The total number of sessions within the date range. It is the period time a
                    user is actively engaged with your website, page or app, etc</p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="me-5 mt-3">
                      <p class="text-muted">Order value</p>
                      <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                    </div>
                    <div class="me-5 mt-3">
                      <p class="text-muted">Orders</p>
                      <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                    </div>
                    <div class="me-5 mt-3">
                      <p class="text-muted">Users</p>
                      <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Downloads</p>
                      <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                    </div>
                  </div>
                  <canvas id="order-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <p class="card-title">Sales Report</p>
                    <a href="#" class="text-info">View all</a>
                  </div>
                  <p class="font-weight-500">The total number of sessions within the date range. It is the period time a
                    user is actively engaged with your website, page or app, etc</p>
                  <div id="sales-chart-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Blog Posts</h4>
                  </p>
                  <div class="table-responsive">
                    <!-- <table id="posts-table-main" class="table table-striped">
                      <thead>
                        <tr>
                          <th> ID </th>
                          <th> Title </th>
                          <th> Status </th>
                          <th> Date </th>
                          <th> Comments </th>
                          <th> Actions </th>
                        </tr>
                      </thead>
                      <tbody id="posts-table">
                      </tbody>
                    </table> -->
                    <table id="posts-table" class="table table-striped">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Status</th>
                          <th>Date</th>
                          <th>Comments</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pending Comments *</h4>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> ID </th>
                          <th> Comment </th>
                          <th> Post </th>
                          <th> Name </th>
                          <th> Email </th>
                          <th> Status </th>
                          <th> Date </th>
                          <th> Actions </th>
                        </tr>
                      </thead>
                      <tbody id="commentsTableContainer">

                        <td class="py-1">
                          0
                        </td>
                        <td style="max-width: 300px; white-space: normal;"> mosesnwigberi@gmail.com Lorem ipsum dolor,
                          sit amet consectetur adipisicing.</td>
                        <td><a href=""><b>The amazing world of gumballs</b></a> </td>
                        <td> Moses Nwigberi </td>
                        <td> mosesnwigberi@gmail.com </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                              aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td style="max-width: 250px;"> mosesnwigberi@gmail.com lorem10</td>
                        <td class="py-1">
                          <div class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            </a>
                            <div class="dropdown-menu gap-5 dropdown-menu-right navbar-dropdown"
                              aria-labelledby="profileDropdown">
                              <i class="ti-power-off text-primary"></i> Logout </a>
                            </div>
                          </div>
                        </td>
                        </tr>
                        <tr>
                          <td class="py-1">
                            0
                          </td>
                          <td> Herman Beck </td>
                          <td> <a href=""><b>The amazing world of gumballs</b></a> </td>
                          <td> Moses Nwigberi </td>
                          <td> mosesnwigberi@gmail.com </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td> May 15, 2015 </td>
                          <td class="py-1">
                            <div class="nav-item nav-profile dropdown">
                              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                id="profileDropdown">
                              </a>
                              <div class="dropdown-menu gap-5 dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item mb-3">
                                  <i class="ti-settings text-primary"></i> Settings </a>
                                <a class="dropdown-item">
                                  <i class="ti-power-off text-primary"></i> Logout </a>
                              </div>
                            </div>
                          </td>


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Reserved Copies</h4>
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> # </th>
                          <th> Name </th>
                          <th> Email </th>
                          <th> Phone </th>
                          <th> Address </th>
                          <th> Message </th>
                          <th> Date </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td> 1 </td>
                          <td> John the Doe </td>
                          <td>
                            johhndoe@gmail.com
                          </td>
                          <td>08087489362 </td>
                          <td> University of Lagos, Akoka. </td>
                          <td style="max-width: 300px; height: auto; white-space: normal; line-height: 1.4;">
                            mosesnwigberi@gmail.com Lorem ipsum dolor..
                          </td>
                          <td>May 23, 2024 </td>
                        </tr>
                        <tr>
                          <td> 1 </td>
                          <td> John the Doe </td>
                          <td>
                            johhndoe@gmail.com
                          </td>
                          <td>08087489362 </td>
                          <td> University of Lagos, Akoka. </td>
                          <td style="max-width: 300px; height: auto; white-space: normal; line-height: 1.4;">
                            mosesnwigberi@gmail.com Lorem ipsum dolor..
                          </td>
                          <td>May 23, 2024 </td>
                        </tr>
                        <tr>
                          <td> 1 </td>
                          <td> John the Doe </td>
                          <td>
                            johhndoe@gmail.com
                          </td>
                          <td>08087489362 </td>
                          <td> University of Lagos, Akoka. </td>
                          <td style="max-width: 300px; height: auto; white-space: normal; line-height: 1.4;">
                            mosesnwigberi@gmail.com Lorem ipsum dolor..
                          </td>
                          <td>May 23, 2024 </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <div class="row">

            <div class="row bg-light mt-5 pt-3 d-flex flex-column gap-2" id="pendingComments">
              <div class="d-flex flex-column ">
                <h4 class='mb-2 p-2 px-3 card-title'>Reserved copies</h4>
                <span class="text-danger p-3" id="postErrorMessage"></span>

              </div>
              <div class="pt-3 col-md-12 stretch-card card-body bg-white table-responsive">
                <table class="table table-hover table-striped noscroll">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Address </th>
                      <th scope="col">Message</th>
                      <th scope="col">Date</th>
                    </tr>
                  </thead>
                  <tbody id="reservedTableContainer" class="noscroll">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="p-4">
              <div class="row activity-dash bg-white rounded rounded-5 my-4 py-3">
                <h3 class="activity mt-3"><b>Latest Activity</b></h3>
                <ul id="activity">

                </ul>
                <a href="./activity/" class="text-dark noUnderline px-4"><b>Show all</b></a>
              </div>
            </div>
          </div>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/chart.umd.js"></script>
  < <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script type="module" src="assets/js/admin.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
</body>

</html>