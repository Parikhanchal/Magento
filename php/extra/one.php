[19:14] Mohammed Uzaifa
filename: news_back.php
<?php
 
class config{
 
    protected $con;
 
    public function __construct()
    {
        $localhost = "localhost";
        $username = "root";
        $password = "toor1";
        $database = "news_db";
 
        $this->con = new mysqli($localhost, $username, $password, $database);
        if($this->con->connect_error){
            die("Oops! Connection failed..." . $this->con->connect_error);
        }
    }
}
 
class news extends config{
 
    // insert code
    public function create(){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $sorting = $_POST['sorting'];
 
        $insert = "INSERT INTO news_tb (title, description, sort_news)
        VALUES ('$title', '$description', '$sorting');";
        $result = $this->con->query($insert);
 
        if($result){
            // echo "News Inserted Successfully.";
            header("Location: news_front.php");
            exit();
        } else {
            echo "Oops! News Not Inserted..";
        }
    }
 
    // view code
    public function read(){
        $view = "SELECT * FROM news_tb";
        $result = $this->con->query($view);
 
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>".$row['title']."</td>&nbsp;";
                echo "<td>".$row['description']."</td>";
                echo "<td>".$row['sort_news']."</td>";
                echo "<td>".$row['created_at']."</td>";
                echo "<td>".$row['updated_at']."</td>";
                echo "<td><a href='news_front.php?entity_id=".$row['entity_id']."'>EDIT</a></td>";
                echo "<td>
                        <form action='news_back.php' method='post'>
                            <input type='hidden' name='entity_id' value='".$row['entity_id']."'>
                            <button type='submit' name='btn_dlt'>Delete</button>
                        </form>
                    </td>";
                echo "</tr>";
            }
        }
    }
 
    // update code
    public function update(){
        
        $id =  $_POST['entity_id'];
        // $update_qry = "SELECT * FROM news_tb WHERE entity_id = '$id'";
        // $result = $this->con->query($update_qry);
            
        $up_title = $_POST['up_title'];
        $up_description = $_POST['up_description'];
        $up_sorting = $_POST['up_sorting'];
 
        $update_query = "UPDATE news_tb SET title = '$up_title', description = '$up_description',sort_news = '$up_sorting' WHERE entity_id = $id";
        $result = $this->con->query($update_query);
        if($result){
            header("Location: news_front.php");
            exit();
        } else {
            echo "Oops! News Not Updated..";
        }
    }
 
    // delete code
    public function delete(){
        $title_id = $_POST['entity_id'];
        $dlt = "DELETE FROM news_tb WHERE entity_id = $title_id";
        $result = $this->con->query($dlt);
        if($result){
            // echo "News Inserted Successfully.";
            header("Location: news_front.php");
            exit();
        } else {
            echo "Oops! News Not Deleted..";
        }
    }
 
    // fetch code
    public function fetch($id){
        $sql = "SELECT * FROM news_tb WHERE entity_id = $id";
        $result = $this->con->query($sql);
 
        return $result;
    }
 
    //save data
    public function save(){
 
    }
}
 
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // insert code
    if(isset($_POST["insert_btn"])){
        // $data = [
        //     'title' => $_POST['title'],
        //     'description' => $_POST['description'],
        //     'sorting' => $_POST['sorting']
        // ];
        $news = new news();
        $news->create();
    }
 
    // delete code
    if(isset($_POST["btn_dlt"])){
        $news = new news();
        $news->delete();
    }
 
    // update code
    if(isset($_POST["edit_btn"])){
        $news = new news();
        $news->update();
    }
 
    // update code
    if(isset($_POST["edit_btn"])){
        $news = new news();
        $news->update();
    }
}
 
 
 
?>


[19:14] Mohammed Uzaifa
filename: news_front.php
<!DOCTYPE html>

<html lang="en">
 
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>News | Kitchen365</title>

</head>
 
<script>

    // Function to validate form fields and enable/disable submit button

    function validateForm() {

        var name = document.getElementById('title').value;

        var description = document.getElementById('description').value;

        var sorting = document.getElementById('sorting').value;

        var insert_btn = document.getElementById('insert_btn');

        // if (name == '' || description == '' || sorting == '') {

        //     alert("Please! fill the form...");

        //     return false;

        // }
 
        // Validate title - accept only text

        var titleRegex = /^[a-zA-Z\s]+$/; // Only letters and spaces allowed

        if (!titleRegex.test(name)) {

            alert("Please enter a valid title with only letters and spaces.");

            return false;

        }

        // Validate description - accept only 500 characters

        if (description.length > 500) {

            alert("Please enter a description with a maximum of 500 characters.");

            return false;

        }

        // Validate sorting - accept only numbers

        if (isNaN(sorting)) {

            alert("Please enter a valid sorting number.");

            return false;

        }

    }
 
 
    // Function to handle form submission and save data to database

    function submitForm() {

        // Code to save form data to the database goes here

        alert("Form submitted successfully!");

        document.getElementById('myForm').submit();

        document.getElementById('myForm').reset(); // Reset form after submission

        validateForm(); // Re-validate form after reset

    }

</script>
 
<body>

    <div class="container">

        <!-- News Add -->

        <h3>News Add</h3>

        <form action="news_back.php" method="post" id="myForm" onsubmit="return validateForm()">

            <label for="title">Title:</label>

            <input type="text" name="title" id="title" oninput="validateForm()"><br><br>

            <label for="description">Description:</label>

            <textarea name="description" id="description" cols="30" rows="10" oninput="validateForm()"></textarea><br><br>

            <label for="sorting">Sorting:</label>

            <input type="number" name="sorting" id="sorting" oninput="validateForm()"><br><br>

            <button type="submit" name="insert_btn" id="insert_btn" >SUBMIT</button>

            <button type="submit" name="update_btn" id="update_btn" >UPDATE</button>

        </form>

    </div>

    <hr>

    <div class="container">

        <h3>News View</h3>

        <table>

            <th>Title</th>

            <th>Description</th>

            <th>Sorting</th>

            <th>Create_at</th>

            <th>Update_at</th>

            <th>Edit</th>

            <th>DELETE</th>
 
        </table>

        <?php

        include_once('news_back.php');
 
        $news = new news();

        $news->read();

        ?>

    </div>

    <hr>

    <?php

        include_once('news_back.php');

        $id = $_GET['entity_id'];
 
        $news = new news();

        $result = $news->fetch($id);
 
        if($result && $result->num_rows > 0){

            while($row = $result->fetch_assoc()){
 
            

    ?>

        <h3>News Update</h3>  

        <form action="news_back.php" method="post">

            <input type="hidden" name="entity_id" value="<?php echo $_GET['entity_id']; ?>">

            <label for="up_title">Title:</label>

            <input type="text" name="up_title" id="" value="<?php echo $row['title']; ?>"><br><br>

            <label for="up_description">Description:</label>

            <textarea name="up_description" id="" cols="30" rows="10" ><?php echo $row['description']; ?></textarea><br><br>

            <label for="up_sorting">Sorting:</label>

            <input type="number" name="up_sorting" id="" value="<?php echo $row['sort_news']; ?>"><br><br>

            <button type="submit" name="edit_btn">UPDATE</button>

        </form>

        <?php }

        } ?>

<hr>

</body>
 
</html>