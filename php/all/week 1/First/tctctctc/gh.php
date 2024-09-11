
<?php
$localhost = "localhost";
$username = "root";
$password = "toor1";
$db = "task";

$conn = mysqli_connect($localhost, $username, $password, $db);

if (!$conn) {
    die("Error" . mysqli_connect_error());
}



?>



<html>
<head>
    <title>Form</title>
</head>
<body>
<hr>
<h3> Category Form </h3>
<form action="createdb.php" method="POST">
    <label>Category Name</label>
    <input type="text" name="category_name">

    <input value="insert" type="submit" name="c_insert">
    <input value="delete" type="submit" name="categdelete">
</form>

<hr>
<h3> Product form</h3>
<form action="createdb.php" method="POST">
    <label>Product Name</label>
    <input type="text" name="product_name">

    <label>Product Price</label>
    <input type="text" name="product_price">

    <label>Select Category</label>
    <select name="category_id">
        <?php
        $sql = mysqli_query($conn, "SELECT c_id, c_name FROM category");

        while ($row = mysqli_fetch_assoc($sql)){
            ?>
            <option value="<?php echo $row['c_id']; ?>"><?php echo $row['c_name']; ?></option>
            <?php
        }
        ?>
    </select>

    <input type="submit" name="p_insert">
    
</form>


<hr>

<h3>All Category Records</h3>
<table>
    <th>id</th>
    <th>name</th>
    <th>price</th>
    <th>create date </th>
    <th>update date </th>
    <th> category name </th>
    <th>Edit</th>
    <th>Delete</th>
</table>
<?php
$sql = "SELECT product.id, product.name,product.price,product.created_date,product.update_date,category.c_name
     FROM product
     INNER JOIN category ON product.categ_id = category.c_id
     ";
$result = mysqli_query($conn, $sql);
?>
<tabel>
    <?php
    while($row = $result->fetch_assoc())
    {
        ?>
        <tr>
            <br> <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"];?></td>
            <td><?php echo $row["price"];?></td>
            <td><?php echo $row["created_date"];?></td>
            <td><?php echo $row["update_date"];?></td>
            <td><?php echo $row["c_name"];?></td>
            <td><a href="form.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
            <td><form action="createdb.php" method="POST"><input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button name="deletepro" type ="submit">Delete</button></form></td>


            

        </tr>
        <?php
    }
    ?>

</tabel>
<hr>
<form action="createdb.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
    <label>Product Name</label>
    <input type="text" name="update_name" value="<?php echo $product_name; ?>"><br>

    <label>Product Price</label>
    <input type="text" name="update_price" value="<?php echo $product_price; ?>"><br>

    <label>Select Category</label>
    <select name="update_categ_id">
        <?php 
        $sql = mysqli_query($conn, "SELECT c_id, c_name FROM category");

        while ($row = mysqli_fetch_assoc($sql)){
            ?>
            <option value="<?php echo $row['c_id']; ?>"><?php echo $row['c_name']; ?></option>
            <?php
        }
        ?>
    </select><br>

    <input type="submit" name="update" value="Update">
</form>

<hr>
<h3> Category Details </h3>
<table>
    <th>id</th>
    <th>name</th>
    <th>create date </th>
    <th>update date </th>
    <th>Edit</th>
    <th>Delete</th>
</table>
<?php
$sql = "SELECT * FROM category";
     
$result = mysqli_query($conn, $sql);
?>
<tabel>
    <?php
    while($row = $result->fetch_assoc())
    {
        ?>
        <tr>
            <br> <td><?php echo $row["c_id"]; ?></td>
            <td><?php echo $row["c_name"];?></td>
            <td><?php echo $row["created_date"];?></td>
            <td><?php echo $row["update_date"];?></td>
            <td><a href="form.php?c_id=<?php echo $row["c_id"]; ?>">Edit</a></td>
            <td><form action="createdb.php" method="POST"><input type="hidden" name="c_id" value="<?php echo $row['c_id']; ?>">
            <button name="deletecateg" type ="submit">Delete</button></form></td>


            

        </tr>
        <?php
    }
    ?>

