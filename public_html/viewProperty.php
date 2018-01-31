<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "company");
require_once 'loggedInFormDisplay.php';
$contentID = filter_var(strip_tags(trim($_GET['page'])), FILTER_SANITIZE_NUMBER_INT);
$image = getImages($con, "viewProperty");
topOfPage("Assetget - View more details about the property of your choice.", $description);
?>
<link href="main.css" rel="stylesheet" type="text/css"/>
<?php
displayJsonID(false);
?>
<script>
    var price = "<?php echo $price; ?>";
    price = accounting.formatMoney(price, "₦", 0, ",");
</script>
<?php
require_once 'insertOhSnap.php';
nextTopOfPage(true, $formDisplay, $logOutButton, $username);
require_once 'viewAndDeletePropertyBody.php';
?>

<div class="centerContent">
    It is advised that you contact us and not the advertiser directly.<br>
    If interested contact us (noting the ID of the property) or<br><br>
    <div class="contactUsForm">
        Send us your contact details:<br>
        <form method="POST" action="contact.php" name='contactForm'>
            <input type="text" placeholder="Name" class="contactUsValue" name="nameID" id='contactNameID'><br>
            <input type="tel" placeholder="Phone number" class="contactUsValue" name="tel" id='contactTelID'><br>
            <input type="email" placeholder="Email Address" class="contactUsValue" name="email" id='contactEmailID'><br>
            <input type="hidden" name="contentID" value="<?php echo $contentID; ?>">
            <input type="submit" value="Submit" class="deleteButton" id='contactSubmitButtonID'>
        </form>
    </div>
</div>
<?php require_once 'bottomOfPage.php'; ?>
<script src="js/viewProperty.js"></script>
<?php require_once 'endOfPage.php'; ?>