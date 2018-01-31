<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "handleUpload2");
require_once 'loggedInFormDisplay.php';
topOfPage("Assetget - Your password has been successfully changed.", "This page alerts you that your password has been changed successfully then redirects you to the homepage.");
nextTopOfPage(true, $formDisplay, $logOutButton, $username);
?>
<br>
<br>
<p class="passText">Your password has been changed successfully</p><br>                
<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>