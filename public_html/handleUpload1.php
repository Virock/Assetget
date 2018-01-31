<?php

require_once 'methods.php';
checkIfUserIsLoggedIn($con, "handleUpload");

if (!$loggedIn) {
    header("Location: index.php");
    return;
}
$owner = strip_tags(trim($_POST['ownerID']));
$owner = filter_var($owner, FILTER_SANITIZE_STRING);

$chooseAsset = strip_tags(trim($_POST['chooseAsset1']));
$chooseAsset = filter_var($chooseAsset, FILTER_SANITIZE_STRING);
$buy = strip_tags(trim($_POST['buy1']));
$buy = filter_var($buy, FILTER_SANITIZE_STRING);
$price = strip_tags(trim($_POST['price1']));
if ($price === '')
    $price = 0;
$price = filter_var($price, FILTER_SANITIZE_NUMBER_INT);
if (filter_var($price, FILTER_VALIDATE_INT) === false && filter_var($price, FILTER_VALIDATE_INT) !== 0) {
    echo "Invalid Price";
    return;
}
$state = strip_tags(trim($_POST['location1']));
$state = filter_var($state, FILTER_SANITIZE_STRING);
$assetType = strip_tags(trim($_POST['type1']));
$assetType = filter_var($assetType, FILTER_SANITIZE_STRING);
$lga = strip_tags(trim($_POST['lgaID1']));
$lga = filter_var($lga, FILTER_SANITIZE_STRING);
$description = strip_tags(trim($_POST['description1']));
$description = filter_var($description, FILTER_SANITIZE_STRING);

$success = false;

try {
    $sql = "SELECT * FROM verifiedusers WHERE cookie = :cookie LIMIT 1";

    $stmt = $con->prepare($sql);
    $stmt->bindValue("cookie", filter_var($_COOKIE['loggedIn'], FILTER_SANITIZE_STRING), PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $userID = $row['userID'];
    $stmt->closeCursor();
    
    if ($userID)
        $success = true;
} catch (PDOException $e) {
    $con = null;
    return;
}

if ($_SESSION['contentID'] == '-1') {
    $dataFinder = mt_rand();
    try {
        if ($chooseAsset != 'Land') {
            $sql = "INSERT INTO content(userID, dataFinder, owner, asset, buy, price, location, type, lga, description) VALUES(:userID, :dataFinder, :owner, :asset, :buy, :price, :location, :type, :lga, :description)";
        } else if ($chooseAsset == 'Land') {
            $sql = "INSERT INTO content(userID, dataFinder, owner, asset, buy, price, location, size, lga, description) VALUES(:userID, :dataFinder, :owner, :asset, :buy, :price, :location, :type, :lga, :description)";
        }

        $stmt = $con->prepare($sql);
        $stmt->bindValue("userID", $userID, PDO::PARAM_STR);
        $stmt->bindValue("dataFinder", $dataFinder, PDO::PARAM_STR);
        $stmt->bindValue("owner", $owner, PDO::PARAM_STR);
        $stmt->bindValue("asset", $chooseAsset, PDO::PARAM_STR);
        $stmt->bindValue("buy", $buy, PDO::PARAM_STR);
        $stmt->bindValue("price", $price, PDO::PARAM_STR);
        $stmt->bindValue("location", $state, PDO::PARAM_STR);
        $stmt->bindValue("type", $assetType, PDO::PARAM_STR);
        $stmt->bindValue("lga", $lga, PDO::PARAM_STR);
        $stmt->bindValue("description", $description, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        $sql = "SELECT * FROM content WHERE dataFinder = :dataFinder LIMIT 1";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("dataFinder", $dataFinder, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $contentID = $row['contentID'];
        $stmt->closeCursor();
        $_SESSION["contentID"] = $contentID;

        $sql = "UPDATE content SET dataFinder = :dataFinder WHERE contentID = :contentID";
        $stmt = $con->prepare($sql);
        $stmt->bindValue("dataFinder", '', PDO::PARAM_STR);
        $stmt->bindValue("contentID", $_SESSION["contentID"], PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        echo 'Successfully uploaded data';
    } catch (PDOException $e) {
        $con = null;
        return;
    }
} else if ($_SESSION["contentID"] != '-1') {
    try {
        if ($chooseAsset != 'Land') {
            $sql = "UPDATE content SET userID = :userID, dataFinder = :dataFinder, owner = :owner, asset = :asset, buy = :buy, price = :price, location = :location, type = :type, lga = :lga, description = :description WHERE contentID = :contentID";
        } else if ($chooseAsset == 'Land') {
            $sql = "UPDATE content SET userID = :userID, dataFinder = :dataFinder, owner = :owner, asset = :asset, buy = :buy, price = :price, location = :location, size = :type, lga = :lga, description = :description WHERE contentID = :contentID";
        }

        $stmt = $con->prepare($sql);
        $stmt->bindValue("userID", $userID, PDO::PARAM_STR);
        $stmt->bindValue("dataFinder", '', PDO::PARAM_STR);
        $stmt->bindValue("owner", $owner, PDO::PARAM_STR);
        $stmt->bindValue("asset", $chooseAsset, PDO::PARAM_STR);
        $stmt->bindValue("buy", $buy, PDO::PARAM_STR);
        $stmt->bindValue("price", $price, PDO::PARAM_STR);
        $stmt->bindValue("location", $state, PDO::PARAM_STR);
        $stmt->bindValue("type", $assetType, PDO::PARAM_STR);
        $stmt->bindValue("lga", $lga, PDO::PARAM_STR);
        $stmt->bindValue("description", $description, PDO::PARAM_STR);
        $stmt->bindValue("contentID", $_SESSION["contentID"], PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        echo 'Successfully uploaded data';
    } catch (PDOException $e) {
        $con = null;
        return;
    }
}
$con = null;
?>