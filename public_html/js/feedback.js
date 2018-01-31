$(document).ready(function ()
{
    $('form[name=feedbackForm]').submit(function (e)
    {
        document.getElementById('sendFeedbackButton').value = 'Sending';
        document.getElementById('sendFeedbackButton').disabled = true;
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("javascript", "true");
        $.ajax({
            type: "POST",
            url: "feedback.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result)
            {
                document.getElementById('sendFeedbackButton').value = 'Send feedback';
                document.getElementById('sendFeedbackButton').disabled = false;
                if (result == 'invalidEmail')
                {
                    ohSnap('The email address entered is invalid', {'color': 'red', 'duration': '5000'});
                    return;
                } else if (result == 'success')
                {
                    ohSnap('Your feedback has been received. Thank you', {'color': 'green', 'duration': '5000'});
                    document.getElementById('emailFeedbackID').value = '';
                    document.getElementById('feedbackFeedbackID').value = '';
                    return;
                }
            }
        });
    });
});