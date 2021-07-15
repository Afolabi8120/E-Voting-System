

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Forget Password</title>

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

    // Email Verification

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;
        
    require './PHPMailer/PHPMailer/src/Exception.php';
    require './PHPMailer/PHPMailer/src/PHPMailer.php';
    require './PHPMailer/PHPMailer/src/SMTP.php';

    if(isset($_POST['reset_password'])){
        $email = $_POST['email'];

        $code = uniqid();

        // Form validation
        if(empty($email)){
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
        else{
            $sql = "SELECT * FROM tblregister WHERE email = '$email'";
            $query_result = mysqli_query($conn, $sql);
            $result = mysqli_num_rows($query_result);

            if ($result > 0) {
                // Query to insert the code and email
              $sql = "INSERT INTO reset_password (code, email) VALUES('$code', '$email')";
              $result = mysqli_query($conn, $sql);

                // Query to select the code
              $sql = "SELECT * FROM reset_password WHERE email = '$email'";
              $query_result = mysqli_query($conn, $sql);
              while ($row = mysqli_fetch_array($query_result)) {
                      $email = $row['email'];
                      $code = $row['code'];

                      $_SESSION['code'] = $code;
                      $_SESSION['email'] = $email;
                    
                    //PHPMAILER CODE FOR SENDING EMAIL 
      
                    //Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);

                    try {

                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'youremail@gmail.com';                     //SMTP username
                        $mail->Password   = 'yourpassword';                               //SMTP password
                        $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                        //Recipients
                        $mail->setFrom('afolabi8120@gmail.com', 'Mail Sender');
                        $mail->addAddress($email, 'Tech Innovation');     //Add a recipient
                        //$mail->addAddress('peterisibor84@gmail.com');               //Name is optional
                        //$mail->addReplyTo('info@example.com', 'Information');
                        //$mail->addCC('cc@example.com');
                        //$mail->addBCC('bcc@example.com');


                        //Content
                        $url = "http://" .$_SERVER["HTTP_HOST"] ."/Voting/forget_password.php?code=$code";
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Password Reset';
                        $mail->Body    = "<h1>You requested a password reset</h1> . Click <a href = '$url'>this link</a> to do so. <br> If not ignore this message.";
                        $mail->AltBody = '<h3>This is the body in plain text for non-HTML mail clients</h3>';

                        $mail->send();
                        ?>

                        <script>
                            Swal.fire({
                            text: 'A link to reset your password has been sent to your email address',
                            icon: 'success',
                            button: 'success',
                            })
                        </script>

                        <?php
                        
                        //echo 'Message has been sent to your email address';
                    } catch (Exception $e) {
                       // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
            else{
                ?>
                <script>
                    Swal.fire({
                    text: 'Invalid email address provided',
                    icon: 'error',
                    button: 'error',
                    })
                </script>

            <?php
            //echo "Invalid email address provided";
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
                                        <h1 class="h4 text-gray-900 mb-4">Reset Password!</h1>
                                    </div>
                                    <form action="forget_password.php" method="POST">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary form-control"
                                              name="reset_password" value="Reset Password">
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
