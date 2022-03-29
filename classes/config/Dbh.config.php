<?php

    class Dbh{

        private $HOST_NAME = "localhost";
		private $USER_NAME = "root";
		private $PASSWORD = "";
		private $DATABASE_NAME = "socialmedia";

		public function GetConnection(){

            $DSN = "mysql:host=".$this->HOST_NAME.";dbname=".$this->DATABASE_NAME;

			$conn_object = new PDO($DSN, $this->USER_NAME, $this->PASSWORD);
			$conn_object->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			return $conn_object;

		}

		public function SanitizeVariable($variable){

			return htmlspecialchars(strip_tags($variable));

		}

    }

?>
