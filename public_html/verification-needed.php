<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "forgotPassword");
require_once 'loggedInFormDisplay.php';
topOfPage("Assetget - Verify your account via your email address.", "This page is confirmation that your account has been created but will need verification before you can start posting Ads.");
require_once 'insertOhSnap.php';
nextTopOfPage(true, $formDisplay, $logOutButton, $username);
?>
<br>
<br>
<?php if ($_GET['error'] == 1) { ?><p class="passText">This account exists but has not been verified. Please check the email sent to you for verification.</p><br><?php } ?>
<?php if ($_GET['error'] == 2) { ?><p class="passText">This account already exists. Login to upload your ads.</p><br><?php } ?>
<?php if (!isset($_GET['error'])) { ?><p class="passText">An email has been sent to your email address.<br>Click the link in the email to verify your account</p><br><?php } ?>
<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>