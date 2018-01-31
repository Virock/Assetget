$(document).ready(function ()
{
    $('form[name=loginForm]').submit(function (e)
    {
        e.preventDefault();
        document.getElementById('loginButtonID').value = 'Logging in';
        document.getElementById('loginButtonID').disabled = true;
        var email = $("#emailDesktop").val();
        var password = $("#passwordDesktop").val();
        var dataString = '&email1=' + email + '&password1=' + password + '&javascript=true';
        $.ajax({
            type: "POST",
            url: "login.php",
            data: dataString,
            cache: false,
            success: function (result)
            {
                document.getElementById('loginButtonID').value = 'Log in';
                document.getElementById('loginButtonID').disabled = false;
                if (result == 'fail')
                {
                    ohSnap('Invalid email or password', {'color': 'red', 'duration': '3000'});
                    return;
                } else if (result == 'exception')
                {
                    ohSnap('Something went wrong. Please try again later', {'color': 'red', 'duration': '6000'});
                    return;
                } else if (result == 'loggedIn')
                {
                    document.location.reload(true);
                    return;
                }
            }
        });
    });
});

$(document).ready(function ()
{
    $('form[name=mobileLoginForm]').submit(function (e)
    {
        e.preventDefault();
        document.getElementById('mobileLoginButtonID').value = 'Logging in';
        document.getElementById('mobileLoginButtonID').disabled = true;
        var email = $("#emailMobile").val();
        var password = $("#passwordMobile").val();
        var dataString = '&email1=' + email + '&password1=' + password + '&javascript=true';
        $.ajax({
            type: "POST",
            url: "login.php",
            data: dataString,
            cache: false,
            success: function (result)
            {
                document.getElementById('mobileLoginButtonID').value = 'Log in';
                document.getElementById('mobileLoginButtonID').disabled = false;
                if (result == 'fail')
                {
                    ohSnap('Invalid email or password', {'color': 'red', 'duration': '3000'});
                    return;
                } else if (result == 'exception')
                {
                    ohSnap('Something went wrong. Please try again later', {'color': 'red', 'duration': '6000'});
                    return;
                } else if (result == 'loggedIn')
                {
                    document.location.reload(true);
                    return;
                }
            }
        });
    });
});