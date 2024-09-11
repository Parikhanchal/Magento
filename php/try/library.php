<?php

include 'index.php';    
ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);    

?>

<!DOCTYPE html>
<html>
<body>
    <center>
    <h2> Forms</h2>
    <form action="" method="post">
        <label for="name">name:</label>
        <input type="text" name="p_name"required>
        <br><br>
        <label for="price">price:</label>
        <input type="text" name="p_price" required><br><br>
        
        <label for="sku">sku:</label>
        <input type="text" name="p_sku" ><br><br>

        <label for="sort_order">sort_order:</label>
        <input type="text" name="p_sort_order" ><br><br>
        <input type="submit" value="Submit" name="submit">
    </form>
    </center>

    <center>
        <h3> View All Product</h3>
        <table border="1">
            <thead>
                <td>
                    <th>ID</th>
                    <td>NAME</td>
                    <td>PRICE</td>
                    <td>SKU</td>
                    <td>SORT_ORDER</td>
                    <td>Actions</td>
                </td>
            </thead>

            <tbody>
                <?php
                    $product_select = new product();
                    $result = $product_select->select();
                    // product_select --- any mane of variable
                    // = new __ --> class name

                    if($result -> num_row > 0)
                    {
                        while($row = $result->fetch_assoc())
                        {
                        ?>
                        <tr>
                            <td><?php echo $row['entity_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['price'];?></td><td><?php echo $row['name'];?></td>
                            <td><?php echo $row['sku'];?></td>
                            <td><?php echo $row['price'];?></td>
                            <td><?php echo $row['create_date'];?></td>
                            <td><?php echo $row['update_date'];?></td>

                            <td><a href="library.php?id=<?php echo $row['entity_id'];?>">> DELETE </a></td>
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
    $product_create = new product();
    $result = $product_create->insert();
?>