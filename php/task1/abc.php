[17:33] Disha Pansuriya
con.php
 
<?php
session_start ();
class Database{
    protected $__conn;
    public function __construct(){
        $servername = "localhost";
        $username = "root";
        $password = "toor1";
        $dbname = "project";
 
        // Create connection
        $this->__conn = new mysqli($servername, $username, $password,$dbname);
 
        // Check connection
        if ($this->__conn->connect_error) {
            die("Connection failed: " . $this->__conn->connect_error);
        } else {
          //  echo "Connected successfully";
        }
        
        return $this->__conn;
    }
 
}
 
class Product extends Database {
    public function select() {
        $sql = "SELECT * FROM review";
        $result = $this->__conn->query($sql);
 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='selected_rows[]' value='{$row['entity_id']}'></td>";
                echo "<td>" . $row['entity_id'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Description'] . "</td>";
                echo "<td>" . $row['Rating'] . "</td>";
                echo "<td>" . $row['is_Active'] . "</td>";
                echo "<td>" . $row['Created_at'] . "</td>";
                echo "<td><a href='review.php?entity_id=" . $row['entity_id'] . "'>Edit</a></td>";
                echo "<td><form action='connection.php' method='post'>
                <input type='hidden' name='entity_id' value='" . $row['entity_id'] . "'>
                <button type='submit' name='delete'>Delete</button>
                </form></td>";
                echo "</tr>";
            }
       
        // Form for deleting multiple records (outside the loop)
        }
    }
 
    public function create($data) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $desc = $_POST['description'];
        $rating = $_POST['rating'];
        $is_active = $_POST['is_active'];
        if (!empty($rating) && is_numeric($rating)) {
 
        $sql = "INSERT INTO review (Name, Description, Rating, is_Active, Created_at) VALUES ('$name','$desc','$rating','$is_active',NOW())";
        if ($this->__conn->query($sql) === TRUE) {
            echo 'Data inserted' ;
            header('location:review.php');
           
        } else {
            echo "Error: " . $sql . "<br>" . $this->__conn->error;
        }
    }
        
    }
    public function update() {
        $id = $_POST['uid'];
        $name = $_POST['uname'];
        $desc = $_POST['udescription'];
        $rating = $_POST['urating'];
        $is_active = $_POST['uis_active'];
        $sql = "UPDATE review SET Name='$name', Description='$desc', Rating='$rating', is_Active='$is_active' WHERE entity_id=$id";
        $result = $this->__conn->query($sql);
        
        if ($result) {
            $_SESSION["message"] = " updated successfully!";
 
             header('Location: review.php');
        
        } else {
            echo "Failed to update data";
        }
    }
 
    public function fatch_data($id) {
        $sql = "SELECT * FROM review WHERE entity_id=$id";
        $result = $this->__conn->query($sql);
        return $result;
}
    public function delete($id) {
            $sql = "DELETE FROM review WHERE entity_id = $id";
         //   $result = $this->conn->query($sql);
 
            if ($this->__conn->query($sql) === TRUE) {
                echo 'Record deleted successfully';
                 header('Location: review.php');
            } else {
                echo "Error deleting record: " . $this->__conn->error;
            }
        }
    
    public function deleteall() {
        if (isset($_POST["delete_multiple"])) {
            $delete = $_POST["selected_rows"];
            $multi = implode(",", $delete);
            $sql = "DELETE FROM review WHERE entity_id IN($multi)";
            $result = $this->__conn->query($sql);
            if ($result) {
                echo 'delete all  successfully';
                 header('Location: review.php');
            } else {
                echo "Error deleting record: " . $this->__conn->error;
            }  
            }
        }
    
    public function save()
    {
        if ($this->entity_id) {
            // update
        } else {
            // create
        }
    }
 
    public function search()
    {
        $search = $_POST["searchinput"];
        $start_date = $_POST["start_date"];
        $end_date = $_POST["end_date"];
        $desc = $_POST["Description"];
        // Construct the SQL query based on the search criteria
        $sql = "SELECT * FROM review WHERE 1=1";
        
        if (!empty($search)) {
            $sql .= " AND Name LIKE '%$search%'";
        }
        if (!empty($desc)) {
            $sql .= " AND Description LIKE '%$desc%'";
        }
        if (!empty($_POST["rating"])) {
            $rating = $_POST["rating"];
            $sql .= " AND Rating = '$rating'";
        }
        if (!empty($start_date) && !empty($end_date)) {
            // Convert dates to MySQL date format (YYYY-MM-DD)
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
            
            $sql .= " AND Created_at BETWEEN '$start_date' AND '$end_date'";
        }
        
        $result = $this->__conn->query($sql);
        
        // Display search results in a grid
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Rating</th><th>Active</th><th>Created At</th></tr>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['entity_id'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "<td>" . $row['Description'] . "</td>";
                echo "<td>" . $row['Rating'] . "</td>";
                echo "<td>" . $row['is_Active'] . "</td>";
                echo "<td>" . $row['Created_at'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No results found</td></tr>";
        }
        echo "</table>";
    }
    
}
 
$database = new Database();
$product = new Product();
$data = [
    'id'=> $_POST['id'],
    'name' => $_POST['name'],
    'description' => $_POST['description'],
    'rating' => $_POST['rating'],
    'is_active'=> $_POST['is_active'],
];
$product->create($data);
//$product_data = $product->select();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        // Delete a single record
        if (isset($_POST["entity_id"]) && !empty($_POST["entity_id"])) {
            $product->delete($_POST["entity_id"]);
        } else {
            echo "Product ID not provided.";
        }
    
    } elseif (isset($_POST["update"])) {
        // Handle update form submission
        $product->update();
    }
    elseif (isset($_POST["search"])) {
        
        $product->search();
    }elseif (isset($_POST["delete_multiple"])) {
        $product->deleteall();    
    }
}
 
