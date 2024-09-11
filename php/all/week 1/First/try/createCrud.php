<?php
class Test
{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "toor1";

    function con($db)
    {
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $db);

        if(!$conn)
        {
            die("Connection failed: ". mysqli_connect_error());
        }
        return $conn;
    }
}


class data extends Test
{
    function insert()
    {
        $db = $this->con('task-2');

        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $category = $_POST['category'];

        $sql = "INSERT INTO product (name, price, category) VALUES ('$product_name', '$product_price', '$category')";

        $result = mysqli_query($db, $sql);

        if($result)
        {
            echo "Record added successfully";
        }
        else
        {
            echo "Error adding record: " . mysqli_error($db);
        }
        
        return $result;
    }
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = new data();
    $data->insert();
}
?>
