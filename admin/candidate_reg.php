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

    <title>Candidate Registration</title>

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
    include_once('../includes/function.php');

    $candidate_id = 'CID-' . uniqid();

    if(isset($_POST['submit'])){
        // Passing data into a variable
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $category = $_POST['category'];
        $objective = $_POST['objective'];
        $image_name = $_FILES['image']['name'];
        $target = "../uploads/" .$_FILES['image']['name'];

        // Preventing SQL Injection
        $fullname = mysqli_real_escape_string($conn, $fullname);
        $email = mysqli_real_escape_string($conn, $email);
        $gender = mysqli_real_escape_string($conn, $gender);
        $category = mysqli_real_escape_string($conn, $category);
        $objective = mysqli_real_escape_string($conn, $objective);

        ?>

        <?php

        // Form Validation
        if(empty($fullname) || empty($email) || empty($gender) || empty($category) || empty($objective) || $category == 'Select Category' || $gender == 'Select Gender'){
            //echo '<script> alert("All fields are required"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'All fields are required',
                icon: 'error',
                button: 'error',
                })
            </script>

            <?php
        }
        elseif (!preg_match("/^[a-z A-Z]*$/", $fullname)) {
            //echo '<script> alert("Only Alphabets allowed for fullname fields"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'Only Alphabets allowed for fullname fields',
                icon: 'error',
                button: 'error',
                })
            </script>

            <?php
        }
        else{
            //Move image to temporary file location
            move_uploaded_file($_FILES['image']['tmp_name'], $target);

            // Check if Candidate Email Exist from database
            $sql = "SELECT * FROM tblcandidate WHERE email = '$email'";
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_num_rows($query_result);
            ?>

            <?php

            // If email exist a message will be displayed
            if($result > 0){
                //echo '<script> alert("Email Address Already Taken"); </script>';
                ?>

                <script>
                    Swal.fire({
                    text: 'Email Address Already Taken',
                    icon: 'error',
                    button: 'error',
                    })
                </script>

                <?php
            }
            else{
                // This data will be saved into the database if email does not exist
                $sql = "INSERT INTO tblcandidate (candidate_id,fullname,email,gender,category,objective,image) VALUES('$candidate_id','$fullname','$email','$gender','$category','$objective','$image_name')";
                $query_result = mysqli_query($conn, $sql);
                ?>

                <?php
                if($query_result){
                    //echo '<script> alert("Candidate data has been saved successfully"); </script>';
                    ?>

                    <script>
                        Swal.fire({
                        text: 'Candidate data has been saved successfully',
                        icon: 'success',
                        button: 'success',
                        })
                    </script>

                    <?php
                }
                else{
                    //echo '<script> alert("Failed to save candidate data"); </script>';
                    ?>

                    <script>
                        Swal.fire({
                        text: 'Failed to save candidate data',
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
                                        <h1 class="h4 text-gray-900 mb-4 text-center">Candidate Registration</h1>
                                    </div>
                                    <form action="candidate_reg.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Candidate ID</label>
                                            <input type="text" name="candidate_id" class="form-control"
                                                placeholder="Candidate ID..." disabled="" value="<?php echo $candidate_id; ?>">
                                        </div>
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
                                            <label>Gender</label>
                                            <select class="form-select" name="gender" aria-label="Default select example">
                                                <option selected="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>    
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-select" name="category" aria-label="Default select example">
                                                <option selected="">Select Category</option>
                                                <option value="President">President</option>
                                                <option value="Vice President">Vice President</option>
                                                <option value="Senate President">Senate President</option>
                                                <option value="House of Representative">House of Representative</option>
                                                <option value="Governor">Governor</option>
                                                <option value="Minister for Education">Minister for Education</option>
                                            </select>
                                        </div>                                     
                                        <div class="form-group">
                                            <label>Objective</label>
                                            <textarea type="password" name="objective" class="form-control"
                                              placeholder="Enter Objective Here..."></textarea>
                                        </div>
                                        <div class="input-group mb-3">                                  
                                            <input type="file" name="image" class="form-control" id="inputGroupFile01">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                            <a href="welcome.php" class="btn btn-danger">Back</a>
                                        </div>
                                    </form>
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

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>