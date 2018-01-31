<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "company");
require_once 'loggedInFormDisplay.php';
topOfPage("Assetget - About us page.", "Assetget is the #1 online real estate and property listings service in Nigeria.");
nextTopOfPage(true, $formDisplay, $logOutButton, $username);
?>
<br>
<h1 class="docHeader">About Us</h1>
<p class="docText">ASSETGET.COM is the #1 online real estate and property website in Nigeria with property listings for sale, rent and lease, an online market place that connect buyers (property seekers) and property sellers.</p><br>
<p class="docText">We provide property seekers an easy way to find details of property to various houses, land, cars, shops, office spaces and other commercial properties to buy or rent. We also provide a platform for advertising property from organizations and Nigerian private property owners.</p><br>
<p class="docText">We serve as an intermediary to property buyers and sellers, assisting the buyers or users to secure a property in Nigeria with our professional property agents and surveyors, and also assisting property owners or agents to advertise their various properties online on our website.</p>
<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>