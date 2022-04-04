<?php

    require_once (dirname(__FILE__).'/config/Dbh.config.php');

    class Users extends Dbh{

        private const USERS_TABLE = "users";
        private const REMOVED_TABLE = "removed";
        private const FRIEND_REQUESTS_TABLE = "friendrequests";
        private const FRIENDS_TABLE = "friends";

        public function __construct() {
            $this->db_object = $this->getConnection();
        }

        public function user_exists($unique_key, $test){

            //sanitizing variables
            $unique_key = $this->SanitizeVariable($unique_key);
            $test = $this->SanitizeVariable($test);

            //operations
            $sql = "SELECT * FROM ".self::USERS_TABLE." WHERE $unique_key = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$test]);

            if($prepared_statement->rowCount() == 1){

                return [true, $prepared_statement->fetchAll()[0]];

            }else{

                return [false];

            }

        }

        public function user_exists_by_auth($username, $password){

            //sanitizing variables
            $username = $this->SanitizeVariable($username);
            $password = $this->SanitizeVariable($password);

            //operations
            $sql = "SELECT * FROM ".self::USERS_TABLE." WHERE Username = ? AND Password = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$username, $password]);

            if($prepared_statement->rowCount() == 1){

                return [true, $prepared_statement->fetchAll()[0]];

            }else{

                return [false];

            }

        }

        public function add_user($full_name, $gender, $date_of_birth, $telephone, $username, $password){

            //sanitizing variables
            $full_name = $this->SanitizeVariable($full_name);
            $gender = $this->SanitizeVariable($gender);
            $date_of_birth = $this->SanitizeVariable($date_of_birth);
            $telephone = $this->SanitizeVariable($telephone);
            $username = $this->SanitizeVariable($username);
            $password = $this->SanitizeVariable($password);

            //operations
            $sql = "INSERT INTO ".self::USERS_TABLE."(FullName, Gender, DateOfBirth, Telephone, Username, Password, OnlineStatus, Timestamp) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $prepared_statement = $this->db_object->prepare($sql);

            if($prepared_statement->execute([$full_name, $gender, $date_of_birth, $telephone, $username, $password, 1, time()])){
                return [true, $this->db_object->lastInsertId()];
            }else{
                return [false];
            }

        }

        public function update_user_datum($user_id, $datum_key, $new_value){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);
            $datum_key = $this->SanitizeVariable($datum_key);
            $new_value = $this->SanitizeVariable($new_value);

            //operations
            $sql = "UPDATE ".self::USERS_TABLE." SET $datum_key = ? WHERE UserID = ?";
            $prepared_statement = $this->db_object->prepare($sql);

            return $prepared_statement->execute([$new_value, $user_id]);

        }

        public function get_people_you_may_know($user_id){

            //sanitizing vairiables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT * FROM ".self::USERS_TABLE." WHERE UserID != ? AND UserID NOT IN (SELECT User FROM ".self::FRIEND_REQUESTS_TABLE." WHERE RequestedBy = ?) AND UserID NOT IN (SELECT RequestedBy FROM ".self::FRIEND_REQUESTS_TABLE." WHERE User = ?) AND UserID NOT IN (SELECT User1 FROM ".self::FRIENDS_TABLE." WHERE User2 = ? AND Status = ?) AND UserID NOT IN (SELECT User2 FROM ".self::FRIENDS_TABLE." WHERE User1 = ? AND Status = ?) AND UserID NOT IN (SELECT UserRemoved FROM ".self::REMOVED_TABLE." WHERE User = ?) AND UserID NOT IN (SELECT User FROM ".self::REMOVED_TABLE." WHERE UserRemoved = ?)";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id, $user_id, $user_id, $user_id, 1, $user_id, 1, $user_id, $user_id]);

            return $prepared_statement->fetchAll();

        }

        public function friend_request_exists($user, $requested_by){

            //sanitizing variables
            $user = $this->SanitizeVariable($user);
            $requested_by = $this->SanitizeVariable($requested_by);

            //operations
            $sql = "SELECT * FROM ".self::FRIEND_REQUESTS_TABLE." WHERE (User = ? AND RequestedBy = ?) OR (User = ? AND RequestedBy = ?)";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user, $requested_by, $requested_by, $user]);

            return ($prepared_statement->rowCount() == 1) ? [true, $prepared_statement->fetchAll()[0]] : [false];

        }

        public function add_friend_request($user, $requested_by){

            //sanitizing variables
            $user = $this->SanitizeVariable($user);
            $requested_by = $this->SanitizeVariable($requested_by);

            //operations
            $sql = "INSERT INTO ".self::FRIEND_REQUESTS_TABLE."(User, RequestedBy, Timestamp) VALUES(?, ?, ?)";
            $prepared_statement = $this->db_object->prepare($sql);

            return $prepared_statement->execute([$user, $requested_by, time()]);

        }

        public function delete_friend_request($id){

            //sanitizing variables
            $id = $this->SanitizeVariable($id);

            //operations
            $sql = "DELETE FROM ".self::FRIEND_REQUESTS_TABLE." WHERE ID = ?";
            $prepared_statement = $this->db_object->prepare($sql);

            return $prepared_statement->execute([$id]);

        }

        public function get_num_friend_requests($user_id){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT COUNT(ID) AS NumFriendRequests FROM ".self::FRIEND_REQUESTS_TABLE." WHERE User = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id]);

            return $prepared_statement->fetchAll()[0]["NumFriendRequests"];

        }

        public function get_friend_requests($user_id, $limit = ""){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);
            $limit = $this->SanitizeVariable($limit);

            $limit_query = ($limit != "") ? "LIMIT $limit" : "";

            //operations
            $sql = "SELECT * FROM ".self::FRIEND_REQUESTS_TABLE." WHERE User = ? ORDER BY Timestamp DESC $limit_query";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id]);

            return $prepared_statement->fetchAll();

        }

        public function get_num_friend_requests_sent($user_id){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT COUNT(ID) AS NumFriendRequestsSent FROM ".self::FRIEND_REQUESTS_TABLE." WHERE RequestedBy = ? ORDER BY Timestamp DESC";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id]);

            return $prepared_statement->fetchAll()[0]["NumFriendRequestsSent"];

        }

        public function get_friend_requests_sent($user_id){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT * FROM ".self::FRIEND_REQUESTS_TABLE." WHERE RequestedBy = ? ORDER BY Timestamp DESC";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id]);

            return $prepared_statement->fetchAll();

        }

        public function add_friend($user1, $user2){

            //sanitizing variables
            $user1 = $this->SanitizeVariable($user1);
            $user2 = $this->SanitizeVariable($user2);

            //operations
            $sql = "INSERT INTO ".self::FRIENDS_TABLE."(User1, User2, Status, Timestamp) VALUES(?, ?, ?, ?)";
            $prepared_statement = $this->db_object->prepare($sql);

            return $prepared_statement->execute([$user1, $user2, 1, time()]);

        }

        public function update_friend_datum($friend_id, $datum_key, $new_value){

            //sanitizing variables
            $friend_id = $this->SanitizeVariable($friend_id);
            $datum_key = $this->SanitizeVariable($datum_key);
            $new_value = $this->SanitizeVariable($new_value);

            //operations
            $sql = "UPDATE ".self::FRIENDS_TABLE." SET $datum_key = ? WHERE ID = ?";
            $prepared_statement = $this->db_object->prepare($sql);

            return $prepared_statement->execute([$new_value, $friend_id]);

        }

        public function get_num_friends($user_id){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT COUNT(ID) AS NumFriends FROM ".self::FRIENDS_TABLE." WHERE User1 = ? OR User2 = ? AND Status = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id, $user_id, 1]);

            return $prepared_statement->fetchAll()[0]["NumFriends"];

        }

        public function get_friends($user_id){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT * FROM ".self::FRIENDS_TABLE." WHERE User1 = ? OR User2 = ? AND Status = ? ORDER BY LastMessageTimestamp DESC";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id, $user_id, 1]);

            return $prepared_statement->fetchAll();

        }

        public function get_chat($user_id){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT * FROM ".self::FRIENDS_TABLE." WHERE User1 = ? OR User2 = ? ORDER BY LastMessageTimestamp DESC";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id, $user_id]);

            return $prepared_statement->fetchAll();

        }

        public function friend_exists($friend_id){

            //sanitizing variables
            $friend_id = $this->SanitizeVariable($friend_id);

            //operations
            $sql = "SELECT * FROM ".self::FRIENDS_TABLE." WHERE ID = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$friend_id]);

            return ($prepared_statement->rowCount() == 1) ? [true, $prepared_statement->fetchAll()[0]] : [false];

        }

        public function are_friends($user1, $user2){

            //sanitizing variables
            $user1 = $this->SanitizeVariable($user1);
            $user2 = $this->SanitizeVariable($user2);

            //operations
            $sql = "SELECT * FROM ".self::FRIENDS_TABLE." WHERE Status = ? AND (User1 = ? AND User2 = ?) OR (User1 = ? AND User2 = ?)";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([1, $user1, $user2, $user2, $user1]);

            return ($prepared_statement->rowCount() == 1);

        }

        public function get_num_removed($user_id){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT COUNT(ID) AS NumRemoved FROM ".self::REMOVED_TABLE." WHERE User = ? OR UserRemoved = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id, $user_id]);

            return $prepared_statement->fetchAll()[0]["NumRemoved"];

        }

        public function get_removed($user_id){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT * FROM ".self::REMOVED_TABLE." WHERE User = ? OR UserRemoved = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id, $user_id]);

            return $prepared_statement->fetchAll();

        }

        public function add_removed($user_id, $user_removed){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);
            $user_removed = $this->SanitizeVariable($user_removed);

            //operations
            $sql = "INSERT INTO ".self::REMOVED_TABLE."(User, UserRemoved, Timestamp) VALUES(?, ?, ?)";
            $prepared_statement = $this->db_object->prepare($sql);

            return $prepared_statement->execute([$user_id, $user_removed, time()]);

        }

        public function removed_exists($user, $user_removed){

            //sanitizing variables
            $user = $this->SanitizeVariable($user);
            $user_removed = $this->SanitizeVariable($user_removed);

            //operations
            $sql = "SELECT * FROM ".self::REMOVED_TABLE." WHERE (User = ? AND UserRemoved = ?) OR (User = ? AND UserRemoved = ?)";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user, $user_removed, $user_removed, $user]);

            return ($prepared_statement->rowCount() == 1);

        }

        public function search_users($user_id, $search){

            //sanitizing variables
            $user_id = $this->SanitizeVariable($user_id);
            $search = $this->SanitizeVariable($search);

            $search = "%$search%";

            //operations
            $sql = "SELECT * FROM ".self::USERS_TABLE." WHERE FullName LIKE ? AND UserID != ? AND UserID NOT IN (SELECT User FROM ".self::REMOVED_TABLE." WHERE UserRemoved = ?) AND UserID NOT IN (SELECT UserRemoved FROM ".self::REMOVED_TABLE." WHERE User = ?)";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$search, $user_id, $user_id, $user_id]);

            return ($prepared_statement->fetchAll());

        }

        public function get_num_users(){

            //oerations
            $sql = "SELECT COUNT(UserID) AS NumUsers FROM ".self::USERS_TABLE;
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([]);

            return $prepared_statement->fetchAll()[0]["NumUsers"];

        }

        public function get_users_pagination($division) {

            //operations
            $num_users = $this->get_num_users();

            $pages = floor($num_users/$division);

            return (($num_users % $division) > 0) ? $pages + 1 : $pages;

        }

        public function get_users($page, $division){

            //sanitizing variables
            $page = $this->SanitizeVariable($page);
            $division = $this->SanitizeVariable($division);

            $start = ($page - 1) * $division;

            //oerations
            $sql = "SELECT * FROM ".self::USERS_TABLE." LIMIT $start, $division";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([]);

            return $prepared_statement->fetchAll();

        }

    }

?>
