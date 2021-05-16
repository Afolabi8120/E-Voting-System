<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profile</title>

    <!-- Custom fonts for this template-->
    <script src="./sweetalert2/jquery-3.6.0.min.js"></script>
    <script src="./sweetalert2/sweetalert2.all.min.js"></script>
    <link href="fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <?php
    include_once('./includes/config.php');
    include_once('./includes/session.php');
    include_once('./includes/redirect.php');

    if(isset($_SESSION['email'])){
        if(isset($_POST['update'])){
            $fullname = $_POST['fullname'];
            //$email = $_POST['email'];

            // Preventing SQL Injection
            $fullname = mysqli_real_escape_string($conn, $fullname);
            //$email = mysqli_real_escape_string($conn, $email);

            ?>

            <?php
            // Form Validation
            if(empty($fullname)){
                //echo '<script> alert("Full Name Field is Empty"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'Full Name Field is Empty',
                icon: 'error',
                button: 'error',
                })
            </script>

            <?php
            }
            elseif (!preg_match("/^[a-z A-Z]*$/", $fullname)) {
                //echo '<script> alert("Only Alphabet Allowed"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'Only Alphabet Allowed',
                icon: 'error',
                button: 'error',
                })
            </script>

            <?php
            }
            else{
                $sql = "UPDATE tblregister SET fullname = '$fullname' WHERE email = '{$_SESSION['email']}' AND usertype = 'User'";
                $query_result = mysqli_query($conn, $sql);

                // Store Data into a Session
                $fullname = $_SESSION['fullname'];
            ?>


            <?php    
                if($query_result){
                    //echo '<script> alert("Details has been updated successfully"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'Details has been updated successfully',
                    icon: 'success',
                    button: 'success',
                    })
                </script>

                <?php
                }
                else{
                    //echo '<script> alert("Failed to Update Details"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'Failed to Update Details',
                    icon: 'error',
                    button: 'error',
                    })
                </script>

                <?php
                }
            }
        }       
    }
    else{
           RedirectTo('index.php');
    }

?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Tech Innovation</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="profile.php">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span>My Profile</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="my_votes.php">
                    <i class="fas fa-fw fa-box"></i>
                    <span>My Votes</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#">
                    <i class="fas fa-fw fa-lock"></i>
                    <span>Change Password</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h2>e-Voting System</h2>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                            <div class="col-lg-6">
                                <div class="p-3">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 text-center">My Profile</h1>
                                    </div>
                                    <form action="profile.php" method="POST">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="fullname" class="form-control"
                                                placeholder="Enter Full Name..." value="<?php echo "{$_SESSION['fullname']}" ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter Email Address..." value="<?php echo "{$_SESSION['email']}" ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="update" class="btn btn-primary" value="Update">
                                            <a href="dashboard.php" class="btn btn-danger">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include_once('./includes/footer.php'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>