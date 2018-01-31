$(document).ready(function ()
{
    $('form[name=forgotPasswordForm]').submit(function (e)
    {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("javascript", "true");
        $.ajax({
            type: "POST",
            url: "forgotPass.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result)
            {
                if (result == 'invalidEmail')
                {
                    ohSnap('The email address entered is invalid', {'color': 'red', 'duration': '5000'});
                    return;
                } else if (result == 'success')
                {
                    ohSnap('Password reset instructions have been sent to the email address given if it exists in our database', {'color': 'green', 'duration': '4000'});
                    document.getElementById('emailPassID').value = '';
                    setTimeout(forgotPass, 4000);
                    return;
                } else if (result == 'exception')
                {
                    ohSnap('Something went wrong. Please try again later.', {'color': 'red', 'duration': '5000'});
                    return;
                }
            }
        });
    });
});