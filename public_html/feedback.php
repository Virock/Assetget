<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "company");
require_once 'loggedInFormDisplay.php';
$situation = 5;
if (!isset($_POST['feedbackEmail'])) {
    $situation = 1; //Individual did not input email address            
} else if (!isset($_POST['feedbackDetails'])) {
    $situation = 2; //Individual did not input any feedback            
}

$email = strip_tags(trim($_POST['feedbackEmail']));
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$feedback = strip_tags(trim($_POST['feedbackDetails']));
$feedback = filter_var($feedback, FILTER_SANITIZE_STRING);

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $situation = 3; //The email isn't valid      
    if (isset($_POST['javascript'])) {
        echo 'invalidEmail';
        return;
    }
}
if ($situation == 5) {
    $to = 'support@assetget.com';
    $subject = 'Feedback (assetget.com)';
    $message = $feedback;
    $message = wordwrap($message, 70);
    $headers = "From: " . $email . "\r\n";
    $headers .= 'Content-Type: text/plain; charset=utf-8';
    mail($to, $subject, $message, $headers);


    $to = $email;
    $subject = 'Thank you (assetget.com)';
    $message = "<h3 align='center'>Thank you for your feedback</h3><p>It is out utmost desire to serve you better. We will contact you as soon as possible if neccesary.</p><p>Have a nice day.</p>";
    $message = wordwrap($message, 70);
    $headers = "From: support@assetget.com\r\n";
    $headers .= 'Content-Type: text/html; charset=utf-8';
    mail($to, $subject, $message, $headers);

    $situation = 4; //Worked perfectly  
    if (isset($_POST['javascript'])) {
        echo 'success';
        return;
    }
}
topOfPage("Assetget - Send us your feedback, ideas and suggestions.", "We are always happy to hear from you. Send us your ideas.");
?>
<?php if ($situation == 4) { ?><meta http-equiv="refresh" content="6; URL=index.php"/><?php } ?>

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
<form class="forgotPasswordForm" method="POST">
    <?php
    if ($situation == '1') {
        echo "<div class='forgotPasswordFormStory'>You didn't enter an email address.</div>";
    }
    ?>
    <?php
    if ($situation == '2') {
        echo "<div class='forgotPasswordFormStory'>You didn't enter any feedback.</div>";
    }
    ?>
    <?php
    if ($situation == '3') {
        echo "<div class='forgotPasswordFormStory'>Your email address is invalid.</div>";
    }
    ?>                                        
<?php
if ($situation == '4') {
    $display = 'none';
    echo "<div class='forgotPasswordFormStory'>Your feedback has been received. Thank you</div>";
} else {
    $display = 'inline-block';
}
?>
    <br><br>
    <input type="email" required class="forgotPasswordInput" placeholder="Email address" name="feedbackEmail" style="display: <?php echo $display; ?>"><br>
    <textarea required class="forgotPasswordInput" placeholder="Feedback" name="feedbackDetails" style="height: 150px; display: <?php echo $display; ?>"></textarea><br>                    
    <input type="submit" value="Submit" class="submitFeedback" name="changePassword" style="display: <?php echo $display; ?>">
</form>

<br><br><br>
<?php require_once 'bottomOfPage.php'; ?>
<script src="js/noJavascriptfeedback.js"></script>
<?php require_once 'endOfPage.php'; ?>