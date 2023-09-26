<?php

    class Config {
        
        private $a = 10;
        private $b = 5;

        private $host = "127.0.0.1";
        private $username = "root";
        private $password = "";
        private $db_name = "php";
        private $table_name = "stdInformation";

        private $con;

        public function sum() {
            $s = $this->a + $this->b;

            echo "Sum: " . $s;
        }

        public function connectServer() {

            $this->con = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);

            if($this->con) {
                // echo "Server Connected !!";
            } else {
                echo "Serever Not Connected...";
            }

        }

        public function insertTable($name, $age, $course) {

            $query = "INSERT INTO $this->table_name(Name,Age,Course) VALUES('$name',$age,'$course')";

            $res = mysqli_query($this->con,$query);

            return $res;

        }

        public function getAllData() {

            $query = "SELECT * FROM $this->table_name";

            $res = mysqli_query($this->con,$query);

            return $res;

        }

        public function deleteSingleData($id) {

            $query = "DELETE FROM $this->table_name WHERE id = $id";

            return mysqli_query($this->con,$query); 

        }

        public function fetchSingleData($id) {

            $query = "SELECT * FROM $this->table_name WHERE id = $id";

            return mysqli_query($this->con,$query);

        }

        public function updateData($id,$name,$age,$course) {

            $query = "UPDATE $this->table_name SET Name='$name',Age=$age,Course='$course' WHERE Id=$id";

            return mysqli_query($this->con,$query);

        }
    }

?>