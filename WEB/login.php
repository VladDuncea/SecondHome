<!DOCTYPE html>
<html>
<head>
<?php include 'pieces/head.php' ?>
</head>

<body class="hold-transition login-page">

<!--- LOGIN PHP -->
<?php
include "server/php/connection.php";

//Utilizatorul este deja conectat
if(isset($_SESSION['userType']))
	echo"<script>window.location = '/index.php';</script>";


if(isset($_POST['email']))
{
    //get variables and protect from sql injection
    $user_email = mysqli_real_escape_string( $conn,$_POST['email']);
    $user_password = $_POST['password'];

	$sql ="SELECT * FROM Users WHERE user_email='$user_email'";
	if(!$result = mysqli_query($conn,$sql))
    {
        //Database error show red banner                      
        echo '<div class="callout callout-danger"><center>Eroare server</center></div>';
        return;
    }
    //get data from database
	if($row = mysqli_fetch_assoc($result))
	{
        //check correct password
		if(password_verify($user_password,$row["user_password"]))
		{
			$_SESSION['userId']=$row["UID"];
			$_SESSION['userType']=$row["user_type"];
            $_SESSION['FirstName']=$row["first_name"];
            $_SESSION['LastName']=$row["last_name"];
            
            //imaginea de pe gravatar
            $_SESSION['userImg']=get_gravatar($user_email);
            
			if(isset($_POST['cookie']) && $_POST['cookie']=="Yes")
			{
				$Token = bin2hex(openssl_random_pseudo_bytes(20));
				
				$sql ="INSERT INTO cookies (Token,UID) VALUES ('$Token','{$row["UID"]}')";
				if(mysqli_query($conn,$sql))
				{
					setcookie("SecondHomeWeb", $Token, time() + (3600 * 24 * 7), "/");
				}
                else
                {
					error_log("Connection failed".mysqli_error($conn));				
                }
            }
            
            //trimite utilizatorul la index
			echo"<script>window.location = '/index.php';</script>";
            return;
        }
	}
	//Conexiunea a esuat din vina utilizatorului
	echo '<div class="callout callout-danger"><center>Combinatia User/Parola nu este corecta</center></div>';
}

if(isset($_COOKIE["SecondHomeWeb"]))
	log_in_cookie($_COOKIE["SecondHomeWeb"],$conn);

//Nu e implementata inca
function log_in_cookie($token,$conn)
{
	$sql1 ="SELECT * FROM cookies WHERE Token = '$token'";
	$result1 = mysqli_query($conn,$sql1);
	if($row1 = mysqli_fetch_assoc($result1))
	{
		$sql2 ="SELECT * FROM Users WHERE UID='{$row1['UID']}'";
		$result2 = mysqli_query($conn,$sql2);
		if($row2 = mysqli_fetch_assoc($result2))
		{
            $email=$row2["email"];
            
            $_SESSION['userId']=$row2["UID"];
            $_SESSION['userType']=$row2["user_type"];
            $_SESSION['FirstName']=$row2["first_name"];
            $_SESSION['LastName']=$row2["last_name"];
                        
            $_SESSION['userImg']=get_gravatar($email);  

            setcookie("SecondHomeWeb", $token, time() + (3600 * 24 * 7), "/");
            echo"<script>window.location = '/index.php';</script>";	
        }
        else
            error_log("Connection failed".mysqli_error($conn));				

    }
    else
        error_log("Connection failed".mysqli_error($conn));				

}

//functie care ia gravatarul utilizatorului
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

?>

    <div class="login-box">
        <div class="login-logo">
            <a href="index.php"><b>S</b>econd<b>H</b>ome</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Autentificare</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Parolă" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="cookie" value="Yes" id="remember">
                                <label for="remember">
                                    Ține-mă minte
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4.5">
                            <button type="submit" class="btn btn-primary btn-block">Conectare</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- </form> -->

                    <!-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
                    <!-- /.social-auth-links -->

                    <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p> -->
                    <p class="mb-0">
                        <a href="register.php" class="text-center">Crează cont</a>
                    </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>

</html>