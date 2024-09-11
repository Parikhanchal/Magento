<?php
class Test{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "toor1";
    protected $db = "student";

    function con(){
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db);

        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }

        echo "Connected successfully"; 
        
        return $conn;
    } 
}

class Crud extends Test{
    function create()
    {
        if(isset($_POST['submit'])){
            $conn = $this->con(); // connection
            
            $fname = $_POST['first'];
            $lname = $_POST['last'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];

            if($fname != "" && $lname != "" && $address != "" && $gender != ""){
                $sql = "INSERT INTO person (`f_name`, `l_name`, `address`, `gender`) VALUES ('$fname', '$lname', '$address', '$gender')";
                
                if(mysqli_query($conn, $sql)){
                    echo "Record added successfully";
                } else {
                    echo "Error adding record: " . mysqli_error($conn);
                }
            } 

            mysqli_close($conn); 
        }
    }
}
$crud = new Crud(); 
$crud->create(); // Call the create method
?> 
