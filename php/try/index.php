
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
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
            $pro_name = $_POST("p_name");
            $pro_price = $_POST("p_price");
            $pro_sku = $_POST("p_sku");
            $pro_sort_order = $_POST("p_sort_order");

            $sql = "INSERT INTO product_db (name,price,sku,sort_order) VALUES ('$pro_name','$pro_price','$pro_sku','$pro_sort_order')";

            // phpMyAdmin database name -> VALUES -> variable name

            $result = $this->conn->query($sql);

            if ($result)
            {   
                echo "data inserted successfully";
            }
            else
            {
                echo "error inserting data";
            }
            return $result;
        }




        public function select()
        {
            $sql = "SELECT * FROM product_db";
            $result = $this -> conn -> query($sql);
            return $result;
        }
    }
?>