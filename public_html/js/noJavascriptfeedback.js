$(document).ready(function ()
{
    $('form[name=changePasswordForm]').submit(function (e)
    {
        e.preventDefault();
        if ($('input[name=pass]').val() !== $('input[name=retypedPass]').val())
        {
            ohSnap('Passwords do not match', {'color': 'red', 'duration': '3000'});
            return;
        }
        var formData = new FormData(this);
        formData.append("changePassword", "Submit");
        formData.append("javascript", "true");
        $.ajax({
            type: "POST",
            url: "changePassScript.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result)
            {
                if (result == 'wrongCurrentPassword')
                {
                    ohSnap('Wrong password', {'color': 'red', 'duration': '3000'});
                    return;
                } else if (result == 'exception')
                {
                    ohSnap('Something went wrong. Please try again later', {'color': 'red', 'duration': '6000'});
                    return;
                } else if (result == 'passwordMisMatch')
                {
                    ohSnap('Passwords do not match', {'color': 'red', 'duration': '3000'});
                    return;
                } else if (result == 'success')
                {
                    ohSnap('Password changed successfully', {'color': 'green', 'duration': '3000'});
                    setTimeout(changedPass, 3000);
                    return;
                }

            }
        });
    });
});