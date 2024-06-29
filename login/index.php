<?php
if (isset($_COOKIE['farzad_admin']) && $_COOKIE['farzad_admin'] != "") {
    header("Location: ../index");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Farzad's Blog | Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/admin.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto px-4" style="max-width: 100%; width:450px; min-height:450px;">
                        <div class="auth-form-light mx-auto rounded rounded-5 shadow-lg text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <h3 class="h3 text-center"><b>Admin Login</b></h3>
                            </div>
                            <h4 class="text-center">Welcome back!</h4>
                            <form class="pt-3" id="loginForm" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                <div class="form-group">
                                    <input name="username" type="text" class="form-control form-control-lg" id="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input name="password" type="password" class="form-control form-control-lg" id="password" placeholder="Password">
                                </div>
                                <div class="mt-3 d-flex flex-column gap-3 justify-content-between">
                                    <button type="submit" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn">
                                        SIGN IN
                                    </button>
                                    <button type="button" class="btn btn-block bg-black text-white btn-lg font-weight-medium auth-form-btn">
                                        <a href="/" style="text-decoration: none;" class="text-white nav-item">HOME</a>
                                    </button>
                                </div>
                                <div class="error text-center" id="errorDiv" style="display: none; color:red; padding:10px"></div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../vendors/base/vendor.bundle.base.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(event) {
            event.preventDefault(); // Prevent default form submission

            // Get form data
            const formData = new FormData(this);
            formData.append(
                'login',
                document.getElementById('username').value
            );
            formData.append(
                'password',
                document.getElementById('password').value
            )

            // Send form data to server

            try {
                const response = await fetch('./login.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                console.log(data)
                if (data.success === true) {
                    // Login successful, redirect to admin page
                    window.location.href = '../';
                } else {
                    // Login failed, display error message
                    const errorDiv = document.getElementById('errorDiv');
                    errorDiv.style.display = 'block';
                    errorDiv.textContent = data.message;
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../../js/off-canvas.js"></script>
    <script src="../../js/hoverable-collapse.js"></script>
    <script src="../../js/template.js"></script>
    <!-- endinject -->
</body>

</html>