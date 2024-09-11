<?php
include 'library.php';        
  
  $id = $_GET['id'];
  $del = new product();
  $result = $del->delete($id);
  if( $result) {
    echo "<script>alert('product deleted successfully');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit();
  } 
 else {
    // echo "error deleting";
    echo "<script>alert('product not deleted successfully');</script>";
}
?>