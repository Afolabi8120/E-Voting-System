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
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $new_password2 = $_POST['new_password2'];

            // Preventing SQL Injection 
            $old_password = mysqli_real_escape_string($conn, $old_password);
            $new_password = mysqli_real_escape_string($conn, $new_password);
            $new_password2 = mysqli_real_escape_string($conn, $new_password2);

            ?>

            <?php
            // Form Validation
            if(empty($old_password)){
                //echo '<script> alert("Old Password Field is Empty"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'Old Password Field is Empty',
                    icon: 'error',
                    button: 'error',
                    })
                </script>

                <?php
            }
            elseif(empty($new_password)){
                //echo '<script> alert("New Password Field is Empty"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'New Password Field is Empty',
                    icon: 'error',
                    button: 'error',
                    })
                </script>

                <?php
            }
            elseif(empty($new_password2)){
                //echo '<script> alert("Retype New Password Field is Empty"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'Retype New Password Field is Empty',
                    icon: 'error',
                    button: 'error',
                    })
                </script>

                <?php
            }
            elseif($new_password != $new_password2){
                //echo '<script> alert("Both New Password do not match"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'Both New Password do not match',
                    icon: 'error',
                    button: 'error',
                    })
                </script>

                <?php
            }
            else{
                // Fetching User's Password From Database
                $sql = "SELECT * FROM tblregister WHERE email = '{$_SESSION['email']}' AND usertype = 'User' ";
                $query_result = mysqli_query($conn, $sql);
                $result = mysqli_num_rows($query_result);
                if($result > 0){
                    while($row = mysqli_fetch_array($query_result)){
                        $pass = $row['password'];

                        // Checking if password provided by user matches with the one in Database
                        if(password_verify($old_password, $pass)){
                            // Hashing the new password provided by user
                            $new_pass = password_hash($new_password, PASSWORD_DEFAULT);
                                // Updating the new password
                                $sql = "UPDATE tblregister SET password = '$new_pass' WHERE email = '{$_SESSION['email']}' AND usertype = 'User'";
                                $query_result = mysqli_query($conn, $sql);
                                ?>

                                <?php
                                if($query_result){
                                    //echo '<script> alert("Password has been successfully updated"); </script>';
                                ?>

                                <script>
                                    Swal.fire({
                                    text: 'Password has been successfully updated',
                                    icon: 'success',
                                    button: 'success',
                                    })
                                </script>

                                <?php
                                }
                                else{
                                    //echo '<script> alert("Failed to update password"); </script>';
                                ?>

                                <script>
                                    Swal.fire({
                                    text: 'Failed to update password',
                                    icon: 'error',
                                    button: 'error',
                                    })
                                </script>

                                <?php
                                }
                        }
                        else{
                            //echo '<script> alert("You provided a wrong password"); </script>';
                        ?>

                        <script>
                            Swal.fire({
                            text: 'You provided a wrong password',
                            icon: 'error',
                            button: 'error',
                            })
                        </script>

                        <?php
                        }

                    }
                        
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
                <a class="nav-link collapsed" href="change_password.php">
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
                                        <h1 class="h4 text-gray-900 mb-4 text-center">Change Password</h1>
                                    </div>
                                    <form action="change_password.php" method="POST">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="password" name="old_password" class="form-control"
                                              placeholder="Enter Password Here...">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="password" name="new_password" class="form-control"
                                              placeholder="Enter Password Here...">
                                        </div>
                                        <div class="form-group">
                                            <label>Retype Password</label>
                                            <input type="password" name="new_password2" class="form-control"
                                              placeholder="Retype Password Here...">
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