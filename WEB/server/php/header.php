<?

function entry_log($file_name,$username,$resp) //Data logging function
{
    $formpost = $sep = '';      //Formatting request data
    foreach( $_POST as $key => $value ) {
        $formpost .= $sep . $key . ': ' . $value;
        $sep = ', ';
    }
    $formresp = $sep = '';          //Formatting response(also works with json_encode)
    foreach( $resp as $key => $value ) {
        $formresp .= $sep . $key . ': ' . $value;
        $sep = ', ';
    }

    $log  = "Page: ".basename($_SERVER['PHP_SELF']).PHP_EOL.
            "User: ".$username.PHP_EOL.
            "Addres: ".$_SERVER['REMOTE_ADDR'].' - '.date("d/m/Y, H:i:s").PHP_EOL.
            "Attempt: ".$formpost.PHP_EOL.
            "Response: ".$formresp.PHP_EOL.
            "---------------------".PHP_EOL;

    file_put_contents("logs/log_$file_name.txt", $log, FILE_APPEND);      //Writing to file
}

function check_email($email,$conn)
{
    
    $sql ="SELECT user_email FROM Users WHERE user_email='{$_POST['user-email']}'";
    if(!$result = mysqli_query($conn,$sql))
    {
        $response = -1;  // Database error
        error_log("Connection failed".mysqli_error($conn));  //Error logging
        return $response;
    }

    if($row = mysqli_fetch_assoc($result))
    {
        $response = 1; //Email is in use already
    }
    else {
        $response = 0; //Not in use
    }

    return $response;
}

?>
