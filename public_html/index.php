<?php
require_once 'methods.php';
require 'vendor/autoload.php';

use JasonGrimes\Paginator;

//Check if user is logged in    
checkIfUserIsLoggedIn($con, "index");
if (!isset($_GET["page"])) {
    $page = 1;
} else {
    $page = filter_var($_GET["page"], FILTER_SANITIZE_NUMBER_INT);
    if (filter_var($page, FILTER_VALIDATE_INT) === false) {
        header("Location: https://assetget.com");
        return;
    }
}

$statementCounter = 1;
$uLRE = 'false';

$_SESSION["contentID"] = "-1";
$_SESSION["imageCount"] = "0";

require_once 'loggedInFormDisplay.php';

$whereClause = "";
$urlQuery = "";
$browsingThroughMyCatalouge = "";
if (isset($_GET['acceptFilter']) && $_GET['acceptFilter'] == "Filter Assets") {
    //Filter the search query
    $filterMaxPrice = filter_var($_GET["maxPrice"], FILTER_SANITIZE_NUMBER_INT);
    $filterMinPrice = filter_var($_GET["minPrice"], FILTER_SANITIZE_NUMBER_INT);
    $filterAsset = filter_var($_GET["filterChooseAsset"], FILTER_SANITIZE_STRING);
    $filterBuySell = filter_var($_GET["buySell"], FILTER_SANITIZE_STRING);
    $filterStateP = filter_var($_GET["filterState"], FILTER_SANITIZE_STRING);
    $filterType = filter_var($_GET["filterAssetType"], FILTER_SANITIZE_STRING);
    $filterLga = filter_var($_GET["filterLGA"], FILTER_SANITIZE_STRING);
    $minLandSize = filter_var($_GET["minLandSizeCollector"], FILTER_SANITIZE_NUMBER_INT);
    $maxLandSize = filter_var($_GET["maxLandSizeCollector"], FILTER_SANITIZE_NUMBER_INT);
}
if (isset($_GET['yourEntries']) && $_GET['yourEntries'] == "true" && isset($_GET['acceptFilter']) && $_GET['acceptFilter'] == "Filter Assets") {
    //If the user is searching through his entries
    $whereClause = "WHERE userID = '$userID' AND (size >= '" . $minLandSize . "' OR '" . $minLandSize . "' = '') AND (size <= '" . $maxLandSize . "' OR '" . $maxLandSize . "' = '') AND (price <= '" . $filterMaxPrice . "' OR '" . $filterMaxPrice . "' = '') AND (price >= '" . $filterMinPrice . "' OR '" . $filterMinPrice . "' = '') AND (asset = '" . $filterAsset . "' OR '" . $filterAsset . "' = '') AND (buy = '" . $filterBuySell . "' OR '" . $filterBuySell . "' = '') AND (location = '" . $filterStateP . "' OR '" . $filterStateP . "' = '') AND (type = '" . $filterType . "' OR '" . $filterType . "' = '') AND (lga = '" . $filterLga . "' OR '" . $filterLga . "' = '')";
    $urlQuery = "&yourEntries=true&maxPrice=$filterMaxPrice&minPrice=$filterMinPrice&filterChooseAsset=$filterAsset&buySell=$filterBuySell&filterState=$filterStateP&filterAssetType=$filterType&filterLGA=$filterLga&minLandSizeCollector=$minLandSize&maxLandSizeCollector=$maxLandSize&acceptFilter=Filter Assets";
} else if (isset($_GET['yourEntries']) && $_GET['yourEntries'] == "true") {
    //If the user is simply looking through his entries without not searching   
    $browsingThroughMyCatalouge = "true";
    $whereClause = "WHERE userID = '$userID'";
    $urlQuery = "&yourEntries=true";
} else if (isset($_GET['acceptFilter']) && $_GET['acceptFilter'] == "Filter Assets") {
    //If the user is searching
    $whereClause = "WHERE (size >= '" . $minLandSize . "' OR '" . $minLandSize . "' = '') AND (size <= '" . $maxLandSize . "' OR '" . $maxLandSize . "' = '') AND (price <= '" . $filterMaxPrice . "' OR '" . $filterMaxPrice . "' = '') AND (price >= '" . $filterMinPrice . "' OR '" . $filterMinPrice . "' = '') AND (asset = '" . $filterAsset . "' OR '" . $filterAsset . "' = '') AND (buy = '" . $filterBuySell . "' OR '" . $filterBuySell . "' = '') AND (location = '" . $filterStateP . "' OR '" . $filterStateP . "' = '') AND (type = '" . $filterType . "' OR '" . $filterType . "' = '') AND (lga = '" . $filterLga . "' OR '" . $filterLga . "' = '')";
    $urlQuery = "&maxPrice=$filterMaxPrice&minPrice=$filterMinPrice&filterChooseAsset=$filterAsset&buySell=$filterBuySell&filterState=$filterStateP&filterAssetType=$filterType&filterLGA=$filterLga&minLandSizeCollector=$minLandSize&maxLandSizeCollector=$maxLandSize&acceptFilter=Filter Assets";
}
try {
    $sql = "SELECT COUNT(*) as 'num' FROM content $whereClause";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
} catch (PDOException $e) {
    echo $e->getMessage();
}
$totalItems = $row['num'];
$itemsPerPage = 15;
$urlPattern = '/?page=(:num)' . $urlQuery;

