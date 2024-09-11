<?php
class Config {
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "toor1";
    protected $database = "task";
    protected $conn;
 
    function connection() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            echo "connection fail";
        }else{
            echo "connection done";
        }
        
        return $this->conn;
    }
}
 
class Insert extends Config {
    function insertData() {
        
        $conn = $this->connection();
        
        $name = $_POST["name"];
        $gender =$_POST["gender"];
        $interest = isset($_POST["interest"]) ? implode(",",  $_POST["interest"]) : '';
       $language = $_POST["language"];
        
        // $sql = "INSERT INTO student (s_name, s_gender, s_interest, s_language, create_date) VALUES ('$name', '$gender', '$interest', '$language', NOW())";
        $sql = "INSERT INTO student (s_name , s_gender , s_interest , s_language) VALUES ('$name', '$gender', '$interest', '$language')";
        //echo $sql;
        //die();
            
        if ($conn->query($sql) === TRUE) {
            echo "data inserted successfuly";
            header('Location: form.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        $conn->close();
    }
}
 
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $insert = new Insert();
    $insert->insertData();
}
?>