?>
 
[17:34] Disha Pansuriya
rev.php
<?php
         session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form</title>
<script>
 
function validateForm() {
    var title = document.getElementById('title').value;
    var description = document.getElementById('description').value;
    var sorting = document.getElementById('sorting').value;
    var is_active = document.getElementById('is_active').value;
 
    var submit = document.getElementById('submit');
    
    if (title === '' || description === '' || sorting === '' || is_active === '') {
        alert("Please fill out all fields.");
        return false;
    } else {
        return true;
    }
}
 
function submitForm() {
    alert("submit...");
    return validateForm();
}
 
</script>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
  }
 
  .container {
    max-width: 600px;
    margin: auto;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
 
  h2 {
    text-align: center;
  }
 
  label {
    font-weight: bold;
  }
 
  input[type="text"],
  textarea,
  input[type="number"],
  select {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }
 
  input[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
  }
 
  input[type="submit"]:hover {
    background-color: #45a049;
  }
</style>
</head>
<body>
 
<div class="container">
<?php
        if (isset($_SESSION["message"])) {
          echo "<div class='container'>";
          echo $_SESSION["message"];
          echo "</div>";
          unset($_SESSION["message"]);
          }
?>
  <h2>Form</h2>
 
  <form action="connection.php" method="post" onsubmit="return validateForm()">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" >
    
    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4"></textarea>
    
    <label for="rating">Rating:</label>
    <input type="number" id="rating" name="rating" min="1" max="5">
    
    <label for="is_active">Is Active:</label>
    <select id="is_active" name="is_active" >
      <option value="yes">Yes</option>
      <option value="no">No</option>
    </select>
    
    <input type="submit"name="submit" value="Submit" onclick="submitForm()">
  </form>
 
   <form action = "connection.php" method = "POST">
   <label for="name">Name:</label>
    <input type="text" id="name" name="searchinput" value="<?php echo $name; ?>">
    <label for="Description">Descripton:</label>
    <input type="text" id="Description" name="Description" value="<?php echo $desc; ?>">
    <label for="Rating">Rating:</label>
    <input type="text" id="Rating" name="Rating" value="<?php echo $rating; ?>">
    <label for="start_date">From:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
    <label for="end_date">To:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
 
 
    <input type="submit"name="search" value="Search">
   </form>
  <br><hr>
        <h2>VIEW DATA</h2>
        <form action="" method="post">
        
              <button type='submit' name='delete_multiple'>Delete Selected</button>
              
          <table class= "table table-dark">
            <thead>
              <tr>
                <th scope="col">Select</th>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Rating</th>
                <th scope="col">is_active</th>
                <th scope="col">Created_at</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
          <tbody>
              <?php
              include_once 'connection.php';
              $product = new Product();
              $data = $product->select();
          ?>
                <tr>      
      </tbody>
      </table>
        </form>
    
<div class="container">
  <h2>PRODUCT UPDATE</h2>
  <?php
  include_once 'connection.php';
  $id = $_GET['entity_id'];
  $product = new Product();
  $result = $product->fatch_data($id);
  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
  ?>
   <form action="review.php" method="post">
              <input type="hidden" name="uid" value="<?php echo $_GET['entity_id']; ?>">
              <label for="uname">Name:</label>
              <input type="text" id="name" name="uname" value="<?php echo $row['Name']; ?>" required>
              
              <label for="udescription">Description:</label>
              <textarea id="description" name="udescription" rows="4" required><?php echo $row['Description']; ?></textarea>
              
              <label for="urating">Rating:</label>
              <input type="number" id="rating" name="urating" min="1" max="5" value="<?php echo $row['Rating']; ?>" required>
              
              <label for="uis_active">Is Active:</label>
              <select id="is_active" name="uis_active" required>
                <option value="yes" <?php if ($row['is_Active'] == 'yes') echo 'selected'; ?>>Yes</option>
                <option value="no" <?php if ($row['is_Active'] == 'no') echo 'selected'; ?>>No</option>
              </select>
              <button type="submit" value="update" name="update">Update</button>
            </form>
<?php
  }}
?>
</div>
 
 
</body>
 
</html>
 
[17:34] Disha Pansuriya
de.php
<?php
session_start();
 
// Include the necessary files
include_once 'connection.php';
 
// Create an instance of the Product class
$product = new Product();
 
// Check if the delete button or the delete_multiple button is clicked
if(isset($_POST["delete"])) {
    // Delete a single record
    if (isset($_POST["entity_id"]) && !empty($_POST["entity_id"])) {
        $product->delete($_POST["entity_id"]);
    } else {
        echo "Product ID not provided.";
    }
} elseif(isset($_POST["delete_multiple"])) {
    // Delete multiple records
    if(isset($_POST["selected_rows"]) && !empty($_POST["selected_rows"])) {
        foreach($_POST["selected_rows"] as $entity_id) {
            $product->delete($entity_id);
        }
        $_SESSION["message"] = count($_POST["selected_rows"]) . " records deleted successfully!";
    } else {
        $_SESSION["message"] = "No records selected for deletion!";
    }
    // Redirect back to the review.php page
    header('Location: review.php');
    exit();
}
 
// Handle other form submissions like create and update here
?>
 