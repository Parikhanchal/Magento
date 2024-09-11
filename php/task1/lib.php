<?php
session_start();
    class Database 
    {
		protected $conn;
		public function __construct()
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
    class Category extends Database
    {
        public function create()
        {
            $name = $_POST['name'];
            $sorting = $_POST['sorting'];

            $sql = "INSERT INTO category (name,sort_order) VALUES ('$name','$sorting')";
            $result = $this->conn->query($sql);
            if($result) {
                $_SESSION['message'] = 'Product inserted successfully';
               header("location:form.php");
                exit();
            } else {
                $_SESSION['message'] = "Error inserting data" .$this->conn->error;
            }
            return $result;
        }

        public function select()
        {
            $sql = "SELECT * FROM category";
            $result = $this->conn->query($sql);
            return $result;
        }

        public function update($name,$sorting)
        {
            $id = $_GET['id'];
            $name = $_POST["name"];
            $sorting = $_POST["sorting"];
            
            $sql = "UPDATE category SET name = '$name', sort_order = '$sorting' WHERE entity_id = '$id'";
            $result = $this->conn->query($sql);
            
            if( $result) 
            {
                $_SESSION['message'] = "update category";
                // echo "<script>window.location.href='form.php';</script>";
                header("location:form.php");
                exit();
            } 
            else 
            {
                $_SESSION['message'] = "Error update data" .$this->conn->error;
            }
            return $result;
        }

        public function fetch($id)
        {
            $sql = "SELECT * FROM category WHERE entity_id = '$id'";
            $result = $this->conn->query($sql);
            return $result;
        }

        // public function deleteOne($id)
        // {
        //     $sql = "DELETE FROM category WHERE entity WHERE entity_";
        // }

        public function delete($check_del)
        {
            if(isset($_POST['deleteAllBtn'])){
                $sql = "DELETE FROM category WHERE entity_id IN($check_del)";
                $result = $this->conn->query($sql);  
                return $result;

            }
        }

        function search(){
            $searchinput = $_POST['searchinput'];
    
            if($searchinput != "")
            {
                $sql = "SELECT * FROM category WHERE entity_id LIKE '%$searchinput%' || name  LIKE '%$searchinput%'";
                $result = $this->conn->query($sql);
                if(!$result)
            {
                echo "Error: ". $sql. "<br>". $this->conn->error;
            }
            else
            {
                while ($row = $result->fetch_assoc()) {
                   
                    echo "<td> ID:".$row["entity_id"]."</td><br>";
                    echo "<td>Name:".$row["name"]."</td><br>";
                    echo "<tr><br>";
                }
            }
            }
        }
    }
?>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST["submit"])){
        $category = new Category();
        $category->create();
    }
    if(isset($_POST['search']))
    {
        $obj = new Category();
        $obj->search();
    }
}
?>

<?php
if (isset($_POST['update']))
{
    $category = new Category();
    $category->update($name,$sorting);
}
?>


