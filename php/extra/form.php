<?php
include 'library.php';
?>

<!DOCTYPE html>
<html>
<body>

<h2> Forms</h2>

<form action="" method="post">
  <label for="name">name:</label>
  <input type="text" id="name" name="name">
  <br><br>
  <label for="price">price:</label>
  <input type="text" id="price" name="price" ><br><br>
  <br><br>
  <label for="sku">sku:</label>
  <input type="text" id="sku" name="sku" ><br><br>
  <br><br>
  <label for="sort_order">sort_order:</label>
  <input type="text" id="sort_order" name="sort_order" ><br><br>
  <input type="submit" value="Submit" name="submit">
</form> 

<hr>

<center>
<h3>View All Products</h3>
      <table style="border:black; border-width:10px; border-style:outset;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Category</th>
          <th>create_date</th>
          <th>update_date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
          <?php
            
            $product = new product();
            $result = $product->select();

            if ($result->num_rows > 0) 
            {
            
                while ($row = $result->fetch_assoc())
                {
                    ?>
                <tr>
                    <th><?php echo $row['entity_id'];?></th>

                    <th><?php echo $row['sku'];?></th>

                    <td><a href="library.php?id=<?php echo $row['entity_id'];?>">Edit</a>&nbsp;
                        <a href="library.php?id=<?php echo $row['entity_id'];?>">Delete</a>
                </td>
                </tr>
            <?php
            }
        }
          ?>
      </tbody>
      </table>
</center>
</body>
</html>














<?php
  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = new product();
    $result = $product->pro_row($id);

    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_assoc())
      {
  ?>
  <form action="" method="post">
        
    <label for="name">name:</label>
    <input type="text" value="<?php echo $row['name'];?>" id="name" name="name">
    <br><br>
    <label for="price">price:</label>
    <input type="text" id="price" value="<?php echo $row['price'];?>" name="price" ><br><br>
    
    <label for="sku">sku:</label>
    <input type="text" id="sku" value="<?php echo $row['sku'];?>" name="sku" ><br><br>

    <label for="sort_order">sort_order:</label>
    <input type="text" id="sort_order" value="<?php echo $row['sort_order'];?>" name="sort_order" ><br><br>

    <input type="submit"  name="submit">
 
</form> 
<?php
   
      }
    }
  }
?>
</center>


<hr>
</body>
</html>


------------------------------------------------------------------------------------- 
delet.php 
<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
include 'library.php';        
  
  $id = $_GET['id'];
  $del = new product();
  $result = $del->delete($id);
  if ($result) 
  {
      // echo "<script>alert('product deleted successfully');</script>";
      echo "<script>window.location.href='index.php';</script>";
    
  } else 
  {
      // echo "<script>alert('product not deleted');</script>";
  }
   
?>


library.php 
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
				if ($this->conn->connect_error) {
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

                $sql = "INSERT INTO product (name ,  sku,price,sort_order) VALUES ('$name','$sku','$price','$sort_order')";

                $result = $this->conn->query($sql);
                
                if($result) {
                    echo "Data inserted successfully.";
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
            
        }

        public function update($name,$sku,$price,$sort_order)
        {
            $id = $_GET['id'];
            $sql = "UPDATE product SET name = '".$name."', price = '$price',sku = '$sku' WHERE entity_id = '$id'";
            $result = $this->conn->query($sql);
            if($result === false){
                echo "Error: ". $sql. "<br>". $this->conn->error;
            }else{
                echo "Record updated successfully";
            }

        }

        public function pro_row($id)
        {
            
            $sql = "SELECT * FROM product WHERE entity_id ='$id'";
			$result = $this->conn->query($sql);
			return $result;
        }

        public function delete($id)
        {
            $sql = "DELETE FROM product WHERE entity_id ='$id'";
            $result = $this->conn->query($sql);
            // return $result;

            if( $result) {
                echo " deleted successfully";
            } else {
                echo "error deleting";
            }

        }

    }
    

?>

index.php 
<?php



include 'library.php';        

?>

<!DOCTYPE html>
<html>
<body>

<center><h2> Forms</h2>
<form action="" method="post">
  <label for="name">name:</label>
  <input type="text" id="name" name="name"required>
  <br><br>
  <label for="price">price:</label>
  <input type="text" id="price" name="price" required><br><br>
  
  <label for="sku">sku:</label>
  <input type="text" id="sku" name="sku" ><br><br>

  <label for="sort_order">sort_order:</label>
  <input type="text" id="sort_order" name="sort_order" ><br><br>
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

