<?php require_once("../private/initialize.php"); ?>
<?php require_login(); ?>

<?php

if(isset($_POST["logout"]))
{
    logout_user();
    redirect_to('login.php');
}

?>

<?php $page_title = 'Auth. Message'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
    
    <form action="index.php" method="post">
        
        <h2 class="sign-in-header" > <?php echo "You're now logged in!"; ?> </h2>
        
        <p> <?php echo "Full Name: ".$_SESSION['userfirstname']." ".$_SESSION['userlastname']."."; ?> </p>
        <p> <?php echo "Email: ".$_SESSION['useremail']."."; ?> </p>
        <p> <?php echo "Role: ".$_SESSION['userrole']."."?> </p>
        <p> <?php echo "Department: ".$_SESSION['userdepartment']."."; ?> </p>
        
        <h2 class="sign-in-header" > <?php echo "Here's what you can do"; ?> </h2>
        
        <?php 
        
        $userpermissions = array();
        $userpermissions = getuserpermissions($_SESSION['userroleid']);
        $userpermissionslength = count($userpermissions);

        for($i = 0; $i < $userpermissionslength; $i++)
        {
            echo "<p> ".$userpermissions[$i]."</p>";
        }
        
        ?>
        
        <button name="logout" type="submit" class="longsecondary">Log Out</button>
        
    </form>
    
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>