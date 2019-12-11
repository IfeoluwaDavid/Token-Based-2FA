<?php

require_once('../private/initialize.php');

/*******************************************************/

$errors = [];
$email = '';
$password = '';

if(request_is_post()) 
{
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if(is_blank($email))
    {
        $errors[] = "Email cannot be blank.";
    }
    if(is_blank($password))
    {
        $errors[] = "Password cannot be blank.";
    }

    // if there were no errors, try to login
    if(empty($errors))
    {
        // Using one variable ensures that msg is the same
        $login_failure_msg = "Incorrect Login Credentials";
        $userfound = find_user_with_email($email);
        if($userfound) 
        {
            if(password_verify($password, $userfound['password']))
            {
                sendToken($userfound);
                redirect_to('message.php');
            }
            else
            {
                // username found, but password does not match
                $errors[] = $login_failure_msg;
            }
        }
        else
        {
          // no username found
          $errors[] = $login_failure_msg;
        }
    }
}

?>

<?php $page_title = 'Sign in'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <form action="login.php" method="post">
        
            <h1 class="sign-in-header" > MyFakeU - Sign In </h1>
        	
            <?php echo display_errors($errors); ?>
            
            <div class="login-input-container">
            <i class="fa fa-user icon"></i>
            <input class="sign-in-input" name="email" type="email" placeholder="Email" required>
            </div>
            
            <div class="login-input-container">
            <i class="fa fa-key icon"></i>
            <input class="sign-in-input" name="password" type="password" placeholder="Password" required>
            </div>
            
        	<button name="login" type="submit" class="longprimary">Sign In</button>
        
    </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>