<?php
    include_once('../includes/config.php');
    include_once('../includes/session.php');
    include_once('../includes/redirect.php');

    if(isset($_SESSION['email'])){

    }
    else{
        RedirectTo('index.php');
    }

?>

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
    <script src="../sweetalert2/jquery-3.6.0.min.js"></script>
    <script src="../sweetalert2/sweetalert2.all.min.js"></script>
    <link href="../fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <?php
    include_once('../includes/config.php');
    include_once('../includes/session.php');
    include_once('../includes/redirect.php');

    if(isset($_POST['submit'])){
        // Passing data's provided into variables
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        // Preventing SQL Injection
        $fullname = mysqli_real_escape_string($conn, $fullname);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

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
        elseif(empty($email)){
            //echo '<script> alert("Email Field is Empty"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'Email Field is Empty',
                icon: 'error',
                button: 'error',
                })
            </script>

            <?php
        }
        elseif(empty($password)){
            //echo '<script> alert("Password Field is Empty"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'Password Field is Empty',
                icon: 'error',
                button: 'error',
                })
            </script>

            <?php
        }
        //To Check if both password provided is the same
        elseif($password != $password2){
            //echo '<script> alert("Both Password do not match"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'Both Password do not match',
                icon: 'error',
                button: 'error',
                })
            </script>

            <?php
        }
        // Regular Expression to accept only alphabets for fullname
        elseif(!preg_match('/^[ a-z A-Z ]*$/', $fullname)){
            //echo '<script> alert("Only Alphabets Allowed for the Fullname Field"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'Only Alphabets Allowed for the Fullname Field',
                icon: 'error',
                button: 'error',
                })
            </script>

            <?php
        }
        else{

            // Hashing the password the user provided
            $pass = password_hash($password, PASSWORD_DEFAULT);

            // Check if User's email already exist in database
            $sql = "SELECT * FROM tblregister WHERE email = '$email'";
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_num_rows($query_result);
            if($result > 0){
                //echo '<script> alert("This Email Address Already Exist"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'This Email Address Already Exist',
                    icon: 'error',
                    button: 'error',
                    })
                </script>

                <?php
            }
            else{
                // If user email does not exist, it will save the user's data into the database
                $sql = "INSERT INTO tblregister (fullname, email, password, usertype) VALUES('$fullname', '$email', '$pass', 'Admin')";
                $query_result = mysqli_query($conn, $sql);

                if($query_result){
                    //echo '<script> alert("Account Created Successfully"); </script>';
                    ?>

                    <script>
                        Swal.fire({
                        text: 'Account Created Successfully',
                        icon: 'success',
                        button: 'success',
                        })
                    </script>

                    <?php
                }
                else{
                    //echo '<script> alert("Failed to Create Account"); </script>';
                    ?>

                    <script>
                        Swal.fire({
                        text: 'Failed to Create Account',
                        icon: 'error',
                        button: 'error',
                        })
                    </script>

                    <?php
                }
            }
        }

    }

?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="welcome.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Tech Innovation</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="welcome.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="admin_reg.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Admin Registration</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="candidate_reg.php">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span>Candidate Registration</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="all_votes.php">
                    <i class="fas fa-fw fa-box"></i>
                    <span>All Votes</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="change_password.php">
                    <i class="fas fa-fw fa-box"></i>
                    <span>Change Password</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="admin_logout.php">
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
                                        <h1 class="h4 text-gray-900 mb-4 text-center">Create Admin Account</h1>
                                    </div>
                                    <form action="admin_reg.php" method="POST">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="fullname" class="form-control"
                                                placeholder="Enter Full Name...">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control"
                                              placeholder="Enter Password Here...">
                                        </div>
                                        <div class="form-group">
                                            <label>Retype Password</label>
                                            <input type="password" name="password2" class="form-control"
                                              placeholder="Retype Password Here...">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                            <a href="welcome.php" class="btn btn-danger">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                    
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include_once('../includes/footer.php'); ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>