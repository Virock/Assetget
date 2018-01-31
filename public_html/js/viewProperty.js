$(document).ready(function ()
{
    $('form[name=contactForm]').submit(function (e)
    {
        document.getElementById('contactSubmitButtonID').value = 'Sending';
        document.getElementById('contactSubmitButtonID').disabled = true;
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("javascript", "true");
        $.ajax({
            type: "POST",
            url: "contact.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (result)
            {
                document.getElementById('contactSubmitButtonID').value = 'Submit';
                document.getElementById('contactSubmitButtonID').disabled = false;
                if (result == 'exception')
                {
                    ohSnap('Something went wrong. Please try again later.', {'color': 'red', 'duration': '4000'});
                    return;
                } else if (result == 'success')
                {
                    ohSnap('Thank you. An agent will contact you shortly', {'color': 'green', 'duration': '5000'});
                    document.getElementById('contactNameID').value = '';
                    document.getElementById('contactTelID').value = '';
                    document.getElementById('contactEmailID').value = '';
                    return;
                }
            }
        });
    });
});