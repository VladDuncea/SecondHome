<?php
//TRIMITERE EMAIL
if(!isset($_POST['security_code']) || $_POST['security_code']!= '8981ASDGHJ22123')
{
    if(isset($_POST['subject'],$_POST['body'],$_POST['email']))
    {
        //Send welcome email to new User
        $subject = $_POST['subject'];
        $txt = $_POST['body'];
        $headers = "From: {$_POST['email']}" . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        if(mail("secondhome@fragmentedpixel.com",$subject,$txt,$headers)) //Email
        {
            $response['status'] = 1;
        }
        else
        {
            $response['status'] = -1;
            $response['err_message'] = "Error on sending email";
        }
        entry_log("sendmail","Unknown",$response);     
        echo json_encode($response);  
        return;
    }
    else
    {
        $response["status"]=0;
        $response["err_message"] = "Missing parameters";
        entry_log("sendmail","Unknown",$response);     
        echo json_encode($response);  
        return;
    }
}
$response["status"]=-1;
$response["err_message"] = "Unauthoried access";
entry_log("sendmail","Unknown",$response);     
echo json_encode($response);  
return;
?> 