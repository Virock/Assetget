<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "forgotPassword");
require_once 'loggedInFormDisplay.php';
topOfPage("Assetget - About us page.", "Assetget is the #1 online real estate and property listings service in Nigeria.");
?>
<script>
    function changedPass()
    {
        window.open("index.php", "_self", "", "true");
        return;
    }
</script>
<?php
nextTopOfPage(false, $formDisplay, $logOutButton, $username);
?>
<br>                
<form class="forgotPasswordForm" method='POST' action='registerPerson.php' name='forgotPasswordForm'>    
    <?php if ($_GET['error'] == 1) { ?><div class="forgotPasswordFormStory">The email address entered is invalid</div><br><?php } ?>
    <?php if ($_GET['error'] == 2) { ?><div class="forgotPasswordFormStory">Your password does not match its re-typed value</div><br><?php } ?>
    <?php if ($_GET['error'] == 3) { ?><div class="forgotPasswordFormStory">Something went wrong. Please try again later</div><br><?php } ?>
    <?php if (!isset($_GET['error'])) { ?><div class="forgotPasswordFormStory">Register to upload your Ads<br>An email will be sent to the address given.<br>Activate your account via the email.<br>If you can't find the email in your inbox, check your spam folder</div><br><?php } ?>                    
    <input type="text" required class="forgotPasswordInput" placeholder="Name" name='name1'><br>
    <input type="email" required class="forgotPasswordInput" placeholder="Email address" name='email1'><br>
    <input type="tel" required class="forgotPasswordInput" placeholder="Phone number" name='phone1'><br>
    <input type="password" required class="forgotPasswordInput" placeholder="Password" name='password1' id="passID"><br>
    <input type="password" required class="forgotPasswordInput" placeholder="Re-type Password" name='cPassword1'><br>
    <input type="submit" value="Register" class="submitFeedback" id="registerButtonID">
</form>
<br><br><br>
<?php require_once 'bottomOfPage.php'; ?>
<script src="js/register.js"></script>
<?php require_once 'endOfPage.php'; ?>