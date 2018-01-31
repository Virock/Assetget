<?php

require_once 'methods.php';
checkIfUserIsLoggedIn($con, "handleUpload");
$ds = DIRECTORY_SEPARATOR;
$storeFolder = 'userUploads';

if (!$loggedIn) {
    header("Location: index.php");
    return;
}
?>
<script type="text/javascript">
    sessionStorage.getItem('contentID');
</script>
<?php

if (!empty($_FILES)) {

    function __autoload($class) {
        $filename = str_replace('\\', '/', $class) . '.php';
        @require_once 'classes/' . $filename;
    }

    $success = false;

    try {
        $sql = "SELECT * FROM verifiedusers WHERE cookie = :cookie LIMIT 1";

        $stmt = $con->prepare($sql);
        $saniCookie = strip_tags(trim($_COOKIE['loggedIn']));
        $stmt->bindValue("cookie", filter_var($saniCookie, FILTER_SANITIZE_STRING), PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $userID = $row['userID'];
        $stmt->closeCursor();

        if ($userID) {
            $success = true;
        }
    } catch (PDOException $e) {
        $con = null;
        return;
    }

    if ($success) {
        $user = $userID;
    } else {
        echo 'There was a problem';
        return;
    }

    mkdir($storeFolder . '/' . $user);
    $storeFolder .= '/' . $user;

    $tempFile = $_FILES['file']['tmp_name'];
    if ($_FILES['file']['size'] > 2000000) {
        echo "File too big";
        return;
    }
    $type1 = pathinfo($tempFile, PATHINFO_EXTENSION);
    $randNum = mt_rand(1, 100);
    $valid_types = array('jpeg', 'jpg', 'gif', 'png', 'bmp');
    $targetPath = dirname(__FILE__) . $ds . $storeFolder . $ds;  //4     
    $timeC = time();

    $targetFile = $targetPath . $timeC . $randNum;  //5  
    try {
        $img = new seydoggy\SimpleImage($_FILES['file']['tmp_name']);
        $img->resize(600, 600)->overlay('uploads/watermark1.png', 'bottom right', .70, -10, -10)->save($targetFile . '.jpg');
    } catch (Exception $e) {
        $con = null;
        return;
    }

    $fileLocation = "/userUploads/" . $user . "/" . $timeC . $randNum;

    if ($_SESSION["contentID"] == "-1") {
        try {
            $img = new seydoggy\SimpleImage($targetFile . '.jpg');
            $img->resize(100, 100)->overlay('uploads/watermark1.png', 'bottom right', .70, -10, -10)->save($targetFile . 'thumb.jpg');

            $sql = "INSERT INTO content(image0, imageHash0) VALUES(:image, :imageHash)";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("image", $fileLocation, PDO::PARAM_STR);
            $stmt->bindValue("imageHash", md5($fileLocation), PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            echo "Inserted into database";

            $sql = "SELECT * FROM content WHERE image0 = :image LIMIT 1";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("image", $fileLocation, PDO::PARAM_STR);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $contentID = $row['contentID'];

            $_SESSION["contentID"] = $contentID;
            $_SESSION["imageCount"] = '1';
            $stmt->closeCursor();
        } catch (PDOException $e) {
            $con = null;
            return;
        }
    } else if ($_SESSION["imageCount"] == '0') {
        try {
            $img = new seydoggy\SimpleImage($targetFile . '.jpg');
            $img->resize(100, 100)->save($targetFile . 'thumb.jpg');

            $sql = "UPDATE content SET image0 = :image, imageHash0 = :imageHash WHERE contentID = :contentID";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("image", $fileLocation, PDO::PARAM_STR);
            $stmt->bindValue("imageHash", md5($fileLocation), PDO::PARAM_STR);
            $stmt->bindValue("contentID", $_SESSION["contentID"], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            $_SESSION["imageCount"] = '1';
        } catch (PDOException $e) {
            $con = null;
            return;
        }
    } else if ($_SESSION["imageCount"] == '1') {
        try {
            $sql = "UPDATE content SET image1 = :image, imageHash1 = :imageHash WHERE contentID = :contentID";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("image", $fileLocation, PDO::PARAM_STR);
            $stmt->bindValue("imageHash", md5($fileLocation), PDO::PARAM_STR);
            $stmt->bindValue("contentID", $_SESSION["contentID"], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            $_SESSION["imageCount"] = '2';
        } catch (PDOException $e) {
            $con = null;
            return;
        }
    } else if ($_SESSION["imageCount"] == '2') {
        try {
            $sql = "UPDATE content SET image2 = :image, imageHash2 = :imageHash WHERE contentID = :contentID";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("image", $fileLocation, PDO::PARAM_STR);
            $stmt->bindValue("imageHash", md5($fileLocation), PDO::PARAM_STR);
            $stmt->bindValue("contentID", $_SESSION["contentID"], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            $_SESSION["imageCount"] = '3';
        } catch (PDOException $e) {
            $con = null;
            return;
        }
    } else if ($_SESSION["imageCount"] == '3') {
        try {
            $sql = "UPDATE content SET image3 = :image, imageHash3 = :imageHash WHERE contentID = :contentID";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("image", $fileLocation, PDO::PARAM_STR);
            $stmt->bindValue("imageHash", md5($fileLocation), PDO::PARAM_STR);
            $stmt->bindValue("contentID", $_SESSION["contentID"], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            $_SESSION["imageCount"] = '4';
        } catch (PDOException $e) {
            $con = null;
            return;
        }
    } else if ($_SESSION["imageCount"] == '4') {
        try {
            $sql = "UPDATE content SET image4 = :image, imageHash4 = :imageHash WHERE contentID = :contentID";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("image", $fileLocation, PDO::PARAM_STR);
            $stmt->bindValue("imageHash", md5($fileLocation), PDO::PARAM_STR);
            $stmt->bindValue("contentID", $_SESSION["contentID"], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
            $_SESSION["imageCount"] = '5';
        } catch (PDOException $e) {
            $con = null;
            return;
        }
    }
    $con = null;
    echo "Reached the end of the code";
}
?>