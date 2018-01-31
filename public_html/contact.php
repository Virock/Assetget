<?php

error_reporting(0);
if (isset($_POST['contentID'])) {
    if (isset($_POST['email']) || isset($_POST['tel'])) {
        $tel = strip_tags(trim($_POST['tel']));
        if ($_POST['tel'] == '') {
            $tel = 1;
        }
        $tel = filter_var($tel, FILTER_SANITIZE_STRING);
        $contentID = strip_tags(trim($_POST['contentID']));
        $contentID = filter_var($contentID, FILTER_SANITIZE_NUMBER_INT);
        if (filter_var($contentID, FILTER_VALIDATE_INT) === false) {
            if (isset($_POST['javascript'])) {
                echo 'exception';
                return;
            }
            header("Location: contactConfirmation.php?error=1");    //ContentID is wrong
            return;
        }
        $email = strip_tags(trim($_POST['email']));
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if ($tel == 1) {
            $tel = "No number provided";
        }
        if ($email == '') {
            $email = 'No email address provided';
        }

        $name = strip_tags(trim($_POST['nameID']));
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        if ($name == '') {
            $name = "No name provided";
        }

        $message = "Client name: $name\n\r";
        $message .= "Client number: $tel\n\r";
        $message .= "Client email address: $email\n\r";
        $message .= "Client is interested in content ID: $contentID\n\r";
        $message = wordwrap($message, 70);
        $headers = "From: no-reply@assetget.com\r\n";
        $headers .= 'Content-Type: text/plain; charset=utf-8';
        mail('support@assetget.com', 'Interested client (assetget.com)', $message, $headers);

        if ($email != 'No email address provided') {
            $to = $email;
            $subject = 'Thank you (assetget.com)';
            $message = "<h3 align='center'>Thank you for using assetget</h3><p>We have received your contact details and the porperty of your choice. We will contact you shortly</p><p>Have a nice day.</p>";
            $message = wordwrap($message, 70);
            $headers = "From: support@assetget.com\r\n";
            $headers .= 'Content-Type: text/html; charset=utf-8';
            mail($email, $subject, $message, $headers);
        }
        if (isset($_POST['javascript'])) {
            echo 'success';
            return;
        }
        header("Location: contactConfirmation.php");    //Take the user to a screen that confirms that the message has been sent and diverts back to the calling page
        return;
    }
}
if (isset($_POST['javascript'])) {
    echo 'exception';
    return;
}
header("Location: contactConfirmation.php?error=1");    //ContentID is wrong
return;
?>