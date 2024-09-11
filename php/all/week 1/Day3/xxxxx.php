<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Name</title>
</head>
<body>
    
    <center>
    <div class='container'>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
            <label for="name"> Name:</label>
            <input type="text" name="name" placeholder="Enter your name" required>
            <br/><br/>
            <label for="price"> Price:</label>
            <input type="text" name="price" placeholder="Enter the price" required>
            <br/><br/>
            <label for="c_id"> Category:</label>
            <select name="c_id" required>
                <?php
                    $db = new mysqli('localhost', 'root', 'toor1', 'task-2');
                    if($db->connect_error) {
                        die("Connection failed: " . $db->connect_error);
                    }

                    // Fetch categories 
                    $sql = "SELECT c_id, name FROM category";
                    $result = $db->query($sql);

                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['c_id'] . "'>" . $row['name'] . "</option>";
                    }

                    $db->close();
                ?>
            </select>
           
            <br/><br/>     
            <div class="wrap">
                <button type="submit" name="submit"> 
                    Submit
                </button>
            </div>
        </form>
        <br>
    </div>
    </center>
    <hr/>
    <br>     

    <center>
    <div class="container">
        <center>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
            <label for="p_id"> product id:</label>
            <input type="text" name="p_id"  required>
            <button type="submit" name="delete"> 
                    Delete
                </button>
        </form>
        </center>
    </div>
    </center>
    <br>
    <hr>
    <center>
        <div class='container'>
            <h3>View All Products</h3>
            <table border="5" >
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>create_date</th>
                    <th>update_date</th>
                    <th>Actions</th>
                </tr>
                <?php
                $db = new mysqli('localhost', 'root', 'toor1', 'task-2');
                if($db->connect_error) {
                    die("Connection failed: " . $db->connect_error);
                }

                // Fetch data from the product table with category name
                $sql = "SELECT product.p_id, product.name AS product_name, product.price, category.name AS category_name, product.create_date, product.update_date
                        FROM product
                        INNER JOIN category ON product.c_id = category.c_id";
                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["p_id"]."</td>";
                        echo "<td>".$row["product_name"]."</td>";
                        echo "<td>".$row["price"]."</td>";
                        echo "<td>".$row["category_name"]."</td>";
                        echo "<td>".$row["create_date"]."</td>";
                        echo "<td>".$row["update_date"]."</td>";

                        echo "<td>
                                <form action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='post'>
                                    <input type='hidden' name='p_id' value='".$row['p_id']."' />
                                    <button type='submit' name='delete'>Delete</button>
                                </form><br>
                                <a href='".$_SERVER["PHP_SELF"]."?edit_id=".$row["p_id"]."'>
                                    <button>Edit</button>
                                </a>
                              </td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No products found</td></tr>";
                }
                $db->close();
                ?>
            </table>
        </div>
    </center>
    <br>
    <center>
    <?php
    if(isset($_GET['p_id']))
     {
        $p_id=$_GET['p_id'];
        $sql = "SELECT * FROM product WHERE p_id='$p_id'";
        $result = $db->query($sql);

        if($result->num_row>0)
        {
            $row=mysqli_fetch_array($result);
            $name = $row['name'];
            $price = $row['price'];
            $c_id = $row['c_id'];
        }

    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="p_id">Product ID:</label>
        <input type="hidden" name="p_id" required value="<?php echo $p_id; ?>">
        
        <!-- <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Enter product name" value="
        <?php echo $name; ?>" required> -->
        
        <label for="price">Price:</label>
        <input type="text" name="price" placeholder="Enter product price" value="<?php echo $price; ?>" required>
        
        <label for="c_id">Category:</label>
        <select name="c_id">
            <?php 
            $db = new mysqli('localhost', 'root', 'toor1', 'task-2');
            if($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

            $sql = "SELECT c_id, name FROM category";
            $result = $db->query($sql);

            while ($row = $result->fetch_assoc())
            {
                echo "<option value='".$row['c_id']."'>".$row['name']."</option>";
            }
            ?>
        </select>
            <br><br>
        <button type="submit" name="update">Update</button>
    </form>
    <br>
    </center>
</body>
</html>

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
            header("Location: ".$_SERVER["PHP_SELF"]);
            exit();
        } 
        else {
            echo "Error ' .$name. '  adding record " . mysqli_error($db);
        }
    }

    function delete($p_id)
    {
        $db = $this->con("task-2");
        
        $sql = "DELETE FROM product WHERE p_id = '$p_id'";
        $result = $db->query($sql);

        if($result){
            echo 'Record ' .$p_id. ' deleted successfully';
            exit;
        }
        else {
            echo "Error ' .$p_id. '  delete record: ". mysqli_error($db);     
        }
    }

    function update_product()
    {
        $db = $this->con("task-2");

        $name = $_POST['name'];
        $price = $_POST['price'];
        $p_id = $_POST['p_id']; 
        $date = date('Y-m-d H:i:s', time());

        $sql = "UPDATE product SET name = '$name', price = '$price',update_date='$date' WHERE p_id = '$p_id'";
        $result = $db->query($sql);

        if ($result) {
            echo "Product updated successfully.";
        } else {
            echo "Error updating product: " . mysqli_error($db);
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

    if(isset($_POST['update'])) {
        $data->update_product();
    }
}
?>