$paginator = new Paginator($totalItems, $itemsPerPage, $page, $urlPattern);

topOfPage("Assetget - Get your dream home and automobiles.", "We connect property sellers to buyers. Create an account or log into Assetget to post your ads.");
displayJsonID(true);
require_once 'insertOhSnap.php';
if ($loggedIn) {
    ?>        
    <script src="js/ifLoggedIn.js"></script>
    <?php
}

nextTopOfPage(true, $formDisplay, $logOutButton, $username);
?>              

<div class="explanation">
    <!--Put those site explanatory images here as a slide show-->
    <section class="slideshow">
        <div class="slideshow-container slide">
            <img src="uploads/work/home.png" class="slideImage" alt='Looking for a new home?'>
            <img src="uploads/work/rent.png" class="slideImage" alt='Do you wish to buy, rent or sell your properties?'>
            <img src="uploads/work/search.png" class="slideImage" alt='Searching for buyers or sellers?'>
            <img src="uploads/work/connect.png" class="slideImage" alt='We connect you to the world'>
        </div>
    </section>
</div>
<br>
<form method='GET' id="filterForm">
    <div class="filter">
        <div class="firstSection">
            <div class="chooseSection">
                <div class="chooseAsset">Choose Asset:</div>
                <?php chooseAssetSelectList("chooseAsset1", "chooseAssetSelect"); ?>
            </div>
            <div class="categorySection">
                <div class="category">Category:</div>
                <?php chooseBuySell("categorySelect"); ?>
            </div>
            <div class="categorySection">
                <div class="category">Type:</div>
                <input type="text" class="categorySelect" name='filterAssetType' list="typeSeaarchList" title="Leave empty if asset chosen isn't 'Car' or 'House'">
                <datalist id="typeSeaarchList">
                    <option value=''>All</option>
                    <?php require 'houseAssets.html'; ?>
                    <?php require 'carAssets.html'; ?>
                    <option value='Others'>Others</option>
                </datalist>                                
            </div>
            <div class="categorySection">
                <div class="category">Location:</div>
                <select id="stateID1" name="filterState" onclick="lagos()" class="categorySelect">    
                    <option value="Lagos">Lagos</option>
                </select>
            </div>
        </div>
        <div class="secondSection">
            <div class="categorySection1">
                <div class="category">LGA:</div>
                <?php chooseLGA("categorySelect"); ?>
            </div>
            <div class="categorySection1">
                <div class="category">₦</div>
                <input type="number" placeholder="Max Price" name="maxPrice" class="categorySelect">
            </div>
            <div class="categorySection1">
                <div class="category">₦</div>
                <input type="number" placeholder="Min Price" name="minPrice" class="categorySelect">
            </div>
        </div>
        <div class="thirdSection">
            <div class="categorySection1">
                <div class="category">Land size:</div>
                <input type="number" placeholder="Max size(Square meters)" name="maxLandSizeCollector" class="categorySelect" title="Leave empty if asset chosen isn't 'land'">
            </div>
            <div class="categorySection1">
                <div class="category">Land size:</div>
                <input type="number" placeholder="Min size(Square meters)" name="minLandSizeCollector" class="categorySelect" title="Leave empty if asset chosen isn't 'land'">
            </div>
        </div>
        <?php require 'filterButtons.php'; ?>
    </div>
