<?php

require_once 'methods.php';
checkIfUserIsLoggedIn($con, "delete");
if (!isset($_POST['contentID'])) {
    header("Location: index.php");
    return;
} else if ($_POST['cancel'] == 'Cancel') {   //If the user canceled, go back to index
    header("Location: index.php");
    return;
} else if ($_POST['delete'] == 'Delete') {  //If the user deleted
    //Check that the user has the authority to delete
    $contentID = filter_var(strip_tags(trim($_POST['contentID'])), FILTER_SANITIZE_NUMBER_INT);
    try {
        $sql = "SELECT * FROM content WHERE contentID = :contentID LIMIT 1";

        $stmt = $con->prepare($sql);
        $stmt->bindValue("contentID", $contentID, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $userIDFromDatabase = $row['userID'];
        $image0 = $row['image0'];
        $image1 = $row['image1'];
        $image2 = $row['image2'];
        $image3 = $row['image3'];
        $image4 = $row['image4'];
    } catch (PDOException $e) {
        $con = null;
        header("Location: index.php");
        return;
    }
    //If authorized
    if ($userID == $userIDFromDatabase) {
        //Delete from database
        try {
            $sql = "DELETE FROM content WHERE contentID = :contentID";

            $stmt = $con->prepare($sql);
            $stmt->bindValue("contentID", $contentID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $con = null;
            header("Location: index.php");
            return;
        }

        //Delete from file system
        if (!empty($image0)) {
            unlink(substr($image0, 1) . '.jpg');
            unlink(substr($image0, 1) . 'thumb.jpg');
        }
        if (!empty($image1)) {
            unlink(substr($image1, 1) . '.jpg');
        }
        if (!empty($image2)) {
            unlink(substr($image2, 1) . '.jpg');
        }
        if (!empty($image3)) {
            unlink(substr($image3, 1) . '.jpg');
        }
        if (!empty($image4)) {
            unlink(substr($image4, 1) . '.jpg');
        }
        $con = null;
        header("Location: index.php");
        return;
    } else {
        $con = null;
        header("Location: index.php");
        return;
    }
}
$con = null;
header("Location: index.php");
return;
?>