<?php
require_once 'methods.php';
if (!isset($_GET['res'])) {
    $con = null;
    header("Location: index.php");
    return;
}
$formDisplay = 'block';
$logOutButton = 'none';

if (isset($_GET['res'])) {
    $resetPass = strip_tags($_GET['res']);
    $resetPass = filter_var($resetPass, FILTER_SANITIZE_STRING);
    try {
        $sql = "SELECT * FROM verifiedusers WHERE resetPass = :resetPass LIMIT 1";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("resetPass", $resetPass, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($row['email'])) {
            header("Location: index.php");
            return;
        }
        $email = $row['email'];
        $emailHash = md5($email);
        $stmt->closeCursor();
    } catch (PDOException $e) {
        $con = null;
        return;
    }
}
topOfPage("Assetget - Reset your password.", "Reset your forgotten password.");
nextTopOfPage(false, $formDisplay, $logOutButton, $username);
?>

<br>                
<form class="forgotPasswordForm" method='POST' action='resetPasswordScript.php'>
    <?php
    if ($_GET['error'] == '1') {
        echo "<div class='forgotPasswordFormStory'>Your new password does not match the re-typed password.</div>";
    }
    ?>
    <?php
    if ($_GET['error'] == '2') {
        echo "<div class='forgotPasswordFormStory'>Something went wrong. Please try again later.</div>";
    }
    ?>                    
    <br><br>
    <input type="hidden" value='<?php echo $emailHash; ?>' name="user">
    <input type="hidden" value='<?php echo $resetPass; ?>' name="res">
    <input type="password" required class="forgotPasswordInput" placeholder="New Password" name="pass"><br>
    <input type="password" required class="forgotPasswordInput" placeholder="Re-type Password" name="reTypedPassword"><br>
    <input type="submit" value="Submit" class="submitFeedback">
</form>
<br><br><br>
<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>