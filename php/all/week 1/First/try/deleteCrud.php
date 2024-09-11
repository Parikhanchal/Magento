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
        <form action="deleteCrud.php" method="post"> 
            <input type="text" p_id="p_id" name="p_id"  required>
            
                <button type="submit" name="delete"> 
                    delete
                </button>
        </form>
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
        return $conn;
    } 
}
class Crud extends Test{
    function delete()
    {
        if(isset($_POST['delete'])){
            $conn = $this->con(); // connection
            
            $p_id = $_POST['p_id'];

            if($p_id != ""){
                $sql = "DELETE FROM person WHERE p_id = $p_id";
                if(mysqli_query($conn, $sql)){
                    echo "Record deleted successfully";
                } else {
                    echo "Error delete record: " . mysqli_error($conn);
                }
            } 

            mysqli_close($conn); 
        }
    }
}

$crud = new Crud(); 
$crud->delete(); 
?>


<!-- // isset() -- function used to check given variable is set and is not NULL --> 