<?php require_once("../private/initialize.php"); ?>

<?php

if(isset($_POST["backtosignin"]))
{
    redirect_to('login.php');
}

?>

<?php $page_title = 'Auth. Message'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
    
    <form action="message.php" method="post">
        
        <h1 class="sign-in-header" > Shh!... Check your email. </h1>
        <button name="backtosignin" type="submit" class="longprimary">Back to Sign In</button>
        
    </form>
    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>