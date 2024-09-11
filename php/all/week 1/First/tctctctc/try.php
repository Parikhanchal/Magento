<?php
    $abc = "testabc";
    echo ("$abc");
    echo ('$abc');
?>

<!-- data insert xxname -->
<!-- data notinsert xxname -->
<!-- string function .......string -->
<!-- 2table..product&category -->
<!-- product----pri key id,p_name,price,create_date,update_date,forenkey c_id -->
<!-- category----pri key id,c_name,create_date,update_date -->
<!-- p--sqp,c-php for time -->
<!-- for update if chanege name than change date time  -->
<!-- c-only name,,,p-name,price,category selection(id) -->
<!-- pro xx(name) added -->




<!-- DAY-3 -->
<!-- php connect sql - code -->
<!-- update -->
<!-- catgory - view -->
<!-- date--data add in php using query-->
<!-- printr(array) -->





<?php
class Test
{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "toor1";

    function con($db)
    {
        $conn = mysqli_connect($this->servername, $this->username, $this->password,$db);

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

        $name = $_POST['name'];
        $price = $_POST['price'];
        $c_id = $_POST['c_id'];
        $date = date("Y-m-d H:i:s", time());

        $sql = "INSERT INTO product (c_id, name, price,create_date) VALUES ('$c_id', '$name', '$price','$date')";

        $result = mysqli_query($db, $sql);

        if($result){
            echo 'Record ' .$name. ' added successfully';
            // Redirect after successful insertion
            header("Location: product.php");
            exit();
        } 
        else {
            echo "Error adding record " . mysqli_error($db);
        }
    }

    function delete($p_id)
    {
        $db = $this->con("task-2");
        
        $sql = "DELETE FROM product WHERE p_id = '$p_id'";
        $result = $db->query($sql);

        if($result){
            echo 'Record ' .$p_id. ' deleted successfully';
            header('Location: product.php');
            exit;
        }
        else {
            echo "Error delete record: ". mysqli_error($db);     
        }
    }

    function update()
    {
        $conn = $this->connection();
        
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
        $update_c_id = $_POST['update_c_id'];
        $id = $_POST['product_id'];
        $updated_date = date('Y-m-d H:i:s');
    
        $sql = "UPDATE product SET name = '$update_name', price = '$update_price', c_id = '$update_c_id', update_date = '$updated_date' WHERE id = $id";
    
        if (mysqli_query($conn, $sql)) 
        {
            echo "Product updated successfully.";
        } 
        else 
        {
            echo "Error updating product: " . mysqli_error($conn);
        }
    }
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $data = new data();

    if(isset($_POST['submit'])) {
        $data->insert();
    }

    if(isset($_POST['delete'])) {
        if(isset($_POST['p_id']))
        {
            $data->delete($_POST['p_id']);
        }
        else
        {
            echo "Error: Product ID is missing";
        }
    }
    
    // Redirect after processing form submission
    header("Location: #");
    exit;
}
?>
