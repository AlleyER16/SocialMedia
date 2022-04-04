<?php

    if(!isset($_GET["user_id"]) || $_GET["user_id"] == ""){
        die("Error deleting user");
    }

    $user_id = $_GET["user_id"];

    require_once "../../classes/config/Dbh.config.php";

    $dbh_object = new Dbh();

    $db_object = $dbh_object->getConnection();

    $sql = "DELETE FROM chat WHERE FriendID IN (SELECT ID FROM friends WHERE User1 = ? OR User2 = ?)";
    $prepared_statement = $db_object->prepare($sql);
    $prepared_statement->execute([$user_id, $user_id]);

    $sql = "DELETE FROM friends WHERE User1 = ? OR User2 = ?";
    $prepared_statement = $db_object->prepare($sql);
    $prepared_statement->execute([$user_id, $user_id]);

    $sql = "DELETE FROM friendrequests WHERE User = ? OR RequestedBy = ?";
    $prepared_statement = $db_object->prepare($sql);
    $prepared_statement->execute([$user_id, $user_id]);

    $sql = "DELETE FROM postloves WHERE LovedBy = ?";
    $prepared_statement = $db_object->prepare($sql);
    $prepared_statement->execute([$user_id]);

    $sql = "DELETE FROM postloves WHERE Post IN (SELECT PostID FROM posts WHERE CreatedBy = ?)";
    $prepared_statement = $db_object->prepare($sql);
    $prepared_statement->execute([$user_id]);

    $sql = "DELETE FROM posts WHERE CreatedBy = ?";
    $prepared_statement = $db_object->prepare($sql);
    $prepared_statement->execute([$user_id]);

    $sql = "DELETE FROM removed WHERE User = ? OR UserRemoved = ?";
    $prepared_statement = $db_object->prepare($sql);
    $prepared_statement->execute([$user_id, $user_id]);

    $sql = "DELETE FROM users WHERE UserID = ?";
    $prepared_statement = $db_object->prepare($sql);
    $prepared_statement->execute([$user_id]);
    
    echo "User deleted successfully";

?>