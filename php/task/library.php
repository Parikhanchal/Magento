<?php
    session_start();

    class Database {

		protected $conn;
		public function __construct()
		{
            {
				$servername = "localhost";
				$username = "root";
				$password = "toor1";
				$dbName = "project";
				$this->conn = new mysqli($servername, $username, $password, $dbName);
				if ($this->conn->connect_error) 
                {
					die("Connection failed: " . $this->conn->connect_error);
				}
			} 
		}
    }

    class product extends Database 
    {
        public function insert()
        {
            {
                $name = $_POST['name'];
                $sku = $_POST['sku'];
                $price = $_POST['price'];
                $sort_order = $_POST['sort_order'];

                $sql = "INSERT INTO product (name,sku,price,sort_order) VALUES ('$name','$sku','$price','$sort_order')";

                $result = $this->conn->query($sql);
                
                if($result) {
                    // echo "Data inserted successfully.";
                    $_SESSION['message'] = 'Product inserted successfully';
                    header("location:index.php");
                    exit();
                } else {
                    // echo "Error inserting data.";
                    $_SESSION['message'] = "Error inserting data" .$this->conn->error;
                }
                return $result;
            }
        }

        public function select()
        {
            $sql = "SELECT * FROM product";
			$result = $this->conn->query($sql);
			return $result;
        }

        public function update($name,$sku,$price,$sort_order)
        {
            $id = $_GET['id'];
            $name = $_POST['name'];
            $sku = $_POST['sku'];
            $price = $_POST['price'];
            $sort_order = $_POST['sort_order'];
            
            $sql = "UPDATE product SET name = '".$name."', price = '$price',sku = '$sku' WHERE entity_id = '$id'";
            $result = $this->conn->query($sql);
            if($result) {
                $_SESSION['message'] = 'Product update successfully';
                header("location:index.php");
                exit();
            } else {
                $_SESSION['message'] = "Error update data" .$this->conn->error;
            }
            return $result;
        }

        public function pro_row($id)
        {
            $sql = "SELECT * FROM product WHERE entity_id ='$id'";
			$result = $this->conn->query($sql);
			return $result;
            // exit();
        }

        public function delete($id)
        {
            $sql = "DELETE FROM product WHERE entity_id ='$id'";
            $result = $this->conn->query($sql);
            return $result;
            // exit();

            
        }

        //SAVE
        public function save()
        {
            
        }
        
    }
?>





<?php
  if(isset($_POST['update']))
  {
    $product = new product();
    $result = $product->update($name, $sku, $price, $sort_order);  
  }
?>

<?php
    if(isset($_POST['submit'])) 
    {
    $product = new product();
    $result = $product->insert();  
    } 
?>