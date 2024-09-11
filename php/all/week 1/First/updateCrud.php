<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>
</head>
<body>
    <center>
    <div class='container'>
        <form action="crud.php" method="post"> 
            <!-- <label for="first">First Name:</label>
            <input type="text" id="first" name="first" placeholder="Enter your first name" required>
            <br/><br/>
            <label for="last">Last Name:</label>
            <input type="text" id="last" name="last" placeholder="Enter your last name" required>
            <br/><br/>
            <label for="address">Address:</label>
            <input type="address" id="address" name="address" placeholder="Enter your address" required>
            <br/><br/>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">other</option>
            </select>
            <br/><br/> -->
            <button type="submit" name="edit">Edit</button>
        </form>
        <br><br>
    </div>
</center>
</body>
</html>

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
    function edit()
    {
        if(isset($_POST['edit'])){
            $conn = $this->con();
            
            $fname = $_POST['first'];
            $lname = $_POST['last'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];

            if($id != "" && $fname != "" && $lname != "" && $address != "" && $gender != ""){
                
                $sql = "UPDATE person SET `f_name` = '$fname', `l_name` = '$lname', `address` = '$address', `gender` = '$gender' WHERE id = $id";
                
                if(mysqli_query($conn, $sql)){
                    echo "Record edited successfully";
                } else {
                    echo "Error editing record: " . mysqli_error($conn);
                }
            } 

            mysqli_close($conn); 
        }
    }
}

$crud = new Crud(); 
$crud->edit(); 

?> -->
    