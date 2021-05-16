<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registration Page</title>

    <!-- Custom fonts for this template-->
    <script src="./sweetalert2/jquery-3.6.0.min.js"></script>
    <script src="./sweetalert2/sweetalert2.all.min.js"></script>
    <link href="fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

    <?php
    include_once('./includes/config.php');
    include_once('./includes/session.php');
    include_once('./includes/redirect.php');

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

        // Form Validation
        if(empty($fullname)){
            //$_SESSION['error'] = "Full Name Field is Empty";
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
        ?>

        <?php
        // Hashing the password the user provided
        $pass = password_hash($password, PASSWORD_DEFAULT);

        // Check if User's email already exist in database
        $sql = "SELECT * FROM tblregister WHERE email = '$email'";
        $query_result = mysqli_query($conn, $sql);
        $result = mysqli_num_rows($query_result);
        if($result > 0){
            //$_SESSION['error'] = "This Email Address Already Exist";

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
            $sql = "INSERT INTO tblregister (fullname, email, password, usertype) VALUES('$fullname', '$email', '$pass', 'User')";
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
                RedirectTo('index.php');
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

?>


    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-md-block bg-login-image">
                                <img src="./img/undraw_rocket.svg" height="400" width="400">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create An Account!</h1>
                                    </div>
                                    <form action="register.php" method="POST">
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
                                            <a href="index.php" class="btn btn-danger">Back</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>