</form>
<form id="filterFormJavascript" style="display: none" class='mobileSearchForm'>
    <div class="uploadAdsContainer">
        <div class="divider4">
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    Choose Asset:
                </div>
                <div class="uploadValue">
                    <?php chooseAssetSelectList("chooseAssetFilter", "uploadValues") ?>
                </div>
            </div>
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    Category:
                </div>
                <div class="uploadValue">
                    <?php chooseBuySell("uploadValues"); ?>
                </div>
            </div>                            
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    ₦
                </div>
                <div class="uploadValue">
                    <input type="number" placeholder="Max Price" name="maxPrice" class="uploadValues">
                </div>
            </div>
            <div class="uploadAdsIndiv1">
                <div class="uploadValue1">
                    <select id="stateID1" name="filterState" onclick="lagos()" class="uploadValues">    
                        <option value="Lagos">Lagos</option>
                    </select>
                </div>
                <div class="uploadDiscription1">
                    Location:
                </div>                                
            </div>
        </div>
        <div class="divide4">                           
            <div class="uploadAdsIndiv" id="typeFilter">
                <div class="uploadDiscription">
                    Type:
                </div>
                <div class="uploadValue">
                    <select class="uploadValues" id="assetTypeFilter" name='filterAssetType'>
                        <option value="">Any</option>
                    </select>                                    
                </div>
            </div>
            <div class="uploadAdsIndiv" id="spaceType" style="display: none">
                <div class="uploadDiscription">
                    &nbsp;
                </div>
                <div class="uploadValue">

                </div>
            </div>
            <div class="uploadAdsIndiv" id="landSizeMax" style="display: none">
                <div class="uploadDiscription">
                    <span class="mobileSpan">Max Land Size:</span>
                </div>
                <div class="uploadValue">
                    <input type="number" placeholder="Max Size (square meters)" name="maxLandSizeCollector" class="uploadValues">
                </div>
            </div>
            <div class="uploadAdsIndiv" id="landSizeMin" style="display: none">
                <div class="uploadDiscription">
                    <span class="mobileSpan">Min Land Size:</span>
                </div>
                <div class="uploadValue">
                    <input type="number" placeholder="Min Size (square meters)" name="minLandSizeCollector" class="uploadValues">
                </div>
            </div>
            <div class="uploadAdsIndiv" id="space" style="display: block">
                <div class="uploadDiscription">
                    &nbsp;
                </div>
                <div class="uploadValue">

                </div>
            </div>
            <div class="uploadAdsIndiv">
                <div class="uploadDiscription">
                    ₦
                </div>
                <div class="uploadValue">
                    <input type="number" placeholder="Min Price" name="minPrice" class="uploadValues">
                </div>
            </div>
            <div class="uploadAdsIndiv1">
                <div class="uploadValue1">
                    <?php chooseLGA("uploadValues"); ?>
                </div>
                <div class="uploadDiscription1">
                    LGA:                                    
                </div>                                
            </div>
        </div>                        
        <?php require 'filterButtons.php'; ?>
    </div>
</form>
<br>
<div class="sellStuff">
    <div class="sellIndiv">
        <span class="test"><img src="uploads/work/houseSale.png" class="floater" alt='Upload details of buildings to be sold'><div class="floater1">Upload details of buildings to be sold</div></span>
    </div>
    <div class="sellIndiv">
        <span class="test"><img src="uploads/work/carSale.png" class="floater" alt='Sell your cars'><div class="floater1">Sell your cars</div></span>
    </div>
    <div class="sellIndiv">
        <span class="test"><img src="uploads/work/landSale.png" class="floater" alt='Sell that piece of land quickly'><div class="floater1">Sell that piece of land quickly</div></span>
    </div>
