<?php

function login_user($user)
{
    //Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    
    $_SESSION['userid'] = $user['userid'];
    $_SESSION['userfirstname'] = $user['firstname'];
    $_SESSION['userlastname'] = $user['lastname'];
    $_SESSION['useremail'] = $user['email'];
    $_SESSION['userroleid'] = $user['role_id'];
    $_SESSION['userrole'] = $user['role_desc'];
    $_SESSION['userdepartment'] = $user['department'];
    
    return true;
}

function logout_user()
{
    session_unset();
    return true;
}

function is_logged_in()
{
    return isset($_SESSION['userid']);
}

function require_login()
{
    if(!is_logged_in())
    {
        redirect_to(url_for('login.php'));
    }
    else
    {
        /* Do Nothing */
    }
}

?>
