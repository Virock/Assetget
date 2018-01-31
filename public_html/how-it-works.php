<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "company");
require_once 'loggedInFormDisplay.php';
topOfPage("Assetget - How we serve and protect you.", "Assetget keeps you safe by being the middle man between buyers and sellers. This keeps fraud of any kind in check.");
nextTopOfPage(true, $formDisplay, $logOutButton, $username);
?>

<br>
<h1 class="docHeader">How it works</h1>                                
<h2 class="docHeader">Summary</h2>

<ol>
    <li class="docText">Advertiser uploads ads.</li>
    <li class="docText">Interested buyer contacts us.</li>
    <li class="docText">We contact advertiser, guiding the buyer to avoid fraud or scam.</li>
    <li class="docText">Buyer purchases intended property.</li>
    <li class="docText">We get our commission from the advertiser only when the property is sold.</li>
</ol>

<h2 class="docHeader">For Buyers</h2>
<p class="docText">When you access our website assetget.com, you will see different property listings: Homes, cars, land, shops etc. To get specific details on the property you desire, use our filter feature. It enables you to choose your preferred type of property, location, price etc. Different properties in your filter range will come up, you then have the opportunity to check out the properties’ details and pictures.</p><br>
<p class="docText">When you are satisfied with the property you see, you then click on the property to view more details. If interested, click on the “interested” button to contact us with the ID of the property or send us your details to commence your purchase of the property. You could either come to our office or we could send you an agent to guide you in inspecting, verifying, and acquiring the property you intend to purchase to mitigate any form of fraud.</p>
<h2 class="docHeader">For advertisers, agents or property owners</h2>
<p class="docText">To advertise on assetget.com, you will need to create an account with us.</p><br>
<p class="docText">To be on our “premier agent” listing, you need to contact us directly.</p><br>
<p class="docText">Our service makes purchasing properties so easy. You don’t need to walk around the whole country to get a property when you can easily come to assetget.com and avoid all the unnecessary stress, hassles and fraud in securing a property. Visit assetget.com today and get the property you always wanted.</p>
<h2 class="docHeader">Premier Agents</h2>
<p class="docText">'Premier agents' are agents or property advertisers that have been screened by us i.e. They have contacted us directly to prove that the properties advertised are real and available but that does not mean that the properties are verified. So if you contact them directly we won’t be liable for any damages caused.</p>

<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>