</div>               
<br>
<div class="uploadAds">
    <?php
    if ($loggedIn) {
        if ($_GET['yourEntries'] != 'true') {
            ?> 
            <a href="index.php?yourEntries=true"><button class="uploadAdsButton">Your Entries</button></a> 
            <?php
        } else {
            ?> 
            <a href="index.php"><button class="uploadAdsButton">All Entries</button></a> 
            <?php
        }
    }
    ?>
    <a href="<?php
    if (!$loggedIn) {
        echo 'register.php';
    } else if ($loggedIn) {
        echo 'uploadAds.php';
    }
    ?>"><button class="uploadAdsButton1" onclick="return upload()" id="uploadAdsOpenButton">Upload Ads</button></a>
</div>
<br>                
<div class="uploadAdsContainer" id="uploadAssetForm" style="display: none">
    <div class="divider4">
        <div class="uploadAdsIndiv">
            <div class="uploadDiscription">
                Choose Asset:
            </div>
            <div class="uploadValue">
                <select onchange="chooseNext1" id='chooseAssetUploadID' name="chooseAsset1" class="uploadValues">                                                                        
                    <?php require 'assetTypes.html'; ?>
                </select>
            </div>
        </div>
        <div class="uploadAdsIndiv">
            <div class="uploadDiscription">
                Category:
            </div>
            <div class="uploadValue">
                <select id="buyID2" name="buy1" class="uploadValues">                                         
                    <?php require 'buySellTypes.html'; ?>
                </select>
            </div>
        </div>
        <div class="uploadAdsIndiv" id="typeUploadContainerID">
            <div class="uploadDiscription">
                Type:
            </div>
            <div class="uploadValue">                                
                <select name='type1' class="uploadValues" id="typeUploadID">                                         
                    <?php require 'houseAssets.html'; ?>
                </select>
            </div>
        </div>
        <div class="uploadAdsIndiv" id="spaceState" style="display: none">
            <div class="uploadDiscription">
                &nbsp;
            </div>
            <div class="uploadValue">

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
                <select id="lga2" name="lgaID1" class="uploadValues">                                        
                    <?php require 'LGAs.html'; ?>
                </select>
            </div>
        </div>
        <div class="uploadAdsIndiv">
            <div class="uploadDiscription">
                ₦
            </div>
            <div class="uploadValue">
                <input type="number" placeholder="Price" name="price1" class="uploadValues" id="priceID2">
            </div>
        </div>
        <div class="uploadAdsIndiv" style="display: none" id="landSizeUploadID">
            <div class="uploadDiscription">
                <span class="mobileSpan">Land Size:</span>
            </div>
            <div class="uploadValue">
                <input type="number" id="landSizeCollector1" class="uploadValues" placeholder="Size(Square meters)" name="landSize" title="Leave empty if asset chosen isn't 'land'">
            </div>
        </div>
        <div class="uploadAdsIndiv" id="spaceLand">
            <div class="uploadDiscription">
                &nbsp;
            </div>
            <div class="uploadValue">

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
    <div class='dropZoneForm'>
        <form action="handleUpload.php" class="dropzone" id="myAwesomeDropzone"></form>
    </div><br>
    <textarea placeholder="Description" name="description1" class="uploadDescription" id="descriptionID"></textarea><br>
    <div class="filterButtons">
        <input type="button" value="Upload Ad" class="filterAssetsButton" name="uploadAds" id="uploadEntry">
        <input type="button" value="Reset" name="resetFilter" class="filterResetButton" id="deleteEntry">
    </div>
</div>      
<br>

