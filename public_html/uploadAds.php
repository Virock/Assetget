<?php
require_once 'methods.php';
checkIfUserIsLoggedIn($con, "uploadAds");
require_once 'loggedInFormDisplay.php';
topOfPage("Assetget - Upload details of your property or automobile to be sold or rented out.", "This page assists you in uploading details and images of the property or automobile you wish to sell or rent out.");
nextTopOfPage(true, $formDisplay, $logOutButton, $username);
?>

<br>
<h1 class="docHeader">Upload your Ad</h1>
<form method="POST" action="handleUpload2.php" enctype="multipart/form-data">
    <div class="uploadAdsContainer">
        <div class="divider4">
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    Choose Asset:
                </div>
                <div class="uploadValue">
                    <select onchange="chooseNext1" id='chooseAsset1' name="chooseAsset1" class="uploadValues">                                                                        
                        <?php require_once 'assetTypes.html'; ?>
                    </select>
                </div>
            </div>
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    Category:
                </div>
                <div class="uploadValue">
                    <select id="buyID1" name="buy1" class="uploadValues">                                         
                        <?php require_once 'buySellTypes.html'; ?>
                    </select>
                </div>
            </div>
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    Type:
                </div>
                <div class="uploadValue">
                    <input type="text" name='type1' class="uploadValues" list="typeSeaarchList" title="Leave empty if asset chosen isn't 'Car' or 'House'" style='width: 90%'>
                    <datalist id="typeSeaarchList">                                    
                        <?php require 'houseAssets.html'; ?>
                        <?php require 'carAssets.html'; ?>
                        <option value='Others'>Others</option>
                    </datalist>
                </div>
            </div>
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    Location:
                </div>
                <div class="uploadValue">
                    <select id="stateID1" name="location1" onclick="lagos()" class="uploadValues">    
                        <option value="Lagos">Lagos</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="divide4">
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    LGA:
                </div>
                <div class="uploadValue">
                    <select id="lga1" name="lgaID1" class="uploadValues">                                        
                        <?php require_once 'LGAs.html'; ?>
                    </select>
                </div>
            </div>
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    ₦
                </div>
                <div class="uploadValue">
                    <input type="number" required placeholder="Price" name="price1" class="uploadValues">
                </div>
            </div>
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    Land size:
                </div>
                <div class="uploadValue">
                    <input type="number" class="uploadValues" placeholder="Size(Square meters)" name="landSize" title="Leave empty if asset chosen isn't 'land'" style='width: 90%'>
                </div>
            </div>
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    You are the:
                </div>
                <div class="uploadValue">
                    <select id="ownerID" class="uploadValues" name="ownerID">                                    
                        <option value="Owner">Owner</option>
                        <option value="Agent">Agent</option>                                
                    </select>
                </div>
            </div>
        </div>
        <br><br><br>
        <div>
            Please upload a maximum of 5 images. 2MB max file size for each image.
        </div>
        <input type="file" name="images[]" multiple><br><br>
        <textarea placeholder="Description" name="description1" class="uploadDescription"></textarea><br>
        <div class="filterButtons">
            <input type="submit" value="Upload Ad" class="filterAssetsButton" name="uploadAds">
            <input type="reset" value="Reset" name="resetFilter" class="filterResetButton">
        </div>
    </div>
</form>
<?php require_once 'bottomOfPage.php'; ?>
<?php require_once 'endOfPage.php'; ?>