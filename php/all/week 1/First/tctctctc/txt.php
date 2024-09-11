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
        <form action="" method="post"> 
            <label for="name"> Name:</label>
            <input type="text" name="name" placeholder="Enter your name" required>
            <br/><br/>
            <label for="price"> Price:</label>
            <input type="text" name="price" placeholder="Enter the price" required>
            <br/><br/>
            <label for="c_id"> category name</label>
            <input type="text" name="c_id">
           
            <br/><br/>     
            <div class="wrap">
                <button type="submit" name="submit"> 
                    Submit
                </button>
            </div>
        </form>
        <br><br>
    </div>
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
            $db = $this-> con('task-2');

            $name = $_POST['name'];
            $price = $_POST['price'];
            $c_name = $_POST['c_id'];

            $sql = "INSERT INTO product (c_id,name,price) VALUES ('$c_name','$name','$price')";

            $result = mysqli_query($db, $sql);
            
            if($result){
                echo "Record added successfully";
            } 
            else {
                echo "Error adding record " . mysqli_error($db);
            }
        }


        // function fetchProducts()
        // {
        //     $db = $this->con('task-2');

        //     $sql = "SELECT * FROM product";
        //     $result = mysqli_query($db, $sql);

        //     if(mysqli_num_rows($result) > 0)
        //     {
        //         echo "<table border='1'>";
        //         echo "<tr><th>Product Name</th><th>Product Price</th><th>Category</th></tr>";

        //         while($row = mysqli_fetch_assoc($result))
        //         {
        //             echo "<tr>";
        //             echo "<td>".$row['name']."</td>";
        //             echo "<td>".$row['price']."</td>";
        //             echo "<td>".$row['c_id']."</td>";
        //             echo "</tr>";
        //         }

        //         echo "</table>";
        //     }
        //     else
        //     {
        //         echo "No products found.";
        //     }
        // }
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = new data();
        $data->insert();
    }

    // $data = new data();
    // $data->fetchProducts();
?>