if(isset($_POST['submit'])) 
{
  $product = new product();
  $result = $product->insert();  
}
   
?>

<?php
  if(isset($_POST['update']))
  {
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $sort_order = $_POST['sort_order'];

    $product = new product();
    $result = $product->update($name, $sku, $price, $sort_order);
    
  }
?>

<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
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




------------------------------------
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      form{
        margin: 0 auto;
        width: 250px;
        height: 250px;
      }
    </style>
    <script>
         function validation() {
        var name = document.getElementById('name').value;
        var genderMale = document.getElementById('male').checked;
        var genderFemale = document.getElementById('female').checked;
        var phpChecked = document.getElementById('php').checked;
        var javaChecked = document.getElementById('java').checked;
        var country = document.getElementById('country').value;
        
        var submitbtn = document.getElementById('submitbtn');
        if (name !== '' && (genderMale || genderFemale) && (phpChecked || javaChecked) && country !== '') {
            submitbtn.disabled = false;
        } else {
            submitbtn.disabled = true;
        }
    }
 
    // Function to handle form submission and save data to database
    function submitform() {
        var name = document.getElementById('name').value;
        var gender = document.querySelector('input[name="gender"]:checked').value;
        var skills = [];
        if (document.getElementById('php').checked) {
            skills.push('PHP');
        }
        if (document.getElementById('java').checked) {
            skills.push('Java');
        }
        var city = document.getElementById('country').value;
        
        // Code to save form data to the database goes here
        
        alert("Form submitted successfully!");
        document.getElementById('myform').submit();
        document.getElementById('myform').reset();
         
        validateForm(); // Re-validate form after reset
    }
 
    // Function to handle textbox button click
    function showTextboxValue() {
        var textboxValue = document.getElementById('name').value;
        if(textboxValue == ''){
            alert("Please fill the form");
        } else {

            alert("Textbox value: " + textboxValue);
        }
    }
 
    // Function to handle radio button button click
    function showgenderValue() {
        var gender = document.querySelector('input[name="gender"]:checked').value;
        if(!gender){
            alert("Please select gender..");
        } else {

            alert("gender: " + gender);
        }
    }
 
    // Function to handle checkbox button click
    function showSkillsValue() {
        var skills = [];
        if (document.getElementById('php').checked) {
            skills.push('PHP');
        }
        if (document.getElementById('java').checked) {
            skills.push('Java');
        }
        if(skills.length == 0){
            alert("Please select the skills");
        } else {

            alert("Skills: " + skills.join(", "));
        }
    }
 
    // Function to handle dropdown button click
    function showConValue() {
        var city = document.getElementById('country').value;
        if(city == ''){
            alert("Please select city");
        } else {

            alert("country: " + country);
        }
    }
</script>
</head>
<body>
    <?php
    
    
    
    ?>
   


    <div class="container">
        <center>
        <fieldset>
            <legend></legend><br>
        <form action="config.php" method="POST" id="myform">
            
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" oninput="validation()" ><br><br>

            <label for="gender">Gender:</label>
            <input type="radio" name="gender" id="male" name="male" value="male" onclick="validation()">
            <label for="male">Male</label>
            <input type="radio" id="female"id="female" name="gender" value="female" onclick="validation()">
            <label for="female">Female</label>
            <br><br>

            <label for="skills">skills:</label>
            <input type="checkbox" name="skills[]" id="php" value="php" onclick="validation()">
            <label for="PHP">PHP</label>
            <input type="checkbox" name="skills[]" id="java" value="java" onclick="validation()">
            <label for="JAVA">JAVA</label>
            <br><br>

            <label for="country">Country:</label>
            <select name="country" id="country" onchange="validation()">
                <option value="USA">USA</option>
                <option value="Canada">Canada</option>
                <option value="UK">UK</option>
                <option value="Australia">Australia</option>
            </select><br><br>

        <button type="submit" id="submitbtn" onclick="submitform()" disabled>Submit</button>    
        </form>
        <button type="button" onclick="showTextboxValue()">text</button>
        <button type="button" onclick="shogenderValue()">radio</button>
        <button type="button" onclick="showSkillsValue()">check</button>
        <button type="button" onclick="showConValue()">dropdown</button>
    </center>
    </fieldset>
</div>


  
</body>
</html>