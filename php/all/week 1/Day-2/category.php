<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
</head>
<body>
    <center>
        <div class='container'>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
                <label for="name"> Category Name:</label>
                <input type="text" name="name" placeholder="Enter product name" required>
                <br/><br/>
                <div class="wrap">
                    <button type="submit" name="submit"> 
                        Submit
                    </button>
                </div>
            </form>
            
        </div>
    </center>

    <hr><br>
    <center>
        <div class="container">
            <form action="" method="post"> 
                <label for="c_id"> category id:</label>
                <input type="text" name="c_id"  required>
                <button type="submit" name="delete">  Delete</button>
            </form>
        </div>
    </center>
    <br>
    <hr>
    
    <center>
        <div class='container'>
            <h3>View All Category</h3>
            <table border="5">
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>create_date</th>
                    <th>update_date</th>
                </tr>
                <?php
                $db = new mysqli('localhost', 'root', 'toor1', 'task-2');
                if($db->connect_error) {
                    die("Connection failed: " . $db->connect_error);
                }

                // view data from the category table 
                // $sql = "SELECT category.c_id,  category.name AS category_name
                //         FROM category";
                        // -- INNER JOIN category ON product.c_id = category.c_id";
                        $sql = "SELECT * FROM category";

                $result = $db->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["c_id"]."</td>";
                        echo "<td>".$row["name"]."</td>";
                        echo "<td>".$row["create_date"]."</td>";
                        echo "<td>".$row["update_date"]."</td>";

                        echo "<td> <form method='post'>
                            <input type='hidden' name='c_id' value='".$row['c_id']."'>
                            <button name=delete type='submit'>delete</button>
                        </form></td/>";
                        ?>
                        <td><a href="category.php?c_id=<?php echo $row['c_id'];?>"><button>Edit</button></a></td>
                        <?php 
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td>No category found</td></tr>";
                        }
                        $db->close();
                ?>
            </table>
        </div>
    </center>
    <center>
        <form method="post">
            <h3>Update</h3>
            <input type="hidden" name="c_id" value="<?php echo $_GET['c_id'];?>">
                <label for="name">Category Name:</label>
                <input type="text" name="name" >
                <button type="submit" name="categupdate"> Update</button>
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
            $db = $this-> con('task-2');

            $name = $_POST['name'];
            
            $sql = "INSERT INTO category (name) VALUES ('$name')";

            $result = mysqli_query($db, $sql);
            
            if($result){
                echo "Record  "   .$name.   " added successfully";
            } 
            else {
                echo "Error  "  .$name.   " adding record " . mysqli_error($db);
            }
        }


        // function delete()
        // {
        //     $db = $this->con('task-2');

        //     if (isset($_POST['delete'])) 
        //     {
        //         $c_id = $_POST['c_id']; 

        //         if($c_id!= "")
        //         {
        //             $sql = "DELETE FROM category WHERE c_id = '$c_id'";
        //             $result = mysqli_query($db, $sql);

        //             if($result){
        //                 echo "Record deleted successfully";
        //             } 
        //             else {
        //                 echo "Error delete record: ". mysqli_error($db);
        //             }   

        //         }
        //     }
        // }
        
        function delete()
        {
            $db = $this->con('task-2');

            if (isset($_POST['delete'])) 
            {
                $c_id = $_POST['c_id']; 

                if($c_id!= "")
                {
                    $sql = "DELETE FROM category WHERE c_id = '$c_id'";
                    $result = mysqli_query($db, $sql);

                    if($result){
                        echo 'Record ' .$c_id. ' deleted successfully';
                    } 
                    else {
                        echo 'Error ' .$c_id. '  delete record:'. mysqli_error($db);
                    }   

                }
            }
        }
        function update()
        {
            $db = $this->con("task-2");

            $name = $_POST['name'];
            $c_id = $_POST['c_id'];
            $update_time = date('Y-m-d H:i:s');

            $sql = "UPDATE category SET name = '$name', update_date = '$update_time' WHERE c_id = '$c_id'";
            $result = mysqli_query($db, $sql);

            if($result){
                echo 'Record ' .$c_id. ' deleted successfully';
            } 
            else {
                echo 'Error ' .$c_id. '  delete record:'. mysqli_error($db);
            } 
        }
        
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = new data();
        
        if(isset($_POST['submit'])) {
            $data->insert();
        }
    
        if(isset($_POST['delete'])) {
            $data->delete();
        }

        if(isset($_POST['categupdate'])) {
            $data->update();
        }
    }

    
?>


new

<?php
class config {
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "toor1";
    protected $database = "Task1"; // Specify the database name
    protected $conn;

    function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        
        // Select the database
        $this->conn->select_db($this->database);
    }

    function createdb() {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->database";
        if ($this->conn->query($sql) === TRUE) {
            echo "Database created successfully<br>";
        } else {
            echo "Database creation failed: " . $this->conn->error;
        }
    }
}

class createtable extends config {
    
    function create_product() {
        $que= "CREATE TABLE IF NOT EXISTS product (
            p_id INT(11) AUTO_INCREMENT PRIMARY KEY,
            P_name VARCHAR(255) NOT NULL,
            price DECIMAL(10, 2) NOT NULL,
            create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            c_id INT (11),
            FOREIGN KEY (c_id) REFERENCES category(c_id)
        )";

        if ($this->conn->query($que) === TRUE) {
            echo "Table created successfully<br>";
        } else {
            echo "Table creation failed: " . $this->conn->error;
        }
    }
   
    function insert_category() {
        $cname = $_POST['cname'];
        $sql = "INSERT INTO category (c_name) VALUES ('$cname')";
        if ($this->conn->query($sql) === TRUE) {
            echo "Data  " .$cname.  "  inserted successfully in category table";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    function insert_product() {
        $name = $_POST['pname'];
        $price = $_POST['pprice'];
        $c_name = $_POST['c_id'];
        
        $sql = "INSERT INTO product (p_name,price,c_id) VALUES ('$name','$price','$c_name')";
        if ($this->conn->query($sql) === TRUE) {
            echo "Data " .$name." ".$price." ".$c_name. " inserted successfully in product table";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }

    function delete_product() {
        $p_id = $_POST['p_id'];
        $sql = "DELETE FROM product WHERE p_id = '$p_id'"; 
        $result = $this->conn->query($sql); 
        if($result) {
            echo "Data ".$p_id. " deleted successfully in product table";
        } else {
            echo "Failed to delete data: " . $this->conn->error; 
        }
    }
    function delete_category() {
        $c_id = $_POST['c_id'];
        $sql = "DELETE FROM category WHERE c_id = '$c_id'"; 
        $result = $this->conn->query($sql);
        if($result) {
            echo "Data ".$c_id. " deleted successfully in category table";
        } else {
            echo "Failed to delete data: " . $this->conn->error;
        }
    }


    }


$config = new config();
$config->createdb();

$table = new createtable();

$table->create_product();

class data extends createtable {
   
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["c_add"])) {
        $table->insert_category();
    }else if(isset($_POST["p_add"])) {
        $table->insert_product();
    }else if (isset($_POST["delete_prod"])) {
        $table->delete_product();
    }elseif (isset($_POST["delete_cate"])) {
        $table->delete_category();
    }



    
}

?>
