<?php

    include 'con.php';

    if(isset($_POST['submit']))
    {
        // $fxxx---variable
        // $_Post---method
        $fname = $_POST[' first '];
        $lname = $_POST[' last '];
        $address = $_POST[' address '];
        $gender = $_POST[' gender '];

        if($fname != "" && $lname != "" && $address != "" && $gender!= "" )
        {
            $sql = "INSERT INTO student ($fname , $lname , $address , $gender ) VALUE('','')";
        }
    }
?>
