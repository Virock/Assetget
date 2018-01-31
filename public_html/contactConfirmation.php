<?php
require_once 'methods.php';
//Check if user is logged in    
checkIfUserIsLoggedIn($con, "contactConfirmation");
require_once 'loggedInFormDisplay.php';
topOfPage("Assetget - An agent will contact you soon.", "This page confirms that your property request ticket has been received.");
?>
<meta http-equiv="refresh" content="6; URL=index.php"/>
<?php
nextTopOfPage(true, $formDisplay, $logOutButton, $username);
?>
<br>
<br>
<?php if ($_GET['error'] == 1) { ?><p class="passText">Something went wrong. Please try again later.</p><br><?php } ?>
<?php if (!isset($_GET['error'])) { ?><p class="passText">Thank you. An agent will contact you shortly.</p><br><?php } ?>
<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>