function delete()
    {
        $db = $this->con('task-2');

        if (isset($_POST['c_id'])) {
            $c_id = $_POST['c_id'];

            if ($c_id != "") {
                $sql = "DELETE FROM category WHERE c_id = '$c_id'";
                $result = mysqli_query($db, $sql);

                if ($result) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record: " . mysqli_error($db);
                }
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = new data();

    if (isset($_POST['submit'])) {
        $data->insert();
    }

    if (isset($_POST['delete'])) {
        $data->delete();
    }
}
?>



<?php
class Test
{
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "toor1";

    function con($db)
    {
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $db);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
}

class data extends Test
{
    function insert()
    {
        $db = $this->con('task-2');

        if (isset($_POST['name'])) {
            $name = $_POST['name'];

            $sql = "INSERT INTO category (name) VALUES ('$name')";

            $result = mysqli_query($db, $sql);

            if ($result) {
                echo "Record added successfully";
            } else {
                echo "Error adding record: " . mysqli_error($db);
            }
        }
    }

    function delete()
    {
        $db = $this->con('task-2');

        if (isset($_POST['c_id'])) {
            $c_id = $_POST['c_id'];

            if ($c_id != "") {
                $sql = "DELETE FROM category WHERE c_id = '$c_id'";
                $result = mysqli_query($db, $sql);

                if ($result) {
                    echo "Record deleted successfully";
                } else {
                    echo "Error deleting record: " . mysqli_error($db);
                }
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = new data();

    if (isset($_POST['submit'])) {
        $data->insert();
    }

    if (isset($_POST['delete'])) {
        $data->delete();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Name</title>
</head>
<body>
    <?php print_r($_GET); ?>
    <center>
    <div class='container'>
        <form action="" method="post"> 
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
        <br><br>
    </div>
    </center>
    <hr/>
    <br><br>        
    <center>
    <div class="container">
        <form action="" method="get"> <!-- Change method to "get" -->
            <label for="p_id"> product id:</label>
            <input type="text" name="p_id"  required><br><br>
            <div class="wrap">
                <button type="submit" name="delete"> 
                    Delete
                </button>
            </div>
        </form>
    </div>
    </center>

    <br><br>
    <hr>
    <center>
        <div class='container'>
            <h3>View All Products</h3>
            <table border="5" style="width: 50%;  border-collapse: collapse; ">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
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

                        // echo "<td>  ".$row["p_id"]."</td>";
                        echo "<td><a href='product.php?id=".$row["p_id"]."'>Edit</a> | <a href='delete.php?p_id=".$row["p_id"]."'>Delete</a></td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td>No products found</td></tr>";
                }
                $db->close();
                ?>
            </table>
        </div>
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

        $sql = "INSERT INTO product (c_id, name, price) VALUES ('$c_id', '$name', '$price')";

        $result = mysqli_query($db, $sql);

        if($result){
            echo "Record added successfully";
        } 
        else {
            echo "Error adding record " . mysqli_error($db);
        }
    }

    function delete()
    {
        $db = $this->con("task-2");
        
        $p_id = $_GET['p_id'];
        $sql = "DELETE FROM product WHERE p_id = $p_id";
        $result = mysqli_query($db, $sql);

        if($result){
            echo "Record deleted successfully";
        }
        else {
            echo "Error delete record: ". mysqli_error($db);
        }
    }
} 


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $data = new data();

    if(isset($_POST['submit'])) {
        $data->insert();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
    if(isset($_GET['delete'])) { // Change to check for 'delete' instead of 'p_id'
        $data->delete();
    }
}
?>











<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>

<body>
    <center>
        <br>
        <div class="container">
                <h2>Product Update</h2>
                <?php
                include 'config.php';
                $db = new mysqli('localhost', 'root', 'toor1', 'book');
                $id = $_GET['id'];
                $sql = "SELECT * FROM product WHERE p_id = '$id'";
                $result = $db->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                ?>
                <form action="" method="POST">
                    <br>
                            <label for="pname">product name:</label>
                            <input type="text" name="pname" value="<?php echo $row['P_name'];?>">
                            <br><br>
                            <label for="pprice">product price:</label>
                            <input type="text" name="pprice" value="<?php echo $row['price'];?>">
                            <br><br>
                            <select name="category" value="">
                                <?php
                                $sql2 = "SELECT * FROM category;";
                                $result2 = $db->query($sql2);
                                
                                if ($result2->num_rows > 0) {
                                    while($row1 = $result2->fetch_assoc()) {
                                        echo "<option value='". $row1['c_id']. "'>". $row1['c_name']. "</option>";
                                    }
                                } 
                                ?>

                            </select>
                            <?php }} ?>
                            <div class="wrap">
                                <br><br>
                                <button type="submit">UPDATE</button>
                            </div>
                        
                </form>
                            
            </div>
    </center>
</body>

</html>

<?php

if(isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $c_id = $_POST['category'];
    $sql = "UPDATE product SET P_name = '$pname', price = '$pprice', c_id = '$c_id' WHERE p_id = '$id'";
    if ($db->query($sql) === TRUE) {
        echo "Record updated successfully";
        header('Location: index.php');
    } else {
        echo "Error: ". $sql. "<br>". $db->error;
    }
}

?>


function update($p_id, $name, $price, $c_id)
    {
        $db = $this->con("task-2");
        
        $sql = "UPDATE product SET name = '$name', price = '$price', c_id = '$c_id' WHERE p_id = '$p_id'";
        $result = $db->query($sql);

        if($result){
            echo 'Record ' .$p_id. ' updated successfully';
            header('Location: product.php');
            exit;
        }
        else {
            echo "Error updating record: ". mysqli_error($db);     
        }
    }





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

    function update($p_id, $name, $price, $c_id)
    {
        $db = $this->con("task-2");
        
        $sql = "UPDATE product SET name = '$name', price = '$price', c_id = '$c_id' WHERE p_id = '$p_id'";
        $result = $db->query($sql);

        if($result){
            echo 'Record ' .$p_id. ' updated successfully';
            header('Location: product.php');
            exit;
        }
        else {
            echo "Error updating record: ". mysqli_error($db);     
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
        if(isset($_POST['p_id'], $_POST['name'], $_POST['price'], $_POST['c_id']))
        {
            $data->update($_POST['p_id'], $_POST['name'], $_POST['price'], $_POST['c_id']);
        }
        else
        {
            echo "Error: Product ID, name, price, or category ID is missing";
        }
    }
    header("Location:#"); 
    exit;
}
?>




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
                    <th>create_date</th>
                    <th>update_date</th>
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
                        echo "<td>".$row["create_date"]."</td>";
                        echo "<td>".$row["update_date"]."</td>";

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
        <input type="text" name="p_id" required>
        <br/><br/>
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Enter product name" required>
        <br/><br/>
        <label for="price">Price:</label>
        <input type="text" name="price" placeholder="Enter product price" required>
        <br/><br/>
        <label for="c_id">Category:</label>
        <select name="c_id">
            <?php 
            $sql = mysqli_query($conn, "SELECT c_id, name FROM category");

            while ($row = mysqli_fetch_assoc($sql))
            {
                ?>
                <option value="<?php echo $row['c_id']; ?>"><?php echo $row['name']; ?></option>
                <?php
                }
                ?>
    </select><br>
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

        $sql = "INSERT INTO product (c_id, name, price,create_date) VALUES ('$c_id', '$name', '$price','$date')";

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

    function update_product()
    {
        $conn = $this->connection();
        
            $name = $_POST['name'];
            $price = $_POST['price'];
            $c_id = $_POST['c_id'];
            $id = $_POST['p_id'];
            $updated_date = date('Y-m-d H:i:s');
    
            $sql = "UPDATE product SET name = '$name', price = '$price', c_id = '$c_id', update_date = '$updated_date' WHERE p_id = $p_id";
    
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


    
    header("Location:#"); 
    exit;
}
?>





<?php

class config {
    protected $localhost = "localhost";
    protected $username = "root";
    protected $password = "toor1";
    protected $database = "task";

    function connection() {
        $conn = mysqli_connect($this->localhost, $this->username, $this->password, $this->database);

        if (!$conn) {
            echo "Not Connected";
        }
        return $conn;
    }
}

class db extends config {
    function createdb() {
        $conn = $this->connection();

        $sql = "CREATE DATABASE IF NOT EXISTS " . $this->database;

        if ($conn->query($sql) === TRUE) {
            echo 'Database '.$this->database.' created Successfully..<br>';
            $this->createtable($conn);
        } else {
            echo 'Error '. $this -> database.' creating Database:' . $conn->error . "<br>";
        }
    }

    function createtable($conn) {

        $sqlCategory = "CREATE TABLE IF NOT EXISTS category (
            c_id INT(11) AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";

        if ($conn->query($sqlCategory) === TRUE) {
            echo "Category Table Created Successfully..<br>";
        } else {
            echo "Error creating category table: " . $conn->error . "<br>";
        }


        $sqlProduct = "CREATE TABLE IF NOT EXISTS product (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            categ_id INT(11),
            FOREIGN KEY (categ_id) REFERENCES category(c_id))";

        if ($conn->query($sqlProduct) === TRUE) {
            echo "Product Table Created Successfully..<br>";
        } else {
            echo "Error creating product table: " . $conn->error . "<br>";
        }
    }

    function category_insert(){
        $con = $this -> connection();

        $c_name =$_POST['category_name'];


        $sql = "INSERT INTO category (c_name) VALUES ('$c_name');";

        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            echo 'category '.$c_name.' Not Inserted';

        }
        else{
            echo 'category '.$c_name.' Inserted';
        }

    }
    function product_insert(){
        $con = $this -> connection();

        $p_name =$_POST['product_name'];
        $price =$_POST['product_price'];
        $category_id = $_POST['category_id'];
        $date = date('m/d/Y h:i:s', time());



        $sql = "INSERT INTO product (name,price,categ_id,created_date) VALUES ('$p_name','$price','$category_id','$date')";

        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            echo 'Product '.$p_name.' Not Inserted';

        }
        else{
            echo 'Product '.$p_name.' Inserted';
        }

    }

    function delete_category(){
        $con = $this -> connection();
        $c_name =$_POST['category_name'];

        $sql = "DELETE FROM category WHERE c_name = '$c_name'";
        $result = mysqli_query($con, $sql);
        if(!$result)
        {
            echo "Error ";
        }
        else{
            echo 'category '.$c_name.' Deleted';
        }

    }
   

    
    function delete_product(){
    
        $conn = $this->connection();
        $id = $_POST['id'];
        
    
        $sql = "DELETE FROM product WHERE id = $id";
    
    
        if (mysqli_query($conn, $sql)) {
            echo 'Product '.$id.'  deleted successfully';
            header('location:form.php');
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    }

    function update_product(){
        $conn = $this->connection();
        
            $update_name = $_POST['update_name'];
            $update_price = $_POST['update_price'];
            $update_categ_id = $_POST['update_categ_id'];
            $id = $_POST['product_id'];
            $updated_date = date('Y-m-d H:i:s');
    
            $sql = "UPDATE product SET name = '$update_name', price = '$update_price', categ_id = '$update_categ_id', update_date = '$updated_date' WHERE id = $id";
    
            if (mysqli_query($conn, $sql)) {
                echo "Product updated successfully.";
            } else {
                echo "Error updating product: " . mysqli_error($conn);
            }
        }

        function update_category(){
            $conn = $this->connection();
            
                $upadtecateg_name = $_POST['updatecateg_name'];
                $id = $_POST['category_id'];
                $updated_date = date('Y-m-d H:i:s');
        
                $sql = "UPDATE category SET c_name = '$upadtecateg_name', update_date = '$updated_date' WHERE c_id = $id";
        
                if (mysqli_query($conn, $sql)) {
                    echo "category updated successfully.";
                } else {
                    echo "Error updating category: " . mysqli_error($conn);
                }
            }
        
        
    }

    

$db = new db();
$db->createdb();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["c_insert"])) {
        $db->category_insert();
    } elseif(isset($_POST["p_insert"])) {
        $db->product_insert();
    } elseif(isset($_POST["categdelete"])) {
        $db->delete_category();
    } elseif(isset($_POST['deletepro'])) {
        $db->delete_product();
    } elseif(isset($_POST["update"])) {
        $db->update_product();
    }
    elseif(isset($_POST["categupdate"])) {
        $db->update_category();
    }

    
}


?>
