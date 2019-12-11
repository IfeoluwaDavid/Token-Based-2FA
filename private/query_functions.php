<?php

function find_user_with_email($email) 
{
    global $db;
    
    $sql = "SELECT a.*, b.role_desc, b.department FROM fakeuniversity a, fakeuniversityroles b  
    WHERE a.role_id = b.role_id AND a.email = '". db_escape($db, $email) ."'";
    
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) == 1)
	{
		$user = mysqli_fetch_assoc($result); // find first
		mysqli_free_result($result);
		return $user;
	}
	else
	{
	    return null; 
	}
}

function sendToken($user)
{
    global $db;
    
	$url_token = md5(uniqid(rand()));
	$verify_token = md5(uniqid(rand()));
    $query =  "UPDATE `fakeuniversity` SET `url_token` = '$url_token',  `verify_token` = '$verify_token' WHERE `userid` = ".$user['userid'];
	
	if(mysqli_query($db, $query))
	{
        $to = $user['email'];
        $title = "Verify your identity";
        $headers = "From: noreplysecurity@fakeuniversity.ca";
        $message = "Verification URL: http://sharmadese.site/FakeUniversity/public/verify.php?token=".u($url_token);
        $message .= "\n\nVerification Key: ".u($verify_token);
        mail($to,$title,$message,$headers);
        return true;
	}
	else
	{
	    return null;
	}
}

function getverificationkey($user)
{
	global $db;
    $query =  "SELECT verify_token FROM fakeuniversity WHERE userid = '". db_escape($db, $user['userid']) ."' ";
    $result = mysqli_query($db, $query);

	
	if(mysqli_num_rows($result) == 1)
	{
        $user = mysqli_fetch_assoc($result); // find first
		mysqli_free_result($result);
		return $user['verify_token'];
	}
	else
	{
	    return null;
	}
}

function find_user_with_token($token)
{
	global $db;
	
    $query = "SELECT a.*, b.role_desc, b.department FROM fakeuniversity a, fakeuniversityroles b  
    WHERE a.role_id = b.role_id AND a.url_token = '". db_escape($db, $token) ."'";
	
    $result = mysqli_query($db, $query);
	
	if(mysqli_num_rows($result) == 1)
	{
	    //echo $query;
        $user = mysqli_fetch_assoc($result); // find first
		mysqli_free_result($result);
		return $user;
	}
	else
	{
	    //echo $query;
	    return null;
	}
}

function delete_usertoken($user)
{
    global $db;
    
    $query =  "UPDATE `fakeuniversity` SET `url_token` = NULL, `verify_token` = NULL WHERE `userid` = ".$user['userid'];
	if(mysqli_query($db, $query))
	{
	    return true;
	}
	else
	{
	    return false;
	}
}

function getuserpermissions($roleid)
{
    global $db;
    $userpermissions = array();
    
    $query = "SELECT perm_desc FROM fakeuniversityacm WHERE `$roleid` = '1'";
    $result = mysqli_query($db, $query);
    
    while($row = mysqli_fetch_array($result))
    {
        array_push($userpermissions, $row['perm_desc']);
    }
    return $userpermissions;
}

?>