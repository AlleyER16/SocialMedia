<?php

    require_once (dirname(__DIR__).'/classes/config/Dbh.config.php');

    class Chat extends Dbh{

        private const CHAT_TABLE = "chat";

        public function __construct() {
            $this->db_object = $this->getConnection();
        }

        public function chat_exists($id){

            //sanitizing variables
            $id = $this->SanitizeVariable($id);

            //operations
            $sql = "SELECT * FROM ".self::CHAT_TABLE." WHERE ID = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$id]);

            if($prepared_statement->rowCount() == 1){

                return [true, $prepared_statement->fetchAll()[0]];

            }else{

                return [false];

            }

        }

        public function get_last_chat_message($friend_id){

            //sanitizing vairiables
            $friend_id = $this->SanitizeVariable($friend_id);

            //operations
            $sql = "SELECT * FROM ".self::CHAT_TABLE." WHERE FriendID = ? ORDER BY ID DESC LIMIT 1";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$friend_id]);

            return ($prepared_statement->rowCount() == 1) ? [true, $prepared_statement->fetchAll()[0]] : [false] ;

        }

        public function get_num_unread_message($friend_id, $user_id){

            //sanitizing vairiables
            $friend_id = $this->SanitizeVariable($friend_id);
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT COUNT(ID) AS NumUnreadMessages FROM ".self::CHAT_TABLE." WHERE FriendID = ? AND MessageTo = ? AND ReadStatus = ? ORDER BY ID DESC LIMIT 1";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$friend_id, $user_id, 0]);

            return $prepared_statement->fetchAll()[0]["NumUnreadMessages"];

        }

        public function add_message($friend_id, $from, $to, $message){

            //sanitizing variables
            $friend_id = $this->SanitizeVariable($friend_id);
            $from = $this->SanitizeVariable($from);
            $to = $this->SanitizeVariable($to);
            $message = $this->SanitizeVariable($message);

            //operations
            $sql = "INSERT INTO ".self::CHAT_TABLE."(FriendID, MessageFrom, MessageTo, Message, ReadStatus, Timestamp) VALUES(?, ?, ?, ?, ?, ?)";
            $prepared_statement = $this->db_object->prepare($sql);

            if($prepared_statement->execute([$friend_id, $from, $to, $message, 0, time()])){
                return [true, $this->db_object->lastInsertId()];
            }else{
                return [false];
            }

        }

        public function delete_chat($id){

            //sanitizing variables
            $id = $this->SanitizeVariable($id);

            //operations
            $sql = "DELETE FROM ".self::CHAT_TABLE." WHERE ID = ?";
            $prepared_statement = $this->db_object->prepare($sql);

            return $prepared_statement->execute([$id]);

        }

        public function get_messages($friend_id){

            //sanitizing vairiables
            $friend_id = $this->SanitizeVariable($friend_id);

            //operations
            $sql = "SELECT * FROM ".self::CHAT_TABLE." WHERE FriendID = ? ORDER BY ID ASC";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$friend_id]);

            return $prepared_statement->fetchAll();

        }

        public function update_messages_read($friend_id, $user_id){

            //sanitizing variables
            $friend_id = $this->SanitizeVariable($friend_id);
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "UPDATE ".self::CHAT_TABLE." SET ReadStatus = ? WHERE FriendID = ? AND MessageTo = ?";
            $prepared_statement = $this->db_object->prepare($sql);

            return $prepared_statement->execute([1, $friend_id, $user_id]);

        }

    }

?>
