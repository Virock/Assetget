<?php
    ini_set('display_errors', 0);
    error_reporting(0);
    if (isset($_COOKIE['loggedIn']))
    {
        setcookie("loggedIn", "", time() - 3600, "/");
        $url = filter_var(strip_tags(trim($_SERVER['HTTP_REFERER'])), FILTER_SANITIZE_URL);
        header("Location: $url"); 
        return;
    }
    
    header("Location: index.php");
    return;
?>