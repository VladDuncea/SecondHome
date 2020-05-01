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
    
    $sql ="SELECT user_email FROM Users WHERE user_email='{$email}'";
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

// Compress image
function compressImage($source, $destination, $quality) 
{

    $info = getimagesize($source);
  
    if ($info['mime'] == 'image/jpeg') 
      $image = imagecreatefromjpeg($source);
  
    elseif ($info['mime'] == 'image/gif') 
      $image = imagecreatefromgif($source);
  
    elseif ($info['mime'] == 'image/png') 
      $image = imagecreatefrompng($source);
  
    imagejpeg($image, $destination, $quality);
  
}

    //GENERAL UID/UType getter
function getUserData(&$UID,&$UType,$page,$conn)
{
    if(!isset($_POST['security_code']))
    {
        //WEB
        //Verify account level
        session_start();
        if(isset($_SESSION['userType']))
        {
            $UID = $_SESSION['userId'];
            $UType = $_SESSION['userType'];
        }
        else
        {
            $UID = -1;
            $UType = -1;
        }
    }
    else if($_POST['security_code'] == '8981ASDGHJ22123' && isset($_POST['UID']))
    {
        //ANDROID
        if($_POST['UID'] == -1)
        {
            $UID = -1;
            $UType = -1;
        }
        else
        {
            $UID = mysqli_real_escape_string( $conn,$_POST['UID']);
            $sql = "SELECT user_type FROM Users WHERE UID = $UID";
            if(!$result = mysqli_query($conn,$sql))
            {
                $response["status"]=-1;  //Database error
                error_log("SQL ERROR: ".mysqli_error($conn));   //Error logging
                echo json_encode($response);
                return;
            }
            $UType = mysqli_fetch_assoc($result)['user_type'];
        }
    }
    else
    {
        $UID = -2;
        $response["status"]=0;
        $response["err_message"] = "Unauthorzed access!1";
        echo json_encode($response);  
        entry_log($page,"Unknown",$response);     
        return;
    } 
}

?>
