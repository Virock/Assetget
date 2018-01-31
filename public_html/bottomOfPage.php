<hr>
<div class="testimonials">
    <div class="testimony">
        <div class="nameTestimony">
            Bola
        </div>
        <div class="storyTestimony">
            I got my dream home from your site. It completely removed the stress of searching the whole country for a home.
        </div>
    </div>
    <div class="testimonyTopic">
        <strong>Testimonials</strong>
    </div>
    <div class="testimony1">
        <div class="nameTestimony">
            John
        </div>
        <div class="storyTestimony">                            	
            I had been searching for a place to rent. I lost a lot of money to different agents until i was introduced to assetget.com. Your filter helped me to find my preferred home with ease and help me thank your agent. He was so professional.
        </div>
    </div>
</div>
<div class="mobileTestimonials">
    <div class="mobileTestimonyTopic">
        <strong>Testimonials</strong>
    </div>
    <div class="mobileTestimony">                        
        Bola - I got my dream home from your site. It completely removed the stress of searching the whole country for a home.                        
    </div>
    <div class="mobileTestimony">                        
        John - I had been searching for a place to rent. I lost a lot of money to different agents until i was introduced to assetget.com. Your filter helped me to find my preferred home with ease and help me thank your agent. He was so professional.
    </div>
</div>
<br>
<footer>
    <div class="footerContent">
        <div class="fotterFeedback">
            <form method="POST" action="feedback.php" name="feedbackForm">
                <input required class="feedbackEmail" id="emailFeedbackID" type="email" placeholder="Email Address" name="feedbackEmail">
                <TEXTAREA class="feedbackText" required id="feedbackFeedbackID" placeholder="Feedback" name="feedbackDetails"></TEXTAREA>
                                <div class="submitFeedbackContainer"><input type="submit" value="Send feedback" class="submitFeedback" id='sendFeedbackButton'></div>
                            </form>
                        </div>
                        <div class="contact">
                            <strong>Contact Us</strong><br>
                            <a class="contactFooter" href="tel:08087384836">08087384836</a><br>
                            <a class="contactFooter" href="mailto:support@assetget.com">support@assetget.com</a><br>
                            Suite 6 Water Co-operation Road, Behind Block 199, Jakande Estate, Oke-Afa, Isolo, Lagos.
                        </div>                    
                        <div class="documents">
                            <a class="footerIndivDoc" href="privacy.php">Privacy policy</a><br>
                            <a class="footerIndivDoc" href="terms.php">Terms of Service</a><br>
                            <a class="footerIndivDoc" href="how-it-works.php">How it works</a><br>
                            <a class="footerIndivDoc" href="disclaimer.php">Disclaimer</a><br>
                        </div>
        <?php links(true); ?>
                    </div>
    <?php
    if ($loggedIn) {
        ?>
                                                        <a class="changePass" href="changePassword.php">Change password</a>
        <?php
    }
    ?> 
                    <div class="mobileFooterContents">
                        <br>
        <?php
        if ($loggedIn) {
            ?>
                                                            <a href="changePassword.php" class="footerIndivDoc">Change Password</a>
                                                    <br><br>
            <?php
        }
        ?>
                        <a href="how-it-works.php" class="footerIndivDoc">How it works</a>
                        <br><br>
                        Contact us
                        <br><br>
                        <a href="mailto:support@assetget.com" class="footerIndivDoc">support@assetget.com</a>
                        <br><br>
                        <a href="tel:08087384836" class="footerIndivDoc">08087384836</a>
                        <br><br>
                        Suite 6 Water Co-operation Road, Behind Block 199, Jakande Estate, Oke-Afa, Isolo, Lagos.
                        <br><br>
        <?php links(false); ?>
                        <br><br>
                        <div class="mobileDocuments">
                            <div class="mobileIndivDoc">
                                <a href="privacy.php" class="mobileIndivDocuments">Privacy policy</a>
                            </div>
                            <div class="mobileIndivDoc">
                                <a href="terms.php" class="mobileIndivDocuments">Terms of Services</a>
                            </div>
                            <div class="mobileIndivDoc">
                                <a href="company.php" class="mobileIndivDocuments">About Us</a>
                            </div>
                        </div>
                        <br><br>
                    </div>
                </footer>
            </div>
            <div class="rightOut">
                
            </div>
        </div>