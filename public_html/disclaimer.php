<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "disclaimer");
require_once 'loggedInFormDisplay.php';
topOfPage("Assetget - Disclaimer page.", "Herein lies our disclaimer.");
nextTopOfPage(true, $formDisplay, $logOutButton, $username);
?>
<br>
<h1 class="docHeader">Disclaimer</h1>                                
<p class="docText">This website makes no representations or warranties, express or implied. Assetget makes no representations or warranties related to this website or the information and materials provided on this website. Assetget does not warrant that this website will be available at any or all times, or that the information contained on this website is accurate, complete, non-misleading or true. No information on this website is intended as advice of any kind.</p><br>
<p class="docText">Assetget assumes no liability in relation to the contents of, or use of this website including any indirect, special or consequential loss or for any business losses, loss of revenue, income, profits or anticipated savings, loss of contracts or business relationships, loss of reputation or goodwill, or loss or corruption of information or data.</p><br>
<p class="docText">Your use of this website signifies your agreement that the exclusions and limitations of liability set out in this website disclaimer are reasonable. If you find anything within this disclaimer to be unreasonable you must not use this website.</p>
<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>