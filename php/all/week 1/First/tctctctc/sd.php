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
