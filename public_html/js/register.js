$(document).ready(function ()
{
    $('form[name=forgotPasswordForm]').submit(function (e)
    {
        e.preventDefault();
        if ($('#passID').val() !== $('input[name=cPassword1]').val())
        {
            ohSnap('Passwords do not match', {'color': 'red', 'duration': '3000'});
            return;
        }
        document.getElementById('registerButtonID').value = 'Registering';
        document.getElementById('registerButtonID').disabled = true;
        var formData = new FormData(this);
        formData.append("javascript", "true");
        $.ajax({
            type: "POST",
            url: "registerPerson.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result)
            {
                document.getElementById('registerButtonID').value = 'Register';
                document.getElementById('registerButtonID').disabled = false;
                if (result == 'invalidEmail')
                {
                    ohSnap('Your email address is invalid', {'color': 'red', 'duration': '3000'});
                    return;
                } else if (result == 'passwordMismatch')
                {
                    ohSnap('Your password does not match its re-typed value', {'color': 'red', 'duration': '5000'});
                    return;
                } else if (result == 'passwordMisMatch')
                {
                    ohSnap('Passwords do not match', {'color': 'red', 'duration': '3000'});
                    return;
                } else if (result == 'success')
                {
                    ohSnap('Your account has been created. Check your email inbox or spam folder for verification', {'color': 'green', 'duration': '5000'});
                    return;
                } else if (result == 'exception')
                {
                    ohSnap('Something went wrong. Please try again later', {'color': 'red', 'duration': '3000'});
                    return;
                } else if (result == 'exists')
                {
                    ohSnap('This account already exists. Login to upload your ads', {'color': 'blue', 'duration': '5000'});
                    return;
                }
            }
        });
    });
});