<?php
require_once 'methods.php';
//Check if user is logged in
checkIfUserIsLoggedIn($con, "changePassword");
require_once 'loggedInFormDisplay.php';
topOfPage("Assetget - Change your password.", "Change your password to something complex.");
require_once 'insertOhSnap.php';
nextTopOfPage(false, $formDisplay, $logOutButton, $username);
?>  
<br>
<form class="forgotPasswordForm" method="POST" action="changePassScript.php" name="changePasswordForm">  
    <?php
    if ($_GET['error'] == '0') {
        echo "<div class='forgotPasswordFormStory'>Incorrect password.</div>";
    }
    ?>
    <?php
    if ($_GET['error'] == '1') {
        echo "<div class='forgotPasswordFormStory'>Something went wrong. Please try again later.</div>";
    }
    ?>
    <?php
    if ($_GET['error'] == '2') {
        echo "<div class='forgotPasswordFormStory'>Your new password does not match the re-typed password.</div>";
    }
    ?>                    
    <br><br>
    <input type="password" required class="forgotPasswordInput" placeholder="Current Password" name="currentPassword"><br>
    <input type="password" required class="forgotPasswordInput" placeholder="New Password" name="pass"><br>
    <input type="password" required class="forgotPasswordInput" placeholder="Re-type new password" name="retypedPass"><br>
    <input type="hidden" name="userID" value="<?php echo $userID; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="submit" value="Submit" class="submitFeedback" name="changePassword" id='submitChangePassword'><br class='loader' id='loaderBr'>
    <img src='images/loader.gif' class='loader' id='loaderGif'>
</form>
<br><br><br>
<?php require_once 'bottomOfPage.php'; ?>
<script src="js/changePassword.js"></script>
<?php require_once 'endOfPage.php'; ?>