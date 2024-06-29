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
    <title>Farzad Nosrati | View post</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <script src="https://cdn.tiny.cloud/1/in99ycrsy1m2h2v85lpdg644q2i39zhvmuzv1wkveysw5fx0/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <link rel="shortcut icon" href="/admin/images/favicon.png" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/styles.css">
            <link rel="stylesheet" href="../assets/css/custom.css">
</head>

<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePostModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="post-error">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Cancel</button>
                    <button id="deleteBtn" type="button" class="btn btn-danger text-white">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div> -->
    <div class="wysiwyg-editor shadow-lg" id="editor">
        <div class="closeBtn">
            <button id="closeBtn">&times;</button>
        </div>
        <form action="" class="w-100" id="wysiwyg-form">
            <div class="form-group">
                <label for="exampleInputName1">Title</label>
                <input type="text" style="font-weight: bolder;" class="form-control" id="exampleInputName1"
                    placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Sub Title</label>
                <input type="text" style="font-weight: 500;" class="form-control" id="exampleInputName1"
                    placeholder="Name">
            </div>
        </form>
        <textarea class="form-control" style="outline: none; border:none; height: 100%;" id="editWysiwyg"></textarea>
        <div class="p-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
            <button type="button" class="btn bg-dark text-white h-25 " id="saveChangesBtn">Save changes</button>
            <p id="postEditStatus"></p>
        </div>
    </div>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.php -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-sort-variant"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-4 w-100 text-dark">
                    <a href="../" class="text-dark btn"><b>Back to Dashboard</b></a>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="../assets/images/profile.png" alt="profile" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <form method="post" action="#">
                                <button style="background-color: transparent; border: none; " class="button w-100"
                                    name="submit" type="submit">
                                    <a class="dropdown-item">
                                        <i class="mdi mdi-logout text-primary"></i>
                                        Logout
                                    </a>
                                </button>
                            </form>

                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper" id="postWrapper">
            <!-- partial -->
            <div class="main-panel mx-auto">
                <div id="someID" style="background-color: #fff !important;">
                    <!-- Page Header-->
                    <header id="masthead" class="masthead">
                        <div class="container position-relative px-4 px-lg-5">
                            <div class="row gx-4 gx-lg-5 justify-content-center">
                                <div class="col-md-10 col-lg-8 col-xl-11">
                                    <div class="post-heading text-center">
                                        <h1 class="text-dark" id="post-title"></h1>
                                        <h2 class="subheading text-dark" id="post-sub"></h2>
                                        <div
                                            class="meta flex-column flex-md-row gap-4 gap-md-3 text-dark mx-auto mt-5 d-flex gap-x-2 justify-content-md-between col-md-12 col-xl-8">
                                            <span class="d-flex w-auto gap-3 mx-auto">
                                                <i class="fas fa-user"></i>
                                                <span class="pl-5" id="post-author"></span>
                                            </span>
                                            <span class="d-flex w-auto gap-3 mx-auto">
                                                <i class="fas fa-calendar"></i>
                                                <span id="date_added"></span>
                                            </span>
                                            <span class="d-flex w-auto gap-3 mx-auto">
                                                <i class="fas fa-comments"></i>
                                                <span id="comment-num">No comments</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Post Content-->
                    <div class="blog-single">
                        <div class="container">
                            <div class="row align-items-start">
                                <div class="col-lg-8 m-15px-tb">
                                    <article class="article">
                                        <div class="article-img" id="blog-image">
                                            <!-- 
                                <img src="https://www.bootdey.com/image/800x350/87CEFA/000000" title="" alt=""> -->
                                        </div>
                                        <div id="post-content">

                                        </div>
                                        <div
                                            class="d-flex gap-3 flex-column flex-md-row align-content-start justify-content-start col-3 col-md-12">
                                            <button style="white-space: nowrap;" id="openEditor"
                                                class="actionbtn nowrap"><b>Edit Post</b></button>
                                            <button style="white-space: nowrap;" class="actionbtn text-warning"
                                                id="saveToDrafts"><b>Save to drafts</b></button>
                                            <button style="white-space: nowrap;" id="deletePostBtn"
                                                class="actionbtn text-danger" data-bs-toggle="modal"
                                                data-bs-target="#deletePostModal">
                                                <b>Delete Post</b>
                                            </button>
                                            <div style="white-space: nowrap;" id="publishError"
                                                class="actionbtn text-success">

                                            </div>
                                        </div>
                                    </article>

                                    <!-- POST COMMENTS -->
                                    <div class="contact-form article-comment mb-5">
                                        <h4>Comments</h4>
                                        <div class="d-flex flex-column gap-4" id="get-comments">
                                        </div>
                                    </div>


                                    <div class="contact-form article-comment" id="postComments">
                                        <h4>Leave a Reply</h4>
                                        <form id="contact-form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input name="Name" id="name" placeholder="Name *"
                                                            class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input name="Email" id="email" placeholder="Email *"
                                                            class="form-control" type="email">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="message" id="message"
                                                            placeholder="Your message *" rows="4"
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div id="errors" class="fadeInUp">

                                                </div>
                                                <div class="col-md-12">
                                                    <div class="send">
                                                        <button type="button" class="px-btn theme"><span>Submit</span>
                                                            <i class="arrow"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-4 m-15px-tb blog-aside">

                                    <!-- End Latest Post -->
                                    <div class="px-3 mt-5 d-flex flex-column gap-y-2" id="others">
                                        <h3 class="h3"><b>Other Posts</b></h3>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.php -->
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/template.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/posts.js" type="module"></script>

</body>

</html>