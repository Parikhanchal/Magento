<?php
include 'library.php';    
?>

<!DOCTYPE html>
<html>
<script>
var ascendingOrder = true;

function validation() 
{
    var name = document.getElementById('name').value;
    var price = document.getElementById('price').value;
    var sku = document.getElementById('sku').value;
    var sort_order = document.getElementById('sort_order').value;
    
    if (name == '' || sku == '' || price == '' || sort_order == '') {
        alert("Please! fill the form...");
        return false;
    }

    var nameRegex = /^[a-zA-Z\s]+$/;
    if (!nameRegex.test(name)) {
        alert("Please enter a valid product name with only letters and spaces.");
        return false;
    }

    var skuRegex = /^[a-z\s]+$/;
    if (!skuRegex.test(sku)) {
        alert("Please enter a valid sku name with only small letters and spaces.");
        return false;
    }

    if (isNaN(price)) {
        alert("Please enter a valid price.");
        return false;
    }

    if (isNaN(sort_order)) {
        alert("Please enter a valid sorting numbers.");
        return false;
    }
}

// function filter_id() {
//     var table, rows, switching, i, x, y, shouldSwitch;
//     table = document.getElementById("table");
//     switching = true;

//     while (switching) {
//         switching = false;
//         rows = table.rows;

//         for (i = 1; i < (rows.length - 1); i++) {
//             shouldSwitch = false;
//             x = rows[i].getElementsByTagName("td")[0]; // Change the index if ID is in a different column
//             y = rows[i + 1].getElementsByTagName("td")[0]; // Change the index if ID is in a different column

//             var id1 = parseInt(x.innerHTML);
//             var id2 = parseInt(y.innerHTML);

//             if (!ascendingOrder) {
//                 var temp = id1;
//                 id1 = id2;
//                 id2 = temp;
//             }

//             if (id1 > id2) {
//                 shouldSwitch = true;
//                 break;
//             }
//         }

//         if (shouldSwitch) {
//             rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
//             switching = true;
//         }
//     }
//     ascendingOrder = !ascendingOrder;
// }

// function filter(columnIndex) {
//         var table, rows, switching, i, x, y, shouldSwitch;
//         table = document.getElementById("table");
//         switching = true;

//         while (switching) {
//             switching = false;
//             rows = table.rows;

//             for (i = 1; i < (rows.length - 1); i++) {
//                 shouldSwitch = false;
//                 x = rows[i].getElementsByTagName("td")[columnIndex];
//                 y = rows[i + 1].getElementsByTagName("td")[columnIndex];

//                 var contentX = x.innerHTML.trim();
//                 var contentY = y.innerHTML.trim();

//                 if (!ascendingOrder) {
//                     var temp = contentX;
//                     contentX = contentY;
//                     contentY = temp;
//                 }

//                 if (columnIndex === 3 || columnIndex === 4) { // For date columns
//                     var dateX = new Date(contentX);
//                     var dateY = new Date(contentY);
//                     if (dateX > dateY) {
//                         shouldSwitch = true;
//                         break;
//                     }
//                 } else {
//                     if (contentX.localeCompare(contentY) > 0) {
//                         shouldSwitch = true;
//                         break;
//                     }
//                 }
//             }

//             if (shouldSwitch) {
//                 rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
//                 switching = true;
//             }
//         }
//         ascendingOrder = !ascendingOrder;
//     }

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
  <h2> Forms</h2>

  <form id="myform" action="" onsubmit="return validation()" method="post" >
  
  <label for="name">name:</label>
  <input type="text" id="name" name="name"><br><br>

  <label for="price">price:</label>
  <input type="text" id="price" name="price" ><br><br>
  
  <label for="sku">sku:</label>
  <input type="text" id="sku" name="sku" ><br><br>

  <label for="sort_order">sort_order:</label>
  <input type="text" id="sort_order" name="sort_order" ><br><br>
  
  <input type="submit" value="Submit" name="submit">

  </form> 
<hr>

<h3>View All Products</h3>
      <table id="table" border="1">
      <thead>
        <tr>
           
          <th>Id</th>
          <th>Name</th>
          <th>Sku</th>
          <th>Price</th>
          <th>create_date</th>
          <th>update_date</th>
          <th>Actions</th>
          <th>Check</th>
          <!-- <th onclick="filter(0)">ID <button>&#8691;</button></th>
          <th onclick="filter(1)">Name <button>&#8691;</button></th>
          <th onclick="filter(2)">Sku <button>&#8691;</button></th>
          <th onclick="filter(3)">Price <button>&#8691;</button></th>
          <th onclick="filter(4)">Create Date <button>&#8691;</button></th>
          <th onclick="filter(5)">Update Date <button>&#8691;</button></th>
          <th>Actions</th>
          <th>Check</th> -->
        </tr>
      </thead>
      <tbody>
          <?php
            $product = new product();
            $result = $product->select();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $row['entity_id'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['sku'];?></td>
                    <td><?php echo $row['price'];?></td>
                    <td><?php echo $row['create_date'];?></td>
                    <td><?php echo $row['update_date'];?></td>

                    <td>&nbsp;
                        <a href="index.php?id=<?php echo $row['entity_id'];?>">Update</a>
                        </td>
                    <td><input type="checkbox" onclick="deleteRow();" ></td>
                </tr>
                <?php
            }
        }
        ?>
      </tbody>
      </table>
<hr>
<h2> Product Update</h2>
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
</div>
<hr>
</body>
</html>

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

<?php
include 'library.php';        
  
$id = $_GET['id'];
$del = new product();
$result = $del->delete($id);
if ($result) {
    echo "<script>alert('product deleted successfully');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit();
} else {
    echo "<script>alert('product not deleted successfully');</script>";
}
?>
