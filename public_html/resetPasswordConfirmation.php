<?php
require_once 'methods.php';

$formDisplay = 'block';
$logOutButton = 'none';

topOfPage("Assetget - Get your dream home and automobiles.", "We connect property sellers to buyers. Create an account or log into Assetget to post your ads.");
?>
<meta http-equiv="refresh" content="6; URL=index.php"/>
<?php
nextTopOfPage(false, $formDisplay, $logOutButton, $username);
?>

<br>                
<?php if ($_GET['error'] == 1) { ?><p class="passText">Something went wrong. Please try again later</p><br><?php } ?>
<?php if (!isset($_GET['error'])) { ?><p class="passText">Your password has been successfully reset. Please login.</p><br><?php } ?>
<br><br><br>
<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>