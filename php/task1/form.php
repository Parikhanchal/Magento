<?php
include 'lib.php';    
?>

<!DOCTYPE html>
<html>
<script>        
    function validateForm() 
    {
        var name = document.getElementById('name').value;
        var sorting = document.getElementById('sorting').value;

        if (name == '' || sorting == '') {
            alert("Please! fill the form...");
            return false;
        }
        var nameRegex = /^[a-zA-Z\s]+$/; 

        if (!nameRegex.test(name)) 
        {
            alert("Please enter a valid name with only letters and spaces.");
            return false;
        }
        if (isNaN(sorting)) {
            alert("Please enter a valid sorting numbers.");
            return false;
        }   
    }
</script>
 
<body>
    <center>
    
    <div class="container">
    <?php
    if(isset($_SESSION['message']))
    {
      echo "".$_SESSION['message']."";
      unset($_SESSION['message']);
    }
    ?>
        <h3>Form</h3>
        <form method="post"  onsubmit="return validateForm()">
        
            <label for="name">Name:</label>
            <input type="text" name="name" id="name"><br><br>

            <label for="sorting">Sorting:</label>
            <input type="number" name="sorting" id="sorting" ><br><br>

            <button type="submit" name="submit" id="submit" >SUBMIT</button>
        </form>
    <hr>
    <br>
    
    <form action="lib.php" method="post">
        <input type="search" name="searchinput"> <button type="submit" name="search">Search</button> 
    </form>

    <hr>

    <div class="container">
        <h3>View Data</h3>
        <form action="" method="post">
            <table border="5">
                <thead>
                    <tr>
                        <th>&nbsp;<button type="submit" name="deleteAllBtn" id="deleteAll">Delete</button>&nbsp;</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Sort</th>
                        <th>Create Date</th>
                        <th>Update Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $categoryView = new Category();
                        $result = $categoryView->select();
    
                        if($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                ?>
                                <tr>
                                <td>&nbsp;<input type="checkbox" name="deleteAll[]" value="<?php echo $row['entity_id'];?>">&nbsp;</td>
                                <td>&nbsp;<?php echo $row['entity_id'];?>&nbsp;</td>
                                <td>&nbsp;<?php echo $row['name'];?>&nbsp;</td>
                                <td>&nbsp;<?php echo $row['sort_order'];?>&nbsp;</td>
    
                                <td>&nbsp;<?php echo $row['create_date'];?>&nbsp;</td>
                                <td>&nbsp;<?php echo $row['update_date'];?>&nbsp;</td>
                                <td>&nbsp;
                                    <a href="form.php?id=<?php echo $row['entity_id'];?>">Update&nbsp;</a>
                                </td>
                                <!-- &nbsp; -- for space -->

                                </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
    <hr>

    <div class="container">
        <?php
            $id = $_GET['id'];
            $category = new Category();
            $result = $category->fetch($id);
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    ?>
                        <h3>Update Data</h3>
                        <form action="" method="post">

                        <input type="hidden" id="id"  name="id" value="<?php echo $_GET['entity_id'];?>
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" value="<?php echo $row['name'];?>"><br><br>

                        <label for="sorting">Sorting:</label>
                        <input type="number" name="sorting" id="sorting" value="<?php echo $row['sort_order'];?>"><br><br>

                        <button type="submit" name="update" id="submit" >Update</button>

                    </form>
                    <?php
                }
            }
        ?>
    </div>

    </center>
</body>
</html>



<?php
    $checkbox = $_POST['deleteAll'];
    $check_del = implode(',', $checkbox);
   
    $result =$category->delete($check_del);

    if($result) {
        $_SESSION['message'] = "delete category";
        echo "<script>window.location.href='form.php';</script>";
        exit();
      } 
     else {
        echo "error deleting";
    }
?>

