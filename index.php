
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Page</title>

    <!-- Custom fonts for this template-->
    <script src="./sweetalert2/jquery-3.6.0.min.js"></script>
    <script src="./sweetalert2/sweetalert2.all.min.js"></script>
    <link href="fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

    <?php
    include_once('./includes/config.php');
    include_once('./includes/session.php');
    include_once('./includes/redirect.php');

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Preventing SQL Injection
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        ?>

        <?php
        // Form Validation
        if(empty($email)){
            //echo '<script> alert("Email Address Field is Empty"); </script>';
        ?>

        <script>
            Swal.fire({
            text: 'Email Address Field is Empty',
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
        else{
            // Check if the details provided by user exist in database
            $sql = "SELECT * FROM tblregister WHERE email = '$email' AND usertype = 'User'";
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_num_rows($query_result);
            if($result > 0){
                while($row = mysqli_fetch_array($query_result)){
                    $fullname = $row['fullname'];
                    $email = $row['email'];
                    $pass = $row['password'];
                    $usertype = $row['usertype'];

                    // Pass retrived data into session
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['usertype'] = $usertype;
                    ?>

                    <?php

                    if(password_verify($password, $pass)){
                        RedirectTo('dashboard.php');
                    }else{
                        //echo '<script> alert("Invalid Password/Username Provided"); </script>';
                    ?>

                    <script>
                        Swal.fire({
                        text: 'Invalid Password/Username Provided',
                        icon: 'error',
                        button: 'error',
                        })
                    </script>

                    <?php
                    }
                }
            }
            else{
                //echo '<script> alert("Invalid Details Provided"); </script>';
            ?>

            <script>
                Swal.fire({
                text: 'Invalid Details Provided',
                icon: 'error',
                button: 'error',
                })
            </script>

            <?php
            }
        }
        
    }



?>

    <div class="container mt-5">

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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="index.php" method="POST">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control"
                                              placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary form-control"
                                              name="login" value="Login">
                                        </div>
                                    <div class="text-center">
                                        <a class="small" href="forget_password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-dark"> &nbsp; Don't havean Account?<a class="small" href="register.php">Create an Account!</a></p>
                                    </div>
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