</tabel>

<hr>
<h3>Category Update Form</h3>
<form action="createdb.php" method="POST">
    <input type="hidden" name="category_id" value="<?php echo $_GET['c_id']; ?>">
    <label>Category Name</label>
    <input type="text" name="updatecateg_name" ><br>

    
    <input type="submit" name="categupdate" value="Update">
</form>



</body>
</html>




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

                    // Fetch categories from database
                    $sql = "SELECT c_id, name FROM category";
                    $result = $db->query($sql);

                    //  dropdown with categories
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
                    <th>create_time</th>
                    <th>update_time</th>
                </tr>
                <?php
                $db = new mysqli('localhost', 'root', 'toor1', 'task-2');
                if($db->connect_error) {
                    die("Connection failed: " . $db->connect_error);
                }

                // Fetch data from the product table with category name
                $sql = "SELECT product.p_id, product.name AS product_name, product.price, category.name AS category_name
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
                        echo "<td>".$row["create_time"]."</td>";
                        echo "<td>".$row["update_time"]."</td>";

                        // echo "<td>  ".$row["p_id"]."</td>";
                        // echo "<td><a href='product.php?id=".$row["p_id"]."'>Edit</a> | <a href='delete.php?p_id=".$row["p_id"]."'>Delete</a></td>";
                        
                        echo "<td><a href='delete.php?p_id=".$row['p_id']."'/>
                        <center>
                        <form method='post'>
                            <input type='hidden' name='p_id' value='".$row['p_id']."' /> 
                            <input type='submit' name='delete' value='Delete' />
                        </form>
                        </td></td/>";
                        ?>

                         <td><a href="product.php?id=<?php echo $row['p_id'];?>"><button>Edit</button></a></td>

                        <?php
                    }
                } else {
                    echo "<tr><td>No products found</td></tr>";
                }
                $db->close();
                ?>
            </table>
        </div>
    </center>
    <br>
    <center>

    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="p_id">Product ID:</label>
        <input type="hidden" name="p_id" value="<?php echo $_GET['p_id']; ?>"><br/><br/>

        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Enter product name" required><br/><br/>

        <label for="price">Price:</label>
        <input type="text" name="price" placeholder="Enter product price" required><br/><br/>

        <label for="up_id">Select Category:</label>
        <input type="text" name='c_id' id="">

    <button type="submit" name="update">Update</button>
    </form>

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

        $sql = "INSERT INTO product (c_id, name, price,create_time) VALUES ('$c_id', '$name', '$price','$date')";

        $result = mysqli_query($db, $sql);

        if($result){
            echo 'Record ' .$name. ' added successfully';
            header("Location: product.php");
            exit();
        } 
        else {
            echo "Error ' .$name. '  adding record " . mysqli_error($db);
        }
    }

    // function delete()
    // {
    //     $db = $this->con("task-2");
        
    //     $p_id = $_POST['p_id'];


    //     if($p_id!= "")
    //     {
    //         $sql = "DELETE FROM product WHERE p_id = $p_id";
    //         $result = mysqli_query($db, $sql);

    //         if($result){
    //             echo "Record deleted successfully";
    //         } 
    //         else {
    //             echo "Error delete record: ". mysqli_error($db);
    //         }   
    //     }
    // }

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

    function update()
    {
        $conn = $this->connection();
        
        $name = $_POST['name'];
        $price = $_POST['price'];
        $p_id = $_POST['p_id'];
        $update_time = date('Y-m-d H:i:s');
    
        $sql = "UPDATE product SET name = '$name', price = '$price', update_time = '$update_time' WHERE p_id = $p_id";
        
        $result = mysqli_query($conn, $sql);

        if (mysqli_query($conn, $sql)) 
        {
            echo "Product updated successfully.";
        } 
        else 
        {
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
        if(isset($_POST['p_id']))
        {
            $data->update();
        }
        else
        {
            echo "Error: Product ID is missing";
        }
    }


    
    header("Location:#"); 
    exit;
}
?>