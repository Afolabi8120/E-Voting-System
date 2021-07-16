<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

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
        if(isset($_POST['vote'])){
            $candidate_id = $_POST['candidate_id'];
            $fullname = $_POST['fullname'];
            $category = $_POST['category'];

            $sql = "SELECT * FROM tblvote WHERE category = '$category' AND voters_email = '{$_SESSION['email']}'";
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_num_rows($query_result);
            ?>

            <?php
            if($result > 0){
                //echo '<script> alert("You have voted for a candidate with the same category name"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'You have voted for a candidate with the same category name',
                icon: 'info',
                button: 'info',
                })
            </script>

            <?php
            }
            else{
                $sql = "INSERT INTO tblvote (candidate_id,candidate_name,category,voters_name,voters_email) VALUES('$candidate_id','$fullname','$category','{$_SESSION['fullname']}','{$_SESSION['email']}')";
                $query_result = mysqli_query($conn, $sql);
                if($query_result){
                    //echo '<script> alert("Vote Successful"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'Vote Successful',
                    icon: 'success',
                    button: 'success',
                    })
                </script>

                <?php
                }
                else{
                    //echo '<script> alert("Failed to Vote"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'Failed to Vote',
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
                <div class="container">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> <br>
                        <h6 class="h6 mb-0 text-gray-800"> <?php echo 'Welcome, '. $_SESSION['fullname']; ?></h6>
                    </div>
                    
                    <div class="row">
                        <?php
                             $sql = "SELECT * FROM tblcandidate";
                             $query_result = mysqli_query($conn, $sql);
                             $result = mysqli_num_rows($query_result);
                             if($result > 0){
                                while ($row = mysqli_fetch_array($query_result)){

                        ?>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                                <!-- Basic Card Example -->
                            <form action="dashboard.php" method="POST">
                                <div class="card shadow mb-4">
                                    <img src="./uploads/<?php echo $row['image']; ?>" height="200" width="200" class="card-img-top p-3">
                                    <div class="card-header py-3">
                                        <label class="mt-1 font-weight-bold text-gray text-center" name="candidate_id"> <?php echo $row['candidate_id']; ?></label><br>
                                        <input type="hidden" name="candidate_id" value="<?php echo $row['candidate_id']; ?>">
                                        <label class="mt-1 font-weight-bold text-primary text-center" name="fullname"> <?php echo $row['fullname']; ?></label><br>
                                        <input type="hidden" name="fullname" value="<?php echo $row['fullname']; ?>">
                                        <label class="mt-1 font-weight-light text-primary text-center mt-1" name="category"><?php echo $row['category']; ?></label>
                                        <input type="hidden" name="category" value="<?php echo $row['category']; ?>">
                                        <br>
                                        <label class="mt-1 font-weight-lighter text-primary text-center mt-1" name="gender"><?php echo $row['gender']; ?></label>
                                    </div>
                                    <div class="card-title p-1 text-center font-weight-bold text-primary"> Objective </div>
                                    <div class="card-body p-2">
                                        <?php echo $row['objective']; ?>
                                        <input type="submit" class="btn btn-primary form-control mt-3"
                                        name="vote" value="Vote">                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                             }
                        }
                        ?>
                    </div>
                </div>

            </div>
                <!-- /.container-fluid -->
            <?php include_once('./includes/footer.php'); ?>

            </div>
            <!-- End of Main Content -->

            

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
