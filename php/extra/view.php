<?php
            $product = new product();
            $result = $product->select();
//mysqli_num_rows($result);
            if ($result->num_rows > 0) 
            {
                while ($row = $result->fetch_assoc())
                {
                ?>
                <tr>
                    <td><?php echo $row['entity_id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['sku'];?></td>
                    <td><?php echo $row['price'];?></td>
                    <td><?php echo $row['create_date'];?></td>
                    <td><?php echo $row['update_date'];?></td>

                    <td><a href="delete.php?id=<?php echo $row['entity_id'];?>">Delete</a>&nbsp;
                        <a href="index.php?id=<?php echo $row['entity_id'];?>">Update</a>
                </td>
                </tr>
                <?php
            }
        }
        ?>
      </tbody>
      </table>
</center>


<?php
     $product = new product();
     $result = $product->select();

     if ($result->num_rows > 0) 
     {
         while ($row = $result->fetch_assoc())
         {
            echo "<tr>";
            echo "<td>".$row['name']."</td>&nbsp;";
            echo "<td>".$row["price"]."</td>&nbsp;";
            echo "<td>".$row['sku']."</td>";
            echo "<td>".$row['sort_news']."</td>";
            echo "<td>".$row['created_at']."</td>";
            echo "<td>".$row['updated_at']."</td>";
            echo "<td><a href='news_front.php?entity_id=".$row['entity_id']."'>EDIT</a></td>";
            echo "<td>
                    <form action='index.php' method='post'>
                        <input type='hidden' name='entity_id' value='".$row['entity_id']."'>
                        <button type='submit' name='submit'>Delete</button>
                    </form>
                </td>";
            echo "</tr>";

         }
    }
?>





----------------index.php------------------------- 

<?php

include 'library.php';    
// ini_set('display_errors', 1);
//   ini_set('display_startup_errors', 1);
//   error_reporting(E_ALL);    

?>

<!DOCTYPE html>
<html>

<script>

  function validation() 
  {
    var name = document.getElementById('name').value;
    var price = document.getElementById('price').value;
    var sku = document.getElementById('sku').value;
    var sort_order = document.getElementById('sort_order').value;
         
  var titl = /^[a-zA-Z\s]+$/;
    if (!titl.test(name))
     {
        alert('Please enter a name.');
        return false;
    }

  // Validate sorting - accept only numbers
  if (isNaN(sorting)) 
  {
    alert("Please enter a valid sorting number.");
  return false;
  }

  // // Validate price - accept only numbers
  var price = /^[0-9]{10}+$/;
  if(!price.test(price)) 
  {
    alert('Please enter a price.');
    return false;
  }

}

 

function submit()
{
  alert("Form submitted successfully!");
  document.getElementById('myform').submit();
  document.getElementById('myform').reset();
  validation();
}
  

</script>

<body>

<center>
  <h2> Forms</h2>
  <form id="myform" action="" onsubmit="return validation()" method="post">
  
  <label for="name">name:</label>
  <input type="text" id="name" name="name" oninput="validation()"><br><br>

  <label for="price">price:</label>
  <input type="text" id="price" name="price" oninput="validation()"><br><br>
  
  <label for="sku">sku:</label>
  <input type="text" id="sku" name="sku" oninput="validation()"><br><br>

  <label for="sort_order">sort_order:</label>
  <input type="text" id="sort_order" name="sort_order" oninput="validation()"><br><br>
  
  <input type="submit" value="Submit" name="submit">

  </form> 
</center>    
<hr>

<center>
<h3>View All Products</h3>
      <table border="1">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Sku</th>
          <th>Price</th>
          <th>create_date</th>
          <th>update_date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          <?php

            $product = new product();
            $result = $product->select();

//mysqli_num_rows($result);
            if ($result->num_rows > 0) 
            {
                while ($row = $result->fetch_assoc())
                {
                ?>
                <tr>
                    <td><?php echo $row['entity_id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['sku'];?></td>
                    <td><?php echo $row['price'];?></td>
                    <td><?php echo $row['create_date'];?></td>
                    <td><?php echo $row['update_date'];?></td>

                    <td><a href="delete.php?id=<?php echo $row['entity_id'];?>">Delete</a>&nbsp;
                        <a href="index.php?id=<?php echo $row['entity_id'];?>">Update</a>
                </td>
                </tr>
                <?php
            }
        }
        ?>
      </tbody>
      </table>
</center>

<hr>
<center><h2> Product Update</h2>
<?php
    
    $id = $_GET['id'];
    $product = new product();
    $result = $product->pro_row($id);
    
    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_assoc())
      {
      ?>
      <form action="" method="post">
        <input type="hidden" id='id'  value="<?php echo $row['entity_id'];?>"> 

        <label for="name">name:</label>
        <input type="text" value="<?php echo $row['name'];?>" id="name" name="name">
        <br><br>
        <label for="price">price:</label>
        <input type="text" id="price" value="<?php echo $row['price'];?>" name="price" ><br><br>
        
        <label for="sku">sku:</label>
        <input type="text" id="sku" value="<?php echo $row['sku'];?>" name="sku" ><br><br>

        <label for="sort_order">sort_order:</label>
        <input type="text" id="sort_order" value="<?php echo $row['sort_order'];?>" name="sort_order" ><br><br>

        <input type="submit"  name="update">
    
</form> 
    <?php
    }
 }
?>
</center>
<hr>
</body>
</html>







<?php
  
// include 'library.php';        
  
  // $id = $_GET['id'];
  // $del = new product();
  // $result = $del->delete($id);
  // if ($result) 
  // {
  //     // echo "<script>alert('product deleted successfully');</script>";
  //     echo "<script>window.location.href='index.php';</script>";
  //     exit;
  // } else 
  // {
  //     // echo "<script>alert('product not deleted');</script>";
  // }
   
?>







----------------library.php------------------------- 

<?php
    
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
                    echo "Data inserted successfully.";
                    header("location:index.php");
                    exit();
                } else {
                    echo "Error inserting data.";
                }
                return $result;
                // $result = $this->conn->query($sql);
                // if (!$result) {
                //     printf("Error: %s\n", $this->conn->error);
                //     return false; // Return false to indicate an error
                // }
                // return true; // Return true if the query executed successfully
            }
        }

        public function select()
        {
            $sql = "SELECT * FROM product";
			$result = $this->conn->query($sql);
			return $result;
            // exit;
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
            if($result){
                echo "Record updated successfully";
                header("location:index.php");
                exit();
            }else{
                echo "Record not updated successfully";

            }
        }

        public function pro_row($id)
        {
            $sql = "SELECT * FROM product WHERE entity_id ='$id'";
			$result = $this->conn->query($sql);
			return $result;
            exit();
        }

        public function delete($id)
        {
            $sql = "DELETE FROM product WHERE entity_id ='$id'";
            $result = $this->conn->query($sql);
            return $result;
            exit();

            
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



----------------delete.php-------------------------
<?php
include 'library.php';        
  
  $id = $_GET['id'];
  $del = new product();
  $result = $del->delete($id);
  // if ($result) 
  // {
  //     echo "<script>window.location.href='library.php';</script>";
  // } 
  if( $result) {
    echo " deleted successfully";
    echo "<script>window.location.href='library.php';</script>";
    exit();
  } 
 else {
    echo "error deleting";
}
?>