<?php
include 'lib.php';    
?>

<?php
    $id = $_GET['id'];
    $category = new Category();
    $result =$category->delete($id);
    if( $result) {
        $_SESSION['message'] = "delete category";
        echo "<script>window.location.href='form.php';</script>";
        exit();
      } 
     else {
        echo "error deleting";
    }
?>