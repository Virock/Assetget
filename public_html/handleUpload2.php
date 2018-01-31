<?php

require_once 'methods.php';
checkIfUserIsLoggedIn($con, "handleUpload2");
require_once 'loggedInFormDisplay.php';
if (!isset($_POST['uploadAds'])) {
    header("Location: index.php");
    return;
} else {

    function __autoload($class) {
        $filename = str_replace('\\', '/', $class) . '.php';
        @require_once 'classes/' . $filename;
    }

    $asset = filter_var(strip_tags(trim($_POST['chooseAsset1'])), FILTER_SANITIZE_STRING);
    $buy = filter_var(strip_tags(trim($_POST['buy1'])), FILTER_SANITIZE_STRING);
    $price = filter_var(strip_tags(trim($_POST['price1'])), FILTER_SANITIZE_NUMBER_INT);
    $state = filter_var(strip_tags(trim($_POST['location1'])), FILTER_SANITIZE_STRING);
    $type = filter_var(strip_tags(trim($_POST['type1'])), FILTER_SANITIZE_STRING);
    $LGA = filter_var(strip_tags(trim($_POST['lgaID1'])), FILTER_SANITIZE_STRING);
    $description = filter_var(strip_tags(trim($_POST['description1'])), FILTER_SANITIZE_STRING);
    $owner = filter_var(strip_tags(trim($_POST['ownerID'])), FILTER_SANITIZE_STRING);
    $landSize = filter_var(strip_tags(trim($_POST['landSize'])), FILTER_SANITIZE_NUMBER_INT);

    try {
        $randumNo = mt_rand();
        $sql = "INSERT INTO content(dataFinder, userID, asset, owner, buy, price, location, type, size, lga, description) VALUES (:dataFinder, :userID, :asset, :owner, :buy, :price, :location, :type, :size, :lga, :description)";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("dataFinder", $randumNo, PDO::PARAM_INT);
        $stmt->bindValue("userID", $userID, PDO::PARAM_INT);
        $stmt->bindValue("asset", $asset, PDO::PARAM_STR);
        $stmt->bindValue("owner", $owner, PDO::PARAM_STR);
        $stmt->bindValue("buy", $buy, PDO::PARAM_STR);
        $stmt->bindValue("price", $price, PDO::PARAM_INT);
        $stmt->bindValue("location", $state, PDO::PARAM_STR);
        $stmt->bindValue("type", $type, PDO::PARAM_STR);
        $stmt->bindValue("size", $landSize, PDO::PARAM_INT);
        $stmt->bindValue("lga", $LGA, PDO::PARAM_STR);
        $stmt->bindValue("description", $description, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();

        $sql = "SELECT * FROM content WHERE dataFinder = :dataFinder LIMIT 1";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("dataFinder", $randumNo, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $contentID = $row['contentID'];

        $sql = "UPDATE content SET dataFinder = :dataFinder WHERE contentID = :contentID";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("dataFinder", '', PDO::PARAM_STR);
        $stmt->bindValue("contentID", $contentID, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        $con = null;


        if ($_FILES['images']['name']['0'] != '') {
            $ds = DIRECTORY_SEPARATOR;
            $storeFolder = 'userUploads';
            mkdir($storeFolder . '/' . $userID);
            $storeFolder .= $ds . $userID;
            $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;

            $con = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $thumbImageCreated = false;
            for ($i = 0; $i < 5; $i++) {
                if ($_FILES['images']['name'][$i] == '') {
                    break;
                }
                $randNum = mt_rand(1, 100);
                $timeC = time();
                $targetFile = $targetPath . $timeC . $randNum;
                if ($_FILES['images']['size'][$i] > 2000000) {
                    continue;
                }
                try {
                    $img = new seydoggy\SimpleImage($_FILES['images']['tmp_name'][$i]);
                    $img->resize(600, 600)->overlay('uploads/watermark1.png', 'bottom right', .70, -10, -10)->save($targetFile . '.jpg');
                    //$img->save($targetFile.'.jpg');

                    if (!$thumbImageCreated) {
                        //$img = new seydoggy\SimpleImage($targetFile.'.jpg');
                        //$img->resize(100, 100)->overlay('uploads/watermark1.png', 'bottom right', .70, -10, -10)->save($targetFile.'thumb.jpg');
                        $img->resize(100, 100)->save($targetFile . 'thumb.jpg');
                        $thumbImageCreated = true;
                    }
                } catch (Exception $e) {
                    continue;
                }
                $y = $i;
                $fileLocation = "/userUploads/" . $userID . "/" . $timeC . $randNum;
                //$image[$y] = substr($targetFile, 26); //.'.jpg';
                //$image[$y] = $targetFile;
                $sql = "UPDATE content SET image$y = :image WHERE contentID = :contentID";
                $stmt = $con->prepare($sql);
                //$stmt->bindValue("image", $image[$y], PDO::PARAM_STR);
                $stmt->bindValue("image", $fileLocation, PDO::PARAM_STR);
                $stmt->bindValue("contentID", $contentID, PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
            }
            $con = null;
        }
    } catch (PDOException $e) {
        $situation = 3;     //Caught an exception
        //Tell the user to use the back nutton to try uploading again
        return;
    }
}
header("Location: index.php");
return;
?>