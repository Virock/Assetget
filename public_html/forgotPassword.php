<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "forgotPassword");
require_once 'loggedInFormDisplay.php';
$display = 'inline-block';
topOfPage("Assetget - Recover your password.", "This page is used to recover your password with your email address.");
?>
<?php if ($_GET['error'] == 2) { ?><meta http-equiv="refresh" content="4; URL=index.php"/><?php } ?>

<script>
    function forgotPass()
    {
        window.open("index.php", "_self", "", "true");
        return;
    }
</script>

<?php
nextTopOfPage(false, $formDisplay, $logOutButton, $username);
?>
<br>
<form class="forgotPasswordForm" method="POST" action="forgotPass.php" name="forgotPasswordForm"> 
    <?php
    if ($_GET['error'] == 1) {
        echo "<div class='forgotPasswordFormStory'>The email address entered is invalid.</div><br><br>";
    }
    ?>
    <?php
    if ($_GET['error'] == 2) {
        $display = 'none';
        echo "<div class='forgotPasswordFormStory'>Password reset instructions have been sent to your email address.</div><br><br>";
    }
    ?>
    <?php
    if ($_GET['error'] == 3) {
        echo "<div class='forgotPasswordFormStory'>Something went wrong. Please ty again later.</div><br><br>";
    }
    ?>
    <?php
    if (!isset($_GET['error'])) {
        echo "<div class='forgotPasswordFormStory'>Password reset instructions will be sent to your email address<br>if the email address was used to open your account</div><br><br>";
    }
    ?>
    <input style='display: <?php echo $display; ?>' type="email" required id="emailPassID" class="forgotPasswordInput" placeholder="Enter your email address" name="email"><br>
    <input type="submit" style='display: <?php echo $display; ?>' value="Submit" class="submitFeedback">
</form>

<br><br><br>
<?php require_once 'bottomOfPage.php'; ?>
<script src="js/forgotPassword.js"></script>
<?php require_once 'endOfPage.php'; ?>