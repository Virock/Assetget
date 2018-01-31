<?php
require_once 'methods.php';
//Check if user is logged in    
checkIfUserIsLoggedIn($con, "delete-property");
require_once 'loggedInFormDisplay.php';
$contentID = filter_var(strip_tags(trim($_GET['page'])), FILTER_SANITIZE_NUMBER_INT);
$image = getImages($con, "delete-property");
topOfPage("Assetget - Delete a sold or incorrectly described property or automobile listing.", "Delete a property or vehicle that has been sold or one which was not described properly.");
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
nextTopOfPage(true, $formDisplay, $logOutButton, $username);
require_once 'viewAndDeletePropertyBody.php';
?>
<div class="centerContent">
    Are you sure you want to delete this property?<br><br>
    <div class="deleteForm">                        
        <form method="POST" action="delete.php">                            
            <input type="submit" value="Delete" class="deleteButton" name="delete">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="<?php echo filter_var(strip_tags(trim($_SERVER['HTTP_REFERER'])), FILTER_SANITIZE_URL); ?>"><input type="button" value="Cancel" class="mobileLog" name="cancel"></a>
            <input type="hidden" value="<?php echo $contentID; ?>" name="contentID">
        </form>                        
    </div>
</div>
<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>