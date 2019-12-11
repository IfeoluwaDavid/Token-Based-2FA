<?php require_once("../private/initialize.php"); ?>
<?php

$message = "";
$token = $_GET['token'];

// Confirm that the token sent is valid
$user = find_user_with_token($token);

if(!isset($user))
{
	// Token wasn't sent or didn't match a user.
	redirect_to('login.php');
}

if(request_is_post() && request_is_same_domain())
{
    $verificationKeySent = getverificationkey($user);
    $verificationkeyInput = $_POST['verificationkey'];

	if(!has_presence($verificationkeyInput))
	{
		$errors[] = "Please enter your verification key.";
	}
	else if($verificationkeyInput != $verificationKeySent)
	{
		$errors[] = "Please try again!";
	}
	else
	{
	    login_user($user);
		delete_usertoken($user);
		redirect_to('index.php');
	}
}
?>

<?php $page_title = 'Sign in'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <?php $url = "verify.php?token=" . u($token); ?>
    <form action="<?php echo $url; ?>" method="POST" accept-charset="utf-8">
        
            <h1 class="sign-in-header" > Verify Your Identity </h1>
            
            <?php echo display_errors($errors); ?>
            
            <div class="login-input-container">
            <i class="fa fa-key icon"></i>
            <input class="sign-in-input" name="verificationkey" type="password" placeholder="Enter the key you were sent..." required>
            </div>
            
        	<button name="verify" type="submit" class="longprimary">Verify</button>
        
    </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>