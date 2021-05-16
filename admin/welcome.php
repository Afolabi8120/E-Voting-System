<?php
    include_once('../includes/config.php');
    include_once('../includes/session.php');
    include_once('../includes/redirect.php');

    if(isset($_SESSION['email'])){
        if(isset($_POST['btn_delete'])){
            $id = $_POST['delete_id'];
            $sql = "DELETE FROM tblcandidate WHERE id = '$id'";
            $query_result = mysqli_query($conn, $sql);
            if($query_result){
                echo "Candidate Record has been deleted successfully";
            }
            else{
                echo "Candidate Record failed to deleted";
            }
        }

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

    <title>Admin | Home</title>

    <!-- Custom fonts for this template-->
    <script src="../sweetalert2/jquery-3.6.0.min.js"></script>
    <script src="../sweetalert2/sweetalert2.all.min.js"></script>
    <link href="../fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
                        <h6 class="h6 mb-0 text-gray-800"> <?php echo 'Welcome, '. $_SESSION['fullname']; ?></h6>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Candidates Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Candidates</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $sql = "SELECT * FROM tblcandidate ORDER BY fullname ASC";
                                                    $query_result = mysqli_query($conn, $sql);
                                                    $row = mysqli_num_rows($query_result);
                                                    echo "$row";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-secondary-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Voters Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Voters</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $sql = "SELECT * FROM tblregister WHERE usertype = 'User' ORDER BY fullname ASC";
                                                    $query_result = mysqli_query($conn, $sql);
                                                    $row = mysqli_num_rows($query_result);
                                                    echo "$row";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-secondary-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Users Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Admin
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                            $sql = "SELECT * FROM tblregister WHERE usertype = 'Admin' ORDER BY fullname ASC";
                                                            $query_result = mysqli_query($conn, $sql);
                                                            $row = mysqli_num_rows($query_result);
                                                            echo "$row";
                                                        ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-secondary-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Votes</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                    $sql = "SELECT * FROM tblvote";
                                                    $query_result = mysqli_query($conn, $sql);
                                                    $row = mysqli_num_rows($query_result);
                                                    echo "$row";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-box fa-2x text-secondary-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List Of All Registered Candidate</h6>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary justify-content-between mt-2 shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> &nbsp; Generate Report</a>
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success justify-content-between mt-2 shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> &nbsp; Export to Excel</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php
                                        $sql = "SELECT * FROM tblcandidate";
                                        $query_result = mysqli_query($conn, $sql);
                                        $result = mysqli_num_rows($query_result);
                                    ?>
                                    <thead>
                                        <tr>
                                            <th>Picture</th>
                                            <th>Candidate ID</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Category</th>
                                            <th>Objective</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        if($result > 0){
                                            while($row = mysqli_fetch_array($query_result))
                                            {
                                    ?>
                                        <tr>
                                            <td><img src="../uploads/<?php echo$image = $row['image']; ?>" height="100" width="100"> </td>
                                            <td> <?php echo $row['candidate_id']; ?> </td>
                                            <td> <?php echo $row['fullname']; ?> </td>
                                            <td> <?php echo $row['email']; ?> </td>
                                            <td> <?php echo $row['gender']; ?> </td>
                                            <td> <?php echo $row['category']; ?> </td>
                                            <td> <?php echo $row['objective']; ?> </td>
                                            <td> 
                                                <form action="candidate_reg_update.php" method="POST">
                                                    <input type="hidden" name="can_id" value="<?php echo $row['candidate_id']; ?>">
                                                    <button type="submit" name="btn_candidate_update
                                                    " class="btn btn-warning mb-2">Edit</button>
                                                </form>
                                                <form action="candidate_reg_update.php" method="POST">
                                                    <input type="hidden" name="delete_id" value="<?php echo $row['candidate_id']; ?>">
                                                    <button type="submit" name="btn_delete" class="btn btn-danger"> Delete </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php 

                                            }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>