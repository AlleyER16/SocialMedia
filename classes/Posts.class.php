<?php

    require_once (dirname(__FILE__).'/config/Dbh.config.php');

    class Posts extends Dbh{

        private const POSTS_TABLE = "posts";
        private const FRIENDS_TABLE = "friends";
        private const POSTS_LOVES_TABLE = "postloves";

        public function __construct() {
            $this->db_object = $this->getConnection();
        }

        public function post_exists($post_id){

            //sanitizing variables
            $post_id = $this->SanitizeVariable($post_id);

            //operations
            $sql = "SELECT * FROM ".self::POSTS_TABLE." WHERE PostID = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$post_id]);

            if($prepared_statement->rowCount() == 1){

                return [true, $prepared_statement->fetchAll()[0]];

            }else{

                return [false];

            }

        }

        public function add_post($title, $body, $user_id){

            //sanitizing variables
            $title = $this->SanitizeVariable($title);
            $body = $this->SanitizeVariable($body);
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "INSERT INTO ".self::POSTS_TABLE."(PostTitle, PostBody, Timestamp, CreatedBy) VALUES(?, ?, ?, ?)";
            $prepared_statement = $this->db_object->prepare($sql);

            if($prepared_statement->execute([$title, $body, time(), $user_id])){
                return [true, $this->db_object->lastInsertId()];
            }else{
                return [false];
            }

        }

        public function update_post_datum($post_id, $datum_key, $new_value){

            //sanitizing variables
            $post_id = $this->SanitizeVariable($post_id);
            $datum_key = $this->SanitizeVariable($datum_key);
            $new_value = $this->SanitizeVariable($new_value);

            //operations
            $sql = "UPDATE ".self::POSTS_TABLE." SET $datum_key = ? WHERE UserID = ?";
            $prepared_statement = $this->db_object->prepare($sql);

            return $prepared_statement->execute([$new_value, $post_id]);

        }

        public function get_num_my_posts($user_id){

            //sanitizing vairiables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT COUNT(PostID) AS NumPosts FROM ".self::POSTS_TABLE." WHERE CreatedBy = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id]);

            return $prepared_statement->fetchAll()[0]["NumPosts"];

        }

        public function get_my_posts($user_id){

            //sanitizing vairiables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT * FROM ".self::POSTS_TABLE." WHERE CreatedBy = ? ORDER BY PostID DESC";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id]);

            return $prepared_statement->fetchAll();

        }

        public function get_num_posts(){

            //operations
            $sql = "SELECT COUNT(PostID) AS NumPosts FROM ".self::POSTS_TABLE;
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([]);

            return $prepared_statement->fetchAll()[0]["NumPosts"];

        }

        public function get_posts_pagination($division) {

            //operations
            $num_posts = $this->get_num_posts();

            $pages = floor($num_posts/$division);

            return (($num_posts % $division) > 0) ? $pages + 1 : $pages;

        }

        public function get_posts($page, $division){

            //sanitizing fields
            $page = $this->SanitizeVariable($page);
            $division = $this->SanitizeVariable($division);

            $start = ($page - 1) * $division;

            //operations
            $sql = "SELECT * FROM ".self::POSTS_TABLE." ORDER BY PostID DESC LIMIT $start, $division";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([]);

            return $prepared_statement->fetchAll();

        }

        public function get_timeline($user_id){

            //sanitizing vairiables
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT * FROM ".self::POSTS_TABLE." WHERE CreatedBy = ? OR CreatedBy IN (SELECT User1 FROM ".self::FRIENDS_TABLE." WHERE User2 = ?)
            OR CreatedBy IN (SELECT User2 FROM ".self::FRIENDS_TABLE." WHERE User1 = ?) ORDER BY PostID DESC";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$user_id, $user_id, $user_id]);

            return $prepared_statement->fetchAll();

        }

        public function post_like_exists($post_id, $user_id){

            //sanitizing variables
            $post_id = $this->SanitizeVariable($post_id);
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "SELECT * FROM ".self::POSTS_LOVES_TABLE." WHERE Post = ? AND LovedBy = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$post_id, $user_id]);

            return ($prepared_statement->rowCount() == 1);

        }

        public function add_post_like($post_id, $user_id){

            //sanitizing variables
            $post_id = $this->SanitizeVariable($post_id);
            $user_id = $this->SanitizeVariable($user_id);

            //operations
            $sql = "INSERT INTO ".self::POSTS_LOVES_TABLE."(Post, LovedBy, Timestamp) VALUES(?, ?, ?)";
            $prepared_statement = $this->db_object->prepare($sql);

            return ($prepared_statement->execute([$post_id, $user_id, time()]));

        }

        public function get_num_post_likes($post_id){

            //sanitizing variables
            $post_id = $this->SanitizeVariable($post_id);

            //oerations
            $sql = "SELECT COUNT(LovedBy) AS NumLoves FROM ".self::POSTS_LOVES_TABLE." WHERE Post = ?";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$post_id]);

            return $prepared_statement->fetchAll()[0]["NumLoves"];

        }

        public function get_post_likes_pagination($post_id, $division) {

            //operations
            $num_post_likes = $this->get_num_post_likes($post_id);

            $pages = floor($num_post_likes/$division);

            return (($num_post_likes % $division) > 0) ? $pages + 1 : $pages;

        }

        public function get_post_likes($post_id, $page, $division){

            //sanitizing variables
            $post_id = $this->SanitizeVariable($post_id);
            $page = $this->SanitizeVariable($page);
            $division = $this->SanitizeVariable($division);

            $start = ($page - 1) * $division;

            //oerations
            $sql = "SELECT * FROM ".self::POSTS_LOVES_TABLE." WHERE Post = ? LIMIT $start, $division";
            $prepared_statement = $this->db_object->prepare($sql);
            $prepared_statement->execute([$post_id]);

            return $prepared_statement->fetchAll();

        }

    }

?>
