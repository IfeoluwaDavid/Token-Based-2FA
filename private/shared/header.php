<?php

    if(!isset($page_title))
    {
        $page_title = 'Staff Area'; 
    }
  
?>

<!doctype html>

<html lang="en">
    
  <head>
    <title>Fake University - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/style.css'); ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
