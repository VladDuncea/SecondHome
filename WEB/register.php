<!DOCTYPE html>
<html>

<head>
<?php include 'pieces/head.php' ?>
</head>

<body class="hold-transition register-page">

<!--PHP register-->
<?php
include "server/php/connection.php";
include "server/php/header.php";

if(isset($_POST['first_name']))
{
    //Get data and sanitize
    $user_email = mysqli_real_escape_string( $conn, $_POST['email'] );
    $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_firstname = mysqli_real_escape_string( $conn, $_POST['first_name']);    
    $user_lastname  = mysqli_real_escape_string( $conn, $_POST['last_name']);

    $val = check_email($user_email,$conn);
    if($val == -1)
    {
        echo '<div class="callout callout-danger"><center>Eroare server</center></div>';
    }
    else if ($val == 1)
    {
        echo '<div class="callout callout-danger"><center>Emailul este deja in uz</center></div>';
    }
    else
    {
        $sql="INSERT INTO Users (first_name, last_name, user_password, user_email) VALUES ('$user_firstname','$user_lastname','$user_password','$user_email')";
        if(!$result = mysqli_query($conn,$sql))
        {
            echo '<div class="callout callout-danger"><center>A aparut o eroare, va rugam sa reincercati!</center></div>';
        }
        else
        {
            //Send welcome email to new User
            $subject = "Bine ati venit la SecondHome";
            $txt = "Buna ziua, \n va multumim ca ati ales sa fiti client SecondHome!";
            $headers = 'From: SecondHome <secondhome@fragmentedpixel.com>' . "\r\n" .
            'Reply-To: secondhome@fragmentedpixel.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            mail($user_email,$subject,$txt,$headers); //Email
            
            echo '<div class="callout callout-success"><center>Contul a fost creat cu succes <br/> Veti fi redirectionat catre autentificare in scurt timp!</center></div>';
            echo '<meta http-equiv="refresh" content="3;url=login.php"/>';
        }
    }
}
?>
    <div class="register-box">
        <div class="register-logo">
            <a href="index.php"><b>S</b>econd<b>H</b>ome</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Înregistrare</p>

                <form action="register.php" role="form" id="register_form" novalidate="novalidate" method="post"><!--onsubmit="return validateForm()"-->
                    <div class="input-group mb-3">
                        <input type="text" name="first_name" class="form-control" placeholder="Prenume" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="last_name" class="form-control" placeholder="Nume" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="pass1" name="password" class="form-control" autocomplete="new-password" placeholder="Parolă" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="pass2" name="password_again" class="form-control" autocomplete="new-password" placeholder="Rescrie parola" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms" class="custom-control-input" value="agree" id="exampleCheck1">
                                    <label class="custom-control-label" for="exampleCheck1">Sunt de accord cu <a href="#">termenii</a>.</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4.5">
                            <button type="submit" class="btn btn-primary btn-block">Înregistrare</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="login.php" class="text-center">Am deja cont</a>
            </div>
            <!-- /.form-box -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.register-box -->

   

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <script>
    function verif_email(value, element)
    {
        var data = {'user-email': value}
        var ret = true;
        $.post('server/checkemail.php', data, function(result, status) {
                
            }).done(function() {
            })
            .fail(function(jqxhr, settings, ex) { alert('failed, ' + ex); });

        return ret;
    }

    //Daca vrei ceva custom, aici nu merge ca e cu ajax :(
    //jQuery.validator.addMethod("emailUnique", verif_email, "Exista un cont asociat acestui email!");

    $(document).ready(function () {
        $.validator.setDefaults({
            submitHandler: function () {
                $('#register_form')[0].submit();
            }
        });
        $('#register_form').validate({
            rules: {
            first_name:
            {
                required: true
            },
            last_name:
            {
                required: true
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "server/checkemail2.php",
                    type: "post",
                    data: {
                    user_email: function() {
                        return $( "#email" ).val();
                        }
                    }
                }
            },
            password: {
                required: true,
                minlength: 6
            },
            password_again:
            {
                equalTo: '#pass1'
            },
            terms: {
                required: true
            },
            },
            messages: {
            email: {
                required: "Please enter a email address",
                email: "Please enter a vaild email address"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            password_again:
            {
                equalTo: "Passwords do no match"
            },
            terms:
            {
                required:"Please accept our terms"
            } 
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            }
        });
        });
    </script>
</body>

</html>