<div class="assets">                    

    <script> var counter1 = -1;</script>
    <?php
    $columnCounter = 3;
    $rowCounter = 1;
    $noOfItems = 0;
    $noOfItems1 = 0;
    $counter = -1;
    $offset = "OFFSET " . ($page - 1) * 15;
    try {
        $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM content $whereClause ORDER BY contentID DESC LIMIT 15 $offset";
        $stmt = $con->prepare($sql);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $counter++;
        $noOfItems++;
        $noOfItems1++;
        $userID1 = $row['userID'];
        $premier = false;

        $image = $row['image0'];
        if (empty($image))
            $image = 'uploads/house123.jpg';
        else
            $image = $image . ".jpg";
        $description = $row['description'];
        if (strlen($description) < 30)
            $strEnd = '';
        else
            $strEnd = '...';
        $imageHash = $row['imageHash0'];
        $contentID = $row['contentID'];
        $price = $row['price'];
        $buy = $row['buy'];
        $buy = str_replace('_', ' ', $buy);
        if ($buy == 'Buy')
            $buy = 'Intends to Buy';
        else if ($buy == 'Sell')
            $buy = 'For sale';
        $asset = $row['asset'];
        $location = $row['location'];
        $location = str_replace('_', ' ', $location);
        $lga = $row['lga'];
        $type = $row['type'];
        $type = str_replace('_', ' ', $type);
        if ($type[0] == '5') {
            $type = '5+ bedroom flat';
        }
        $typeString = 'Type:';
        $sizeString = '';
        if ($asset == 'Land') {
            $type = $row['size'];
            $typeString = 'Size:';
            $sizeString = "m<sup>2</sup>";
        }
        ?>
        <script>
            var price = "<?php echo $price; ?>";
            price = accounting.formatMoney(price, "₦", 0, ",");
            counter1++;
        </script>
        <?php
        if ($noOfItems == 1) {
            ?>            
            <div class="cover3">
                <?php
            }
            ?>
            <div class="indivAsset" itemscope itemtype="http://schema.org/Product">                                  
                <div class="innerIndivAsset">
                    <a itemprop="url" href="viewProperty.php?page=<?php echo $contentID; ?>"><img itemprop="image" src="<?php echo $image; ?>" width="100%" alt='<?php echo $description ?>'></a>
                </div>
                <div class="innerIndivDetails">
                    <?php
                    if ($premier == true) {
                        echo "<span class='premier'>Premier Agent<br></span>";
                    }
                    ?><span itemprop='offers' itemscope itemtype='http://schema.org/Offer'>Price: <span itemprop="priceCurrency" content="NGN"></span><?php echo "<span id='$counter' itemprop='price'>"; ?><?php echo $price; ?><?php echo "</span></span>"; ?><br><?php echo $buy; ?><br>State: <?php echo $location; ?><br>LGA: <?php echo $lga; ?><br>Asset: <span itemprop="name"><?php echo $asset; ?></span><br><?php echo $typeString; ?> <?php
                        if ($asset == 'Car') {
                            echo "<span itemprop='brand' itemscope itemtype='http://schema.org/Brand'><span itemprop='name'>";
                        } echo $type . $sizeString;
                        ?><?php
                        if ($asset == 'Car') {
                            echo "</span></span>";
                        } if (!empty($description)) {
                            echo "<br><span itemprop='description'>$description</span>";
                        }
                        ?>
                        <script>
                            document.getElementById(counter1).innerHTML = price;
                        </script>
                        <?php
                        if ($loggedIn && $userID == $userID1) {
                            ?>            
                            <br><br>
                            <div class="deleteButtonContainer">
                                <a href="delete-property.php?page=<?php echo $contentID; ?>"><button class="deleteButton">Delete</button></a>
                            </div>
                            <?php
                        }
                        ?>

                </div>
            </div>

            <?php
            if ($noOfItems == 3) {
                $noOfItems = 0;
                ?>            
            </div>
            <?php
        }
        ?>
        <?php
    }
    if ($noOfItems != 0) {
        ?>            
    </div>
    <?php
}
?>
<br>
</div>                    
<div class="paginationConatainer1">
    <br>
    <table border='0' align='center' width='auto' style='border-spacing: 0px'>
        <tr>
            <td align="center">
                <?php
                echo $paginator;
                if ($totalItems == 0) {
                    echo "Your query returned nothing.";
                }
                ?>
            <td>
        </tr>
    </table>
</div>
<?php require_once 'bottomOfPage.php'; ?>
<script src="js/index.js"></script>
<?php require_once 'endOfPage.